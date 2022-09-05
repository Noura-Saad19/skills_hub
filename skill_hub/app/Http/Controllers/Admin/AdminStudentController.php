<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index()
    {

        $studentRole = Role::where('name', 'student')->first();
        $data['students'] = User::where('role_id', $studentRole->id)
            ->orderBy('id', 'DESC')->get();
        return view('admin.students.index')->with($data);
    }

    public function showScores($id)
    {
        $student = User::findOrFail($id);
        if ($student->role->name !== 'student') {
            return back();
        }
        $data['students'] = $student;
        $data['exams'] = $student->exams;
        return view('admin.students.show-scores')->with($data);
    }

    public function openExam($studentId,$examId){
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId,[
           'status' => 'opened',

        ]);

        return back();
    }
    public function closeExam($studentId,$examId){
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId,[
            'status' => 'closed',

        ]);

        return back();
    }


}
