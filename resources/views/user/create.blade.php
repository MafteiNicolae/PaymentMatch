@extends('dashboard')
@section('title', 'Utilizatori')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ isset($user) ? 'Modifica' : 'Adauga' }} utilizator</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('users.store', ['user' => isset($user) ? $user->id : null ]) }}"> @csrf
                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Nume</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   name="name"
                                   value="{{old('name') ?? isset($user) ? $user->name : null}}"
                                   type="text"
                                   placeholder="Numele utilizatorului"
                                   id="name-input"
                            />

                            <span class="error invalid-feedback">
                                @if ($errors->has('name'))
                                    <p>{{ $errors->first('name') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email-input" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   name="email"
                                   value="{{old('email') ?? isset($user) ? $user->email : null}}"
                                   type="email"
                                   placeholder="Adresa de e-mail"
                                   id="email-input"
                            />

                            <span class="error invalid-feedback">
                                @if ($errors->has('email'))
                                    <p>{{ $errors->first('email') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-input" class="col-sm-2 col-form-label">Parola</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   name="password"
                                   type="text"
                                   value="{{old('password')}}"
                                   placeholder="Parola"
                                   id="password-input"
                            />
                           
                            <span class="error invalid-feedback">
                                @if ($errors->has('password'))
                                    <p>{{ $errors->first('password') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="role-input" class="col-sm-2 col-form-label">Rol</label>
                        <div class="col-sm-10">
                            <select name="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}">
                                <option value="" >---- Alege rolul -----</option>
                                <option value=0 {{ isset($user) ? ($user->role == 0 ? 'selected' : "") : "" }} >Secretara</option>
                                <option value=1 {{ isset($user) ? ($user->role == 1 ? 'selected' : "") : "" }} >Administrator</option>
                            </select>

                            <span class="error invalid-feedback">
                                @if ($errors->has('role'))
                                    <p>{{ $errors->first('role') }}</p>
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