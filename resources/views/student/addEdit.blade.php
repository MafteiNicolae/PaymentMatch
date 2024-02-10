@extends('dashboard')
@section('title', 'Elev')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <!-- <div class="row"> -->
                <div class="card-body">
                    <h2 class="card-title">{{isset($student) ? 'Modifica' : 'Adauga' }}</h2>
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
                <form method="POST" action="{{route('students.storeUpdate', ['student' => $student?->id])}}">@csrf
                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Nume</label>
                        <div class="col-sm-10">
                            <input type="text" 
                                   name="name"
                                   class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" 
                                   placeholder="Nume elev"
                                   value="{{old('name') ?? $student?->name }}" />
                            <span class="error invalid-feedback">
                                @if($errors->has('name'))
                                    <p>{{$errors->first('name')}}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Grupa</label>
                        <div class="col-sm-10">
                            <select class="form-select {{$errors->has('group_id') ? 'is-invalid' : ''}}" name="group_id">
                            <option value="">-----Alege o grupa-----</option>
                                @foreach(App\Models\Group::all() as $group)
                                    <option value="{{$group->id}}" {{(old('group_id') ?? $student?->group_id == $group->id) ? 'selected' : ''}}>{{$group->name}}</option>
                                @endforeach
                            </select>
                            <span class="error invalid-feedback">
                                @if($errors->has('group_id'))
                                    <p>{{$errors->first('group_id')}}</p>
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