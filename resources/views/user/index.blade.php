@extends('dashboard')
@section('title', 'Utilizatori')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="row">
                <div class="col-4 mt-3">
                    <div class="card mt-2 ms-5">
                        <h1 class="h2">Lista utilizatori</h1>
                    </div>
                </div>
                <div class="col-5 mt-3">

                </div>
                <div class="col-2 mt-3">
                    <form action="{{route('users.search')}}" method="GET">
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control float-right" name="search" placeholder="Cauta" value="{{ $search ?? null }}">
                        <button type="submit" class=" btn btn-info ms-2"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
        </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0 ms-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nume</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th >Actiuni</th>
                        </tr>
                        @forelse($users as $key=>$user)
                            <tr>
                                <td>{{$users->firstItem() + $key }}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->role == 0)
                                        Secretara
                                    @else
                                        Administator
                                    @endif
                                </td>                                
                                <td>
                                    <a  class="btn btn-primary"
                                        href="{{route('users.edit', $user->id)}}"
                                        >
                                        Modifica
                                    </a>
                                    <button  class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteUserModal_{{$user->id}}"

                                        id="delete"
                                        >
                                        Sterge
                                    </button>
                                </td>
                            </tr>
                            @include('user.deleteModal')
                        @empty
                        <tr>
                                <td colspan="8" class="text-center">
                                    <p>Momentan nu exista utilizatori inregistrati</p>
                                </td>
                            </tr>
                        @endforelse
                    </thead>
                </table>
                    {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection