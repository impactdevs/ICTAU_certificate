<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Mail\EmailCommunication;
use Illuminate\Support\Facades\Mail;
use App\Models\Membership_Type;

class CommunicationController extends Controller
{
    public function index()
    {
        return view('admin.communications.index');
    }

    public function create()
    {
        $members = Member::all();

        $membershipTypes = Membership_Type::all();

        return view('admin.communications.create', compact('members', 'membershipTypes'));
    }



    public function sendEmail(Request $request)
    {
        // just check if membership_types.* has one elemnt and the elemnt is 0 with value null and set
        $validated = $request->validate([
            'members' => 'nullable|array',
            'members.*' => 'exists:members,id',
            'membership_types' => 'nullable|array',
            'membership_types.*' => 'nullable|exists:membership__types,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $query = Member::query();

        // Handle recipient selection
        if (in_array('all', $request->membership_types ?? [])) {
            $emails = Member::pluck('email')->toArray();
        } else {
            if ($request->filled('members')) {
            $query->whereIn('id', $request->members);
            }
            if ($request->filled('membership_types')) {
                if(!((count($request->input('membership_types')) == 1) && is_null($request->input('membership_types')[0]))){
                    $query->orWhereIn('membership_type_id', $request->membership_types);
                }
            }

            // Filter by subscription status if provided
            if ($request->filled('subscription_status')) {
            $status = $request->subscription_status;
            $query->where(function ($q) use ($status) {
                if ($status === 'running') {
                    $q->where(function ($sq) {
                        $sq->whereHas('subscriptions', function ($subQ) {
                            $subQ->whereRaw('DATE_ADD(subscribed_on, INTERVAL 1 YEAR) > NOW()');
                        })
                        ->orWhere(function ($subSq) {
                            $subSq->whereDoesntHave('subscriptions')
                                ->whereRaw('DATE_ADD(created_at, INTERVAL 1 YEAR) > NOW()');
                        });
                    });
                }
                if ($status === 'expired') {
                    $q->where(function ($sq) {
                        $sq->whereHas('subscriptions', function ($subQ) {
                            $subQ->whereRaw('DATE_ADD(subscribed_on, INTERVAL 1 YEAR) <= NOW()');
                        })
                        ->orWhere(function ($subSq) {
                            $subSq->whereDoesntHave('subscriptions')
                                ->whereRaw('DATE_ADD(created_at, INTERVAL 1 YEAR) <= NOW()');
                        });
                    });
                }
            });
            }

            $emails = $query->distinct()->pluck('email')->toArray();
        }

        if (empty($emails)) {
            return back()->withErrors('Please select at least one recipient');
        }


        // Chunk and queue emails
        collect($emails)->chunk(100)->each(function ($chunk) use ($request) {
            foreach ($chunk as $email) {
                Mail::to($email)->queue(new EmailCommunication($email, $request->subject, $request->body));
            }
        });



        return redirect()->back()->with('success', 'Emails are being sent to ' . count($emails) . ' recipients');
    }

    private function getRecipientEmails(array $recipients): array
    {
        if (in_array('all', $recipients)) {
            return Member::pluck('email')->toArray();
        }

        return Member::whereIn('id', $recipients)
            ->pluck('email')
            ->toArray();
    }
    public function sendSms() {}
}
