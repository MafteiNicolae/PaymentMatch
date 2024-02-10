@extends('dashboard')
@section('title', 'Parinti')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="row">
                <div class="col-4 mt-3">
                    <div class="card mt-2 ms-5">
                        <h1 class="h2">Lista parinti</h1>
                    </div>
                </div>
                <div class="col-5 mt-3">

                </div>
                <div class="col-2 mt-3">
                    <form action="{{route('tutors.search')}}" method="GET">
                        <div class="d-flex align-items-center">
                        <!-- <div class=" btn btn-primary custom-file"> -->
                            <input type="text" class="form-control float-right" name="search" placeholder="Cauta" value="{{ $search ?? null }}">
                            <!-- <label  for="customFile" class="m-0">Cauta</label> -->
                        <!-- </div> -->
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
                            <th>Elev</th>
                            <th >Actiuni</th>
                        </tr>
                        @forelse($tutors as $key=>$tutor)
                            <tr>
                                <td>{{$tutors->firstItem() + $key }}</td>
                                <td>{{$tutor->name}}</td>
                                <td>{{$tutor->student->name}}</td>                         
                                <td>
                                    <a  class="btn btn-primary"
                                        href="{{route('tutors.addEdit', ['tutor' => $tutor->id])}}"
                                        >
                                        Modifica
                                    </a>
                                    <button  class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteTutorModal_{{$tutor->id}}"

                                        id="delete"
                                        >
                                        Sterge
                                    </button>
                                </td>
                            </tr>
                            @include('tutor.deleteModal')
                        @empty
                        <tr>
                                <td colspan="8" class="text-center">
                                    <p>Momentan nu exista parinti inregistrati</p>
                                </td>
                            </tr>
                        @endforelse
                    </thead>
                </table>
                {{ $tutors->links() }}
            </div>
        </div>
    </div>
</div>
@endsection