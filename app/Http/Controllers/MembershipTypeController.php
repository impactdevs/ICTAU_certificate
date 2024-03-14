<?php

namespace App\Http\Controllers;

use App\Models\Membership_Type;
use Illuminate\Http\Request;

class MembershipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $member_type = Membership_Type::where('membership_type_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $member_type = Membership_Type::latest()->paginate($perPage);
        }

        return view('admin.member-types.index', compact('member_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.member-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Membership_Type::create($requestData);

        return redirect('admin/member_type')->with('flash_message', 'Member added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {

        $member_type = Membership_Type::findOrFail($id);

        return view('admin.member-types.show', compact('member_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $member_type = Membership_Type::findOrFail($id);

        return view('admin.member-types.edit', compact('member_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $member_type = Membership_Type::findOrFail($id);
        $member_type->update($requestData);

        return redirect('admin/member_type')->with('flash_message', 'Member updated!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Membership_Type::destroy($id);

        return redirect('admin/member_type')->with('flash_message', 'Member deleted!');
    }
}
