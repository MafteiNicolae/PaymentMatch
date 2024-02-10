@extends('dashboard')
@section('title', 'Profesori')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ isset($teacher) ? 'Modifica' : 'Adauga' }} profesor</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('teacher.storeUpdate', ['teacher' => $teacher?->id]) }}"> @csrf
                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Nume</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   name="name"
                                   value="{{old('name') ?? isset($teacher) ? $teacher->name : null}}"
                                   type="text"
                                   placeholder="Numele profesorului"
                                   id="name-input"
                            />

                            <span class="error invalid-feedback">
                                @if ($errors->has('name'))
                                    <p>{{ $errors->first('name') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <button class="btn btn-success" type="submit">Salveaza</button>
                    <a class="btn btn-secondary" href="{{route('users.index')}}">Inapoi</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection