@extends('dashboard')
@section('title', 'Parinte')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <!-- <div class="row"> -->
                <div class="card-body">
                    <h2 class="card-title">{{isset($tutor) ? 'Modifica' : 'Adauga' }}</h2>
                </div>
                <!-- <div class="card-body col-8">
                    <form action="{{route('students.import')}}" method="POST" enctype="multipart/form-data">@csrf
                        <input class="form-control" type="file" name="file">
                        <button class="btn btn-secondary" type="submit">Adauga</button>
                    </form>
                </div> -->
            <!-- </div> -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('tutors.storeUpdate', ['tutor' => $tutor?->id])}}">@csrf
                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Nume</label>
                        <div class="col-sm-10">
                            <input type="text" 
                                   name="name"
                                   class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" 
                                   placeholder="Nume parinte"
                                   value="{{old('name') ?? $tutor?->name }}" />
                            <span class="error invalid-feedback">
                                @if($errors->has('name'))
                                    <p>{{$errors->first('name')}}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Elev</label>
                        <div class="col-sm-10">
                            <select class="form-select {{$errors->has('student_id') ? 'is-invalid' : ''}}" name="student_id" {{$tutor?->student_id ? 'disable' : ''}}>
                            <option value="">-----Alege un elev-----</option>
                                @foreach(App\Models\Student::all() as $student)
                                    <option value="{{$student->id}}" {{(old('student_id') ?? $tutor?->student_id == $student->id) ? 'selected' : ''}}>{{$student->name}}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">
                                @if($errors->has('student_id'))
                                    <p>{{$errors->first('student_id')}}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Salveaza</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection