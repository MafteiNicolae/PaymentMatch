@extends('dashboard')
@section('title', 'Grupe')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="row">
                <div class="col-4 mt-3">
                    <div class="card mt-2 ms-5">
                        <h1 class="h2">Lista grupe</h1>
                    </div>
                </div>
                <div class="col-5 mt-3">

                </div>
                <div class="col-2 mt-3">
                    <form action="{{route('group.search')}}" method="GET">
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
                            <th>Orar</th>
                            <th>Profesor</th>
                            <th >Actiuni</th>
                        </tr>
                        @forelse($groups as $key=>$group)
                            <tr>
                                <td>{{$groups->firstItem() + $key }}</td>
                                <td>{{$group->name}}</td>
                                <td>{{$group->shedule}}</td>
                                <td>{{$group->teacher->name}}</td>                                
                                <td>
                                    <a  class="btn btn-primary"
                                        href="{{route('group.addEdit', ['group' => $group->id ] )}}"
                                        >
                                        Modifica
                                    </a>
                                    <button  class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteGroupModal_{{$group->id}}"

                                        id="delete"
                                        >
                                        Sterge
                                    </button>
                                </td>
                            </tr>
                            @include('group.deleteModal')
                        @empty
                        <tr>
                                <td colspan="8" class="text-center">
                                    <p>Momentan nu exista grupe inregistrate</p>
                                </td>
                            </tr>
                        @endforelse
                    </thead>
                </table>
                    {{ $groups->links() }}
            </div>
        </div>
    </div>
</div>
@endsection