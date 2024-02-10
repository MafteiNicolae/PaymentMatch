<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest as RequestsStudentRequest;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;

class StudentController extends Controller
{
    public function index(){
        $students = Student::paginate(10);
        return view('student.index', compact('students'));
    }

    public function addEdit(Student $student=null){
        return view('student.addEdit', compact('student'));
    }

    public function storeUpdate(StudentRequest $request, Student $student = null){
        $data = $request->validated();

        if($student != null){
            $student->update($data);

            $notification = array(
                'message' =>    'Elev modificat cu succes!',
                'alert-type'    => 'success',
            );

        }else{
            $student = Student::create($data);

            $notification = array(
                'message' =>    'Elev adaugat cu succes!',
                'alert-type'    => 'success',
            );
        }
        return redirect()->route('students.index')->with($notification);

    }

    public function delete(Student $student){
        $student->delete();
        $notification = array(
            'message' =>    'Elev sters cu succes!',
            'alert-type'    => 'success',
        ); 
        return redirect()->route('students.index')->with($notification);
    }

    public function formImport(){
        return view('student.import');
    }

    public function import(Request $request){

        Excel::import(new StudentImport, $request->file);

        $notification = array(
            'message' =>    'Elev adaugat cu succes!',
            'alert-type'    => 'success',
        );
        return redirect()->route('students.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->search;

        // dd($search);
        $students = Student::where('name', 'LIKE', '%' . $search . '%')
                           ->orWhereHas('group', function($query) use($search){
                                $query->where('name', 'LIKE', '%' . $search . '%');
                           })
                            ->paginate(10);

        $students->appends([
            'search' => $request->search
        ]);

        return view('student.index', compact('students', 'search'));
    }
}
