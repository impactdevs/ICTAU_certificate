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
        $validated = $request->validate([
            'members' => 'nullable|array',
            'members.*' => 'exists:members,id',
            'membership_types' => 'nullable|array',
            'membership_types.*' => 'exists:membership__types,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
    
        $query = Member::query();
    
        // Handle recipient selection
        if (in_array('all', $request->membership_types ?? [])) {
            $emails = $query->pluck('email')->toArray();
        } else {
            $query->where(function($q) use ($request) {
                if ($request->filled('members')) {
                    $q->whereIn('id', $request->members);
                }
                if ($request->filled('membership_types')) {
                    $q->orWhereIn('membership_type_id', $request->membership_types);
                }
            });
            
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
    
        return redirect()->back()->with('success', 'Emails are being sent to '.count($emails).' recipients');
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
    public function sendSms()
    {

    }
}
