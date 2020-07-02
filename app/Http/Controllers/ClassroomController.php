<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\ClassroomMember;
use App\Course;
use App\MemberProfile;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $classrooms = Classroom::with('courses')->withCount('classroom_members')->where('user_id', $userId)->paginate(20);
        $publishedClasrooms = Classroom::where('published', 1)->where('user_id', $userId)->count();
        $publishedCourses = Course::count();
        $totalMembers = MemberProfile::count();
        $joinedMembers = ClassroomMember::groupBy('user_id')->count();

        return view('admin.classroom.index', compact('classrooms', 'publishedClasrooms', 'publishedCourses', 'totalMembers', 'joinedMembers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.classroom.create');
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
            'name' => 'required|max:255',
            'code' => 'required|max:6|unique:classrooms',
        ]);

        $request->request->add(['user_id' => auth()->user()->id]);
        Classroom::create($request->all());
        
        return redirect('/admin/classroom');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        return view('admin.classroom.edit', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        return view('admin.classroom.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->request->add(['published' => $request->published ? 1 : 0]);
        $request->validate([
            'name' => 'required|max:255',
            'code' => $request->code === $classroom->code ? '' : 'required|max:6|unique:classrooms',
        ]);

        $classroom->update($request->except('_token', '_method'));

        return redirect('/admin/classroom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
