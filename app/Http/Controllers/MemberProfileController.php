<?php

namespace App\Http\Controllers;

use App\MemberProfile;
use Illuminate\Http\Request;

class MemberProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = MemberProfile::with('user')->select('member_profiles.*');

        return datatables()->of($query)->addIndexColumn()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MemberProfile  $memberProfile
     * @return \Illuminate\Http\Response
     */
    public function show(MemberProfile $memberProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MemberProfile  $memberProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberProfile $memberProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MemberProfile  $memberProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberProfile $memberProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MemberProfile  $memberProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberProfile $memberProfile)
    {
        //
    }
}
