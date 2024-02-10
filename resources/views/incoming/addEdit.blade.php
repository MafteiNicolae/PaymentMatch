@extends('dashboard')
@section('title', 'Incasari')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ isset($incoming) ? 'Modifica' : 'Adauga' }} incasarea</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('incoming.storeUpdate', ['incoming' => $incoming?->id])}}"> @csrf
                    <div id="formIncomming">


                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Nume</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   name="name"
                                   value="{{old('name') ?? isset($incoming) ? $incoming?->name : null}}"
                                   type="text"
                                   placeholder="Nume platitor"
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
                        <label for="name-input" class="col-sm-2 col-form-label" id="blaSelect">Suma</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                   name="amount"
                                   value="{{old('amount') ?? isset($incoming) ? $incoming?->amount : null}}"
                                   type="number"
                                   placeholder="400.00"
                                   id="amount"
                                   {{isset($incoming) ? 'readonly' : ''}}
                            />

                            <span class="error invalid-feedback">
                                @if ($errors->has('amount'))
                                    <p>{{ $errors->first('amount') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>

                    <input type="hidden" name="due" id="due" value="{{$incoming ? $incoming->due : ''}}">

                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">Factura</label>
                        <div class="col-sm-10">
                            <select name="invoice_id[]" id="mySelect" class="form-control {{ $errors->has('invoice_id') ? 'is-invalid' : '' }}" multiple>
                                @foreach(App\Models\Invoice::orderBy('name', 'ASC')->get() as $invoice)
                                    <option value="{{$invoice->id}}" {{ in_array($invoice->id, old('invoice_id', [])) 
                                                                        ||(isset($incoming) && in_array($invoice->id, $incoming->invoices->pluck('id')->toArray())) ? 'selected' : ''}}>{{$invoice->name}} - {{$invoice->numberInv}}</option>
                                @endforeach
                            </select>

                            <span class="error invalid-feedback">
                                @if ($errors->has('invoice_id'))
                                    <p>{{ $errors->first('invoice_id') }}</p>
                                @endif
                            </span>
                        </div>
                    </div>


                    @php
                        $data = $incoming?->invoices;
                    @endphp

                    <div id="dynamicInputsContainer"></div>

                    </div>
                    <button class="btn btn-success" type="submit">Salveaza</button>
                    <a class="btn btn-secondary" href="{{route('incoming.index')}}">Inapoi</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

    const container = document.getElementById("dynamicInputsContainer");

        let dataJs = @json($data);
        console.log(dataJs);
    function displayInputs(){

        // console.log(dataJs);
        dataJs.forEach((dat) => {

            const label = document.createElement("label");
                label.classList.add = "mb-2";
                label.innerHTML = dat.name; 
            const newInput = document.createElement("input");
                    newInput.type = "number"; 
                    newInput.name = `values[${dat.id}]`;
                    newInput.value = dat.pivot.suma;
                    newInput.classList.add("form-control");
                    newInput.classList.add("mb-2");
                container.appendChild(label);
                container.appendChild(newInput);
        });
    }
    if(dataJs != null){
        displayInputs();
    }

    $(document).ready(function() {

        $('#mySelect').select2();
        
        $('#mySelect').on('change', function() {
            // console.log(dataJs.find((el) => el.id === 2));

            container.innerHTML = '';

            let selectedOptions = $('#mySelect').select2('data');

            selectedOptions.forEach(function(selectedOption) {
                // console.log(selectedOption);
                // console.log(dataJs.find((el) => el.id == selectedOption.id));
                const label = document.createElement("label");
                label.classList.add = "mb-2";
                label.innerHTML = selectedOption.text;
                const newInput = document.createElement("input");
                // if(dataJs.find((el) => el.id == selectedOption.id)){
                    if(dataJs!=null){
                        const asta = dataJs.find((el) => el.id == selectedOption.id);
                        if(asta!=null) {
                            newInput.value = asta.pivot.suma;
                        }
                    }
                    // console.log(asta);
                // } 
                newInput.type = "number";
                newInput.name = `values[${selectedOption.id}]`;
                newInput.classList.add("form-control");
                newInput.classList.add("mb-2");

                container.appendChild(label);
                container.appendChild(newInput);
            });
        });
    });
</script>
@endsection