<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Http\Requests\TutorRequest;

class TutorController extends Controller
{

    public function index(){
        $tutors = Tutor::paginate(10);
        return view('tutor.index', compact('tutors'));
    }

    public function addEdit(Tutor $tutor=null){
        return view('tutor.addEdit', compact('tutor'));
    }

    public function storeUpdate(TutorRequest $request, Tutor $tutor=null){
        $data = $request->validated();  

        if($tutor != null){
            $tutor->update($data);

            $notification = array(
                'message' =>    'Parinte modificat cu succes!',
                'alert-type'    => 'success',
            );

        }else{
            $student = Tutor::create($data);

            $notification = array(
                'message' =>    'Parinte adaugat cu succes!',
                'alert-type'    => 'success',
            );
        }
        return redirect()->route('tutors.index')->with($notification);
    }

    public function delete(Tutor $tutor){
        $tutor->delete();
        $notification = array(
            'message' =>    'Parinte sters cu succes!',
            'alert-type'    => 'success',
        );
    return redirect()->route('tutors.index')->with($notification);

    }

    public function search(Request $request){
        $search = $request->search;

        $tutors = Tutor::where('name', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('student', function($query) use($search){
                            $query->where('name', 'LIKE', '%' . $search . '%');
                            }) 
                        ->paginate(10);
        $tutors->appends([
            'search' => $request->search,
        ]);

        return view('tutor.index', compact('tutors', 'search'));
    }

}
