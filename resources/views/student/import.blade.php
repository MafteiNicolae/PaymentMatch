@extends('dashboard')
@section('title', 'Elev')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <!-- <div class="row"> -->
                <div class="card-body">
                    <h2 class="card-title">Import elevi</h2>
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
                <form action="{{route('students.import')}}" method="POST" enctype="multipart/form-data">@csrf
                    <input class="form-control" type="file" name="file">
                    <button class="btn btn-secondary mt-3" type="submit">Adauga</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection