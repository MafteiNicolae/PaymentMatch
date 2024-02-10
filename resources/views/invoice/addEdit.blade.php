@extends('dashboard')
@section('title', 'Facturi')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ isset($invoice) ? 'Modifica' : 'Adauga' }} factura</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('invoice.storeUpdate', ['invoice' => $invoice?->id])}}"> @csrf
                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Nume</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   name="name"
                                   value="{{old('name') ?? isset($invoice) ? $invoice?->name : null}}"
                                   type="text"
                                   placeholder="Nume client"
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
                        <label for="name-input" class="col-sm-2 col-form-label">Numar factura</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('numberInv') ? 'is-invalid' : '' }}"
                                   name="numberInv"
                                   value="{{old('numberInv') ?? isset($invoice) ? $invoice?->numberInv : null}}"
                                   type="text"
                                   placeholder="Numar factura"
                                   id="name-input"
                            />

                            <span class="error invalid-feedback">
                                @if ($errors->has('numberInv'))
                                    <p>{{ $errors->first('numberInv') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Data emiterii</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('dateInv') ? 'is-invalid' : '' }}"
                                   name="dateInv"
                                   value="{{old('dateInv') ?? isset($invoice) ? $invoice?->dateInv : null}}"
                                   type="date"
                                   id="name-input"
                            />

                            <span class="error invalid-feedback">
                                @if ($errors->has('dateInv'))
                                    <p>{{ $errors->first('dateInv') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Suma</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                   name="amount"
                                   value="{{old('amount') ?? isset($invoice) ? $invoice?->amount : null}}"
                                   type="number"
                                   placeholder="400.00"
                                   id="test"
                                   {{isset($invoice) ? 'readonly' : '' }}
                            />

                            <span class="error invalid-feedback">
                                @if ($errors->has('amount'))
                                    <p>{{ $errors->first('amount') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <input type="hidden" name="rest" id="rest"   value="{{$invoice ? $invoice->rest : ''}}" >

                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                <option value="emisa" {{old('status', $invoice?->status) == "emisa" ? 'selected' : ''}}>Emisa</option>
                                <option value="incasata" {{old('status', $invoice?->status) == "incasata" ? 'selected' : ''}}>Incasata</option>
                            </select>

                            <span class="error invalid-feedback">
                                @if ($errors->has('status'))
                                    <p>{{ $errors->first('status') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Student</label>
                        <div class="col-sm-10">
                            <select name="student_id" class="form-control {{ $errors->has('student_id') ? 'is-invalid' : '' }}">
                                <option value="">----Alege student----</option>
                                @foreach(App\Models\Student::all() as $student)
                                    <option value="{{$student->id}}" {{old('student_id', $invoice?->student_id) == $student->id ? 'selected' : ''}}>{{$student->name}}</option>
                                @endforeach
                            </select>

                            <span class="error invalid-feedback">
                                @if ($errors->has('student_id'))
                                    <p>{{ $errors->first('student_id') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <button class="btn btn-success" type="submit">Salveaza</button>
                    <a class="btn btn-secondary" href="{{route('invoice.index')}}">Inapoi</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const invoiceAmount = document.getElementById('test');
    const rest = document.getElementById('rest');
        invoiceAmount.addEventListener('input', function(){
                console.log('test');
                rest.value = invoiceAmount.value;
            });
</script>
@endsection
