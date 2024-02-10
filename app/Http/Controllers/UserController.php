<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(){
        return view('user.create');
    }

    public function index(){
        $users = User::Paginate(10);
        return view('user.index', compact('users'));
    }

    public function store(UserRequest $request, User $user = null){
        $data = $request->validated();
        // dd($data['name']);

        if($user){
            if($data['password']){
                $user->update([
                    'name'      => $data['name'],
                    'email'     => $data['email'],
                    'password'  => $data['password'],
                    'role'      => $data['role'],
                ]);
            }else{
            $user->update([
                'name'  => $data['name'],
                'email' => $data['email'],
                'role'  => $data['role'],
            ]);
            }

            $notification = array(
                'message' =>    'Utilizator modificat cu succes!',
                'alert-type'    => 'success',
            );

        }else{
            User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
                'role'      => $data['role'],
            ]);

            $notification = array(
                'message' =>    'Utilizator inregistrat cu succes!',
                'alert-type'    => 'success',
            );
        }

        return redirect()->route('users.index')->with($notification);
    }

    public function edit(User $user){
        return view ('user.create', compact('user'));
    }

    public function delete(User $user){
        $user->delete();

        // session()->flash('success', 'Utilizatorul a fist sters cu succes!');

        $notification = array(
            'message' =>    'Utilizator sters cu succes!',
            'alert-type'    => 'success',
        );
        return redirect()->route('users.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->search;

        $role= null;

        if (strtolower($search) == 'administrator') {
            $role = 1;
        } elseif (strtolower($search) == 'secretara') {
            $role = 0;
        }


        $users = User::where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('email', 'LIKE', '%' . $search . '%')
                      ->orWhere('role', $role)
                      ->paginate(10);
        $users->appends([
            'search'    => $request->search,
        ]);

        return view('user.index', compact('users', 'search'));
    }
}
