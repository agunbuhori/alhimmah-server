<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kelas()
    {
        $classes = Classroom::with('courses')->get();
        return view('home.kelas')->with(compact('classes'));
    }
}
