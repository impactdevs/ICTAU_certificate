<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Member;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $subscriptions = Subscription::with('member')->get();
    //     return view('subscriptions.index', compact('subscriptions'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $members = Member::all();
    //     return view('subscriptions.create', compact('members'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'membership_id' => 'required|exists:members,id',
            'subscribed_on' => 'required|date',
        ]);

        Subscription::create($validated);

        return redirect('admin/member')
            ->with('success', 'Subscription added successfully.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $subscription = Subscription::with('member')->findOrFail($id);
    //     return view('subscriptions.show', compact('subscription'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     $subscription = Subscription::findOrFail($id);
    //     $members = Member::all();
    //     return view('subscriptions.edit', compact('subscription', 'members'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'membership_id' => 'required|exists:members,id',
            'subscribed_on' => 'required|date',
        ]);

        $subscription = Subscription::findOrFail($id);
        $subscription->update($validated);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }
}
