<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminSkillController extends Controller
{
    public function index()
    {

        $data['skills'] = Skill::orderBy('id', 'DESC')->paginate(10);
        $data['cats'] = Cat::select('id', 'name')->get();
        return view('admin.skills.index')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'required|image|max:2048',
            'cat_id' => 'required|exists:cats,id',
        ]);

        if($request->hasfile('img'))
        {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/', $filename);
            $request->img = $filename;
        }

        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' =>  $request->img,
            'cat_id' => $request->cat_id,
        ]);
        $request->session()->flash('msg', 'row added successfully');

        return back();
    }

    public function delete(Skill $skill, Request $request)
    {
        try {
            $path = $skill->img;
            $destination = 'uploads/'.$path;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $skill->delete();
            $msg = "row deleted successfully";
        } catch (\Exception $e) {
            $msg = "can't delete this row";
        }

        $request->session()->flash('msg', $msg);

        return back();


    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:skills,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'nullable|image|max:2048',
            'cat_id' => 'required|exists:cats,id',
        ]);

        $skill = Skill::findOrFail($request->id);
        $path = $skill->img;
        if ($request->hasFile('img')) {
            $destination = 'uploads/'.$path;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/', $filename);
            $request->img = $filename;

        } else {
            $request->img = $path;
        }

        $skill->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $request->img,
            'cat_id' => $request->cat_id,
        ]);
        $request->session()->flash('msg', 'row updated successfully');
        return back();


    }


    public function toggle(Skill $skill)
    {
        $skill->update([
            'active' => !$skill->active
        ]);
        return back();
    }
}
