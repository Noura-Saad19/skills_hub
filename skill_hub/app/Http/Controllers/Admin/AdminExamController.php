<?php

namespace App\Http\Controllers\Admin;

use App\Events\ExamAddedEvent;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminExamController extends Controller
{
    public function index()
    {
        $data['exams'] = Exam::select('id', 'name', 'skill_id', 'img', 'question_no', 'active')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.exams.index')->with($data);
    }

    public function show(Exam $exam)
    {
        $data['exams'] = $exam;
        return view('admin.exams.show')->with($data);
    }

    public function showQuestions(Exam $exam)
    {
        $data['exams'] = $exam;
        return view('admin.exams.showQusetions')->with($data);
    }

    public function create()
    {
        $data['skills'] = Skill::select('id', 'name')->get();
        return view('admin.exams.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'required|image|max:2048',
            'skill_id' => 'required|exists:skills,id',
            'desc_en' => 'required|string|max:5000',
            'desc_ar' => 'required|string|max:5000',
            'questions_no' => 'required|integer|min:1',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',

        ]);

        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            $request->img = $filename;
        }
//        dd($request->questions_no);
        $exam = Exam::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $request->img,
            'skill_id' => $request->skill_id,
            'question_no' => $request->questions_no,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
            'desc' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),

            'active' => 0,
        ]);
        $request->session()->flash('prev', "exam/$exam->id");
        return redirect(url("dashboard/exams/create-questions/{$exam->id}"));
    }

    public function createQuestions(Exam $exam, Request $request)
    {
        if (session('prev') !== "exam/$exam->id" and session('current') !== "exam/$exam->id") {
            return redirect(url("dashboard/exams"));
        }
        $data['exam_id'] = $exam->id;
        $data['questions_no'] = $exam->question_no;

        return view('admin.exams.create-questions')->with($data);
    }

    public function storeQuestions(Exam $exam, Request $request)

    {
        $request->session()->flash('current', "exam/$exam->id");


//dd($request->all());
        $e = $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:500',
            'right_ans' => 'required|array',
            'right_ans.*' => 'required|in:1,2,3,4',
            'options_1s' => 'required|array',
            'options_1s.*' => 'required|string|max:255',
            'options_2s' => 'required|array',
            'options_2s.*' => 'required|string|max:255',
            'options_3s' => 'required|array',
            'options_3s.*' => 'required|string|max:255',
            'options_4s' => 'required|array',
            'options_4s.*' => 'required|string|max:255',
        ]);

        for ($i = 0; $i < $exam->question_no; $i++) {
            Question::create([
                'exam_id' => $exam->id,
                'title' => $request->titles[$i],
                'right_ans' => $request->right_ans[$i],
                'option_1' => $request->options_1s[$i],
                'option_2' => $request->options_2s[$i],
                'option_3' => $request->options_3s[$i],
                'option_4' => $request->options_4s[$i],
            ]);

        }
        $exam->update([
            'active' => 1,
        ]);
        event(new ExamAddedEvent());
        return redirect(url("dashboard/exams"));

    }

    public function edit(Exam $exam)
    {
        $data['skills'] = Skill::select('id', 'name')->get();
        $data['exam'] = $exam;
        return view('admin.exams.edit')->with($data);
    }

    public function update(Exam $exam, Request $request)
    {

        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'nullable|image|max:2048',
            'skill_id' => 'required|exists:skills,id',
            'desc_en' => 'required|string|max:5000',
            'desc_ar' => 'required|string|max:5000',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',

        ]);

//
        $ex = Exam::findOrFail($exam->id);
        $path = $ex->img;
//        dd($path);

        //بصي يا نورا هنا عايزين نخليها تبقي الصورة عنوانها ب 1 و كدا

        if ($request->hasFile('img')) {
            $destination = 'D:\Courses\Backend\XAMPP\htdocs\skill_hub\public\uploads\exams'.$path;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('D:\Courses\Backend\XAMPP\htdocs\skill_hub\public\uploads\exams', $filename);
            $ex->img = $filename;


        } else {
            $ex->img = $path;
        }

//        dd($ex->img , $filename,$file);

//        $ex = Exam::findOrFail($request->id);
//        $path = $ex->img;
//        if ($request->hasFile('img')) {
//            $destination = 'uploads/'.$path;
//            if(File::exists($destination))
//            {
//                File::delete($destination);
//            }
//            $file = $request->file('img');
//            $extension = $file->getClientOriginalExtension();
//            $filename = time().'.'.$extension;
//            $file->move('uploads/', $filename);
//            $request->img = $filename;
//
//        } else {
//            $request->img = $path;
//        }

//       dd($request->all());
        $exam->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $ex->img,
            'skill_id' => $request->skill_id,
            'difficulty' => $request->difficulty,
            'duration_mins' => $request->duration_mins,
            'desc' => json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),

            'active' => 0,
        ]);
        $request->session()->flash('msg', 'row updated successfully');
        return redirect(url("dashboard/exams/show/$exam->id"));
    }


    public function editQuestions(Exam $exam, Question $question)
    {

        $data['exam'] = $exam;
        $data['ques'] = $question;

        return view('admin.exams.editQuestions')->with($data);
    }

    public function updateQuestions(Exam $exam, Question $question, Request $request)

    {
        $data = $request->validate([
            'title' => 'required|string|max:500',
            'right_ans' => 'required|in:1,2,3,4',
            'option_1' => 'required|string|max:255',
            'option_2' => 'required|string|max:255',
            'option_3' => 'required|string|max:255',
            'option_4' => 'required|string|max:255',
        ]);
        $question->update($data);
        return redirect(url("dashboard/exams/show-questions/$exam->id"));
    }

    public function delete(Exam $exam, Request $request)
    {

        //lw el emt7an da5loh nas msh hynf53 nmsh el emt7an
        try {
//            $path = $exam->img;
//            $destination = 'uploads/'.$path;
//            if(File::exists($destination))
            //{
            //  File::delete($destination);
            //}
            $exam->questions()->delete();
            $exam->delete();
            $msg = "row deleted successfully";
        } catch (\Exception $e) {
            $msg = "can't delete this row";
        }

        $request->session()->flash('msg', $msg);

        return back();

    }

    public function toggle(Exam $exam)
    {
        if ($exam->question_no == $exam->questions()->count()) {
            $exam->update([
                'active' => !$exam->active
            ]);
        }

        return back();
    }

}
