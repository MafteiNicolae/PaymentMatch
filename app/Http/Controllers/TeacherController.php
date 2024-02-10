<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Http\Requests\TeacherRequest;

class TeacherController extends Controller
{
    public function index(){
        $teachers = Teacher::paginate(10);
        return view('teacher.index', compact('teachers'));
    }

    public function addEdit(Teacher $teacher){
        return view('teacher.create', compact('teacher'));
    }

    public function storeUpdate(TeacherRequest $request, Teacher $teacher = null){
        $data = $request->validated();

        if($teacher){
            $teacher->update($data);
            $notification = array(
                'message' =>    'Profesor modificat cu succes!',
                'alert-type'    => 'success',
            );
        }else{
            $teacher = Teacher::create($data);

            $notification = array(
                'message' =>    'Profesor inregistrat cu succes!',
                'alert-type'    => 'success',
            );
        }
        return redirect()->route('teacher.index')->with($notification);
    }

    public function delete(Teacher $teacher){
        $teacher->delete();

        $notification = array(
            'message' =>    'Profesor sters cu succes!',
            'alert-type'    => 'success',
        );

        return redirect()->route('teacher.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->search;

        $teachers = Teacher::where('name', 'LIKE', '%' . $search . '%')
                            ->paginate(10);

        $teachers->appends([
            'search' => $request->search,
        ]);

        return view('teacher.index', compact('teachers', 'search'));

    }
}
