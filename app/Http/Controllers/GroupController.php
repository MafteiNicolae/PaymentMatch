<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use PDO;
use App\Http\Requests\GroupRequest;

class GroupController extends Controller
{
    public function index(){
        $groups = Group::paginate(10);
        return view('group.index', compact('groups'));
    }

    public function addEdit(Group $group = null){
        return view('group.addEdit', compact('group'));
    }

    public function storeUpdate(GroupRequest $request, Group $group = null){
        $data = $request->validated();

        if($group != null){
            $group->update($data);

            $notification = array(
                'message' =>    'Grup modificat cu succes!',
                'alert-type'    => 'success',
            );
        }else{
            $group = Group::create($data);

            $notification = array(
                'message' =>    'Grup creat cu succes!',
                'alert-type'    => 'success',
            );
        }

        return redirect()->route('group.index')->with($notification);
    }

    public function delete(Group $group){
        $group->delete();
        
        $notification = array(
            'message' =>    'Grup sters cu succes!',
            'alert-type'    => 'success',
        );

        return redirect()->route('group.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->search;

        $groups = Group::where('name', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('teacher', function($query) use($search){
                            $query->where('name', 'LIKE', '%' . $search . '%');
                        })
                        ->paginate(10);
        $groups->appends([
            'search' => $request->search,
        ]);

        return view('group.index', compact('groups', 'search'));
    }
}
