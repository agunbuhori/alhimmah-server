<?php

namespace App\Http\Controllers;

use App\Matery;
use Illuminate\Http\Request;

class MateryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Matery::where('course_id', request()->course_id)->get();
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
        $request->validate([
            'title' => 'required|max:255',
            'duration' => 'required|between:1,90'
        ]);

        Matery::create($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Matery  $matery
     * @return \Illuminate\Http\Response
     */
    public function show(Matery $matery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Matery  $matery
     * @return \Illuminate\Http\Response
     */
    public function edit(Matery $matery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Matery  $matery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matery $matery)
    {
        $request->validate([
            'title' => 'required|max:255',
            'duration' => 'required|between:1,90'
        ]);
        
        $matery->update($request->except('_token', '_method'));
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Matery  $matery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matery $matery)
    {
        return $matery->delete();
    }
}
