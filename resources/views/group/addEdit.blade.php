@extends('dashboard')
@section('title', 'Grupe')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{isset($group) ? 'Modifica' : 'Adauga' }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('group.storeUpdate', ['group' => $group?->id] )}}">@csrf
                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Nume</label>
                        <div class="col-sm-10">
                            <input type="text" 
                                   name="name"
                                   class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" 
                                   placeholder="Nume grupa"
                                   value="{{old('name') ?? $group?->name }}" />
                            <span class="error invalid-feedback">
                                @if($errors->has('name'))
                                    <p>{{$errors->first('name')}}</p>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Orar</label>
                        <div class="col-sm-10">
                            <input type="text" 
                                   name="shedule" 
                                   class="form-control {{$errors->has('shedule') ? 'is-invalid' : ''}}" 
                                   placeholder="Orar"
                                   value="{{old('shedule') ?? $group?->shedule}}"  />
                            <span class="error invalid-feedback">
                                @if($errors->has('shedule'))
                                    <p>{{$errors->first('shedule')}}</p>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Profesor</label>
                        <div class="col-sm-10">
                            <select class="form-select {{$errors->has('teacher_id') ? 'is-invalid' : ''}}" name="teacher_id">
                            <option value="">-----Alege un profesor-----</option>
                                @foreach(App\Models\Teacher::all() as $teacher)
                                    <option value="{{$teacher->id}}" {{(old('teacher_id') ?? $group?->teacher_id == $teacher->id) ? 'selected' : ''}}>{{$teacher->name}}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">
                                @if($errors->has('teacher_id'))
                                    <p>{{$errors->first('teacher_id')}}</p>
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