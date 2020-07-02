<?php

namespace App\Http\Controllers\API;

use App\Classroom;
use App\Course;
use App\Http\Controllers\Controller;
use App\Matery;
use App\MemberMatery;
use App\MemberProfile;
use App\Quiz;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user();
        $user->profile = $user->member_profile;

        $domicilie = DB::table('wilayah')->where('kode', $user->profile->address_code)->first();
        $user->profile->domicilie = $domicilie ? $domicilie->nama : "";
        
        return $user;
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $member_profile = MemberProfile::where('user_id', $user->id)->first();

        $update = [
            'address_code' => $request->city_id,
            'address' => $request->address,
            'whatsapp' => $request->whatsapp,
        ];

        if (! $member_profile->member_id && $request->name && $request->gender && $request->birthday) {
            $count = MemberProfile::where('member_id', 'like', ($request->gender === 'male' ? '1' : '2').date('Y-m').'%')->count();
            $member_id = ($request->gender === 'male' ? '1' : '2').date('ym').sprintf("%04d", $count+1);
            $update['name'] = $request->name;
            $update['gender'] = $request->gender;
            $update['birthday'] = $request->birthday;
            $update['member_id'] = $member_id;
        }

        $member_profile = MemberProfile::where('user_id', $user->id)->update($update);

        return $member_profile;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function classrooms(Request $request)
    {
        $user = $request->user();

        $classrooms = Classroom::join('classroom_members', 'classrooms.id', '=', 'classroom_members.classroom_id')
        ->where(['classroom_members.user_id' => $user->id, 'published' => 1])
        ->withCount('courses')
        ->get();

        return $classrooms;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function courses(Request $request)
    {
        $user = $request->user();

        $classroom = Classroom::join('classroom_members', 'classrooms.id', '=', 'classroom_members.classroom_id')
        ->where(['classroom_members.user_id' => $user->id, 'graduated' => 0])
        ->with('courses.teacher')
        ->with(['courses' => function ($courses) {
            return $courses->whereHas('materies')->withCount('materies')->where('published', 1);
        }])
        ->first();

        if (! $classroom)
            return ['no_classroom' => true];

        $classroom->courses->each(function ($course) use ($user) {
            $member_materies = MemberMatery::join('materies', 'materies.id', '=', 'member_materies.matery_id')
            ->where(['user_id' => $user->id, 'materies.course_id' => $course->id])->count();
            $course->member_materies_count = $member_materies;
        });

        return $classroom;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quizzes(Request $request)
    {
        $user = $request->user();

        $member_materies = MemberMatery::where('user_id', $user->id)->whereDate('quiz_enabled', '>=', today())
        ->whereHas('matery', function ($matery) {
            return $matery->whereHas('quizzes');
        })
        ->with('matery.course')
        ->orderBy('created_at', 'DESC')
        ->when($request->ended, function ($query) use ($request) {
            if ($request->ended == 'true')
            return $query->whereNotNull('quiz_ended');
            else
            return $query->where('quiz_ended', NULL);
        })
        ->get()
        ->each(function ($member_matery) {
            $member_matery->secret = encrypt($member_matery->matery_id);
        });
        

        return $member_materies;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function materies(Request $request)
    {
        $user = $request->user();

        $course = Course::with(['materies' => function ($materies) use ($user) {
            return $materies->withCount(['member_materies' => function ($member_materies) use ($user) {
                return $member_materies->where('user_id', $user->id);
            }]);
        }])
        ->join('classroom_members', 'classroom_members.classroom_id', '=', 'courses.classroom_id')
        ->where('code', $request->course_code)
        ->firstOrFail();

        $course->materies->each(function ($matery) {
            $matery->secret = encrypt($matery->id);
        });

        return $course;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stream(Request $request, $id)
    {
        $id = decrypt($id);
        $user = $request->user();

        $check = MemberMatery::where('user_id', $user->id)
        ->whereDate('created_at', today())
        ->where('matery_id', '!=', $id)
        ->count();

        if ($check === 2)
            return ['limited' => true];

        $matery = Matery::whereHas('course', function ($course) use ($user) {
            return $course->join('classroom_members', 'classroom_members.classroom_id', '=', 'courses.classroom_id')
            ->where('classroom_members.user_id', $user->id);
        })
        ->with('course')
        ->where('id', $id)
        ->firstOrFail();

        return $matery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read(Request $request, $id)
    {
        $id = decrypt($id);
        $user = $request->user();

        $check = MemberMatery::where('user_id', $user->id)
        ->whereDate('created_at', today())
        ->count();

        if ($check === 2)
            return false;

        $check = MemberMatery::where(['user_id' => $user->id, 'matery_id' => $id]);

        if (! $check->count()) {

            $quizzes = Quiz::limit(5)->orderBy(DB::raw('RAND()'))->pluck('id');
            $duration = Quiz::whereIn('id', $quizzes)->select(DB::raw('SUM(duration) AS duration'))->first();

            $member_matery = new MemberMatery;
            $member_matery->user_id = $user->id;
            $member_matery->matery_id = $id;
            $member_matery->status = 'read';
            $member_matery->quiz_questions = json_encode($quizzes);
            $member_matery->quiz_duration = $duration->duration;
            $member_matery->quiz_paused = $duration->duration;
            $member_matery->quiz_enabled = Carbon::now()->addDays(1);
            $member_matery->reading_times = 1;
            $member_matery->save();

            return $member_matery;
        } else {
            $check->update(['reading_times' => DB::raw('reading_times+1')]);
            $member_matery = $check->first();
        }

        return $member_matery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quiz(Request $request, $id)
    {
        $id = decrypt($id);
        $user = $request->user();

        $matery = Matery::whereHas('course', function ($course) {
            return $course->join('classroom_members', 'classroom_members.classroom_id', '=', 'courses.classroom_id');
        })
        ->with(['course' => function ($course) {
            return $course->select('title', 'id', 'courses.classroom_id');
        }])
        ->join('member_materies', 'member_materies.matery_id', '=', 'materies.id')
        ->where([
            'member_materies.user_id' => $user->id, 
            'member_materies.matery_id' => $id,
        ])
        ->firstOrFail();

        $matery->secret = encrypt($matery->id);

        return $matery;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function startQuiz(Request $request, $id)
    {
        $id = decrypt($id);
        $user = $request->user();

        $member_matery = MemberMatery::where(['matery_id' => $id, 'user_id' => $user->id]);
        $member_matery->update(['quiz_started' => now()]);

        return $member_matery->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getQuizzes(Request $request, $id)
    {
        $id = decrypt($id);
        $user = $request->user();
        
        $quizzes = Quiz::whereIn('id', json_decode($request->quizzes))->get();

        return $quizzes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function answer(Request $request, $id)
    {
        $id = decrypt($id);
        $user = $request->user();
        $filter = ['matery_id' => $id, 'user_id' => $user->id];
    
        $member_matery = MemberMatery::where($filter);
        $update = [
            'quiz_answers' => json_encode($request->answers), 
            'quiz_paused' => $request->duration, 
        ];

        if ($request->end) {
            $update['quiz_ended'] = $request->duration;
            $update['quiz_score'] = $this->correction($request->answers);
        }
        
        $member_matery->update($update);
        $member_matery = MemberMatery::where($filter)->first();

        return $member_matery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function correction($answers)
    {
        $quizzes = Quiz::whereIn('id', array_keys($answers))->get();

        $score = 0;
        $maxScore = 0;

        foreach ($quizzes as $quiz) {
            $maxScore += $quiz->weight;

            if ($answers[$quiz->id] == $quiz->correct_answer)
                $score += $quiz->weight;
        }

        return ($score/$maxScore)*100;
    }
}
