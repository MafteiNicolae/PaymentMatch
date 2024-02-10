@extends('dashboard')
@section('title', 'Facturi')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="row">
                <div class="col-4 mt-3">
                    <div class="card mt-2 ms-5">
                        <h1 class="h2">Lista facturi</h1>
                    </div>
                </div>
                <div class="col-5 mt-3">
                    <a href="{{route('invoice.index')}}" class="btn btn-secondary">Deschise</a>
                    <a href="{{route('invoice.indexClosed')}}" class="btn btn-secondary">Inchise</a>
                </div>
                <div class="col-2 mt-3">
                    <form action="{{route('invoice.search')}}" method="GET">
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
                            <th>Numar</th>
                            <th>Suma</th>
                            <th>rest de plata</th>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Student</th>
                            <th>Actiuni</th>
                        </tr>
                        @forelse($invoices as $key=>$invoice)
                            <tr>
                                <td>{{$invoices->firstItem() + $key }}</td>
                                <td>{{$invoice->name}}</td>                               
                                <td>{{$invoice->numberInv}}</td>                               
                                <td>{{$invoice->amount}}</td>
                                <td>{{$invoice->rest}}</td>
                                <td>{{$invoice->dateInv}}</td>                               
                                <td>{{$invoice->status}}</td>                               
                                <td>{{$invoice->student->name}}</td>                               
                                <td>
                                    <a  class="btn btn-primary"
                                        href="{{route('invoice.addEdit', ['invoice' => $invoice->id])}}"
                                        >
                                        Modifica
                                    </a>
                                    <button  class="btn btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteInvoiceModal_{{$invoice->id}}"
                                        id="delete"
                                        >
                                        Sterge
                                    </button>
                                </td>
                            </tr>
                            @include('invoice.delete')
                        @empty
                        <tr>
                                <td colspan="8" class="text-center">
                                    <p>Momentan nu exista facturi inregistrate</p>
                                </td>
                            </tr>
                        @endforelse
                    </thead>
                </table>
                    {{ $invoices->links() }}
            </div>
        </div>
    </div>
</div>
@endsection