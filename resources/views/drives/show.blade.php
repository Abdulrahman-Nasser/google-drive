@extends('layouts.app')

@section('content')
    <div class="home2">
        <div class="overlay2"></div>
        <div class="container col-lg-4 py-3">

            @if (Session::has('done'))
                <div class="alert alert-success mx-auto text-center">{{ Session::get('done') }}</div>
            @endif
            <div class="card">
                <img src="{{ asset('img/file.jpg') }}" class="" alt="File Not found">
                <div class="card-body">
                    <h5 class="card-title">File title : <span> {{ $drive->title }} </span></h5>
                    <hr>
                    <h5 class="card-title">File Description : <span> {{ $drive->description }} </span> </h5>
                    <hr>
                    <h5 class="card-title">File Name : <span> {{ $drive->file }} </span> </h5>
                    <hr>
                    <a href="{{ route('drives.download', $drive->id) }}" class="btn Btn btn-success m-auto mt-3">Download
                        <i class="bi bi-download"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
