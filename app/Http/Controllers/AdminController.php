<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\MemberProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function user()
    {
        return view('admin.user');
    }

    public function publish($table, $id)
    {
        if (! preg_match('/^(classrooms|courses)$/', $table))
            abort(404);

        $update = DB::table($table)->where('id', $id)->update(['published' => 1]);

        return $update;
    }

    public function classroomMember($id)
    {
        $query = MemberProfile::join('classroom_members', 'member_profiles.user_id', '=', 'classroom_members.user_id')
        ->where('classroom_members.classroom_id', $id);

        return datatables()->of($query)->toJson();
    }

    public function mediaManager()
    {
        return view('admin.media_manager');
    }
    
    public function member()
    {
        return view('admin.member');
    }

    public function upload(Request $request)
    {
        $file = $request->file();

        return $file;
    }
}
