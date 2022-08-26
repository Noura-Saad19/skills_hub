<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function start($examId, Request $request)
    {
        $user = Auth::user();
        $user->exams()->attach($examId);

        $request->session()->flash('prev', "start/$examId");

        return redirect(url("exams/questions/$examId"));
    }

    public function show($examId)
    {
        $data['exam'] = Exam::findOrFail($examId);
        $user = Auth::user();
        $data['canViewStartBtn'] = true;

        if ($user !== null) {
            $pivotRow = $user->exams()->where('exam_id', $examId)->first();
            if ($pivotRow !== null and $pivotRow->pivot->status == 'closed') {
                $data['canViewStartBtn'] = false;

            }
        }
        return view('web.exams.show')->with($data);
    }

    public function questions($examId, Request $request){
        if (session('prev') !== "start/$examId") {
            return redirect(url("exams/show/$examId"));
        }
        $data['exam'] = Exam::findOrFail($examId);
        $request->session()->flash('prev', "questions/$examId");


        return view('web.exams.questions')->with($data);
    }

    public function submit($examId, Request $request){
        if (session('prev') !== "questions/$examId") {
            return redirect(url("exams/show/$examId"));
        }
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|in:1,2,3,4',

        ]);

        //Calculate Score
        $exam = Exam::findOrFail($examId);
        $points = 0;
        $totalQuesNum = $exam->questions->count();
        foreach ($exam->questions as $question) {
            if (isset($request->answers[$question->id])) {
                $userAnswer = $request->answers[$question->id];
                $rightAnswer = $question->right_ans;
                if ($userAnswer == $rightAnswer) {
                    $points += 1;
                }
            }
        }
        $score = ($points / $totalQuesNum) * 100;

        //Calculate Time Mins
        $user = Auth::user();
        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);
        //update pivot row
        if ($timeMins > $pivotRow->duration_mins) {
            $score = 0;
        }
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_mins' => $timeMins
        ]);

        $request->session()->flash("success", "You finished exam successfully with score $score %");
        return redirect(url("exams/show/$examId"));
    }


}
