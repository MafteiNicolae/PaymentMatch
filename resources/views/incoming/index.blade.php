@extends('dashboard')
@section('title', 'Incasari')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="row">
                <div class="col-4 mt-3">
                    <div class="card mt-2 ms-5">
                        <h1 class="h2">Lista incasari</h1>
                    </div>
                </div>
                <div class="col-5 mt-3">
                <a href="{{route('incoming.index')}}" class="btn btn-secondary">Deschise</a>
                <a href="{{route('incoming.indexClosed')}}" class="btn btn-secondary">Inchise</a>
                <a class="btn btn-primary" href="{{route('incoming.match')}}">Match</a>
                </div>
                <div class="col-2 mt-3">
                    <form action="{{route('incoming.search')}}" method="GET">
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
                            <th>Suma</th>
                            <th>Suma neimprecheata</th>
                            <th>Factura</th>
                            <th>Actiuni</th>
                        </tr>
                        @forelse($incomings as $key=>$incoming)
                            <tr>
                                <td>{{$incomings->firstItem() + $key }}</td>
                                <td>{{$incoming->name}}</td>                                                          
                                <td>{{$incoming->amount}}</td>
                                <td>{{$incoming->due}}</td>
                                <td>
                                    <!-- {{$incoming->invoice_id ? $incoming->invoice_id : '-'}} -->
                                    @foreach($incoming->invoices as $inv)
                                        <p>{{$inv->name}} - {{$inv->numberInv}} - {{ $incoming->invoices->find($inv->id)->pivot->suma}} RON</p>
                                    @endforeach
                                </td>
                                <td>
                                    <a  class="btn btn-primary"
                                        href="{{route('incoming.addEdit', ['incoming' => $incoming->id])}}"
                                        >
                                        Modifica
                                    </a>
                                    <button  class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteIncomingModal_{{$incoming->id}}"
                                        id="delete"
                                        >
                                        Sterge
                                    </button>
                                </td>
                            </tr>
                            @include('incoming.delete')
                        @empty
                        <tr>
                                <td colspan="8" class="text-center">
                                    <p>Momentan nu exista incasari inregistrate</p>
                                </td>
                            </tr>
                        @endforelse
                    </thead>
                </table>
                    {{ $incomings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection