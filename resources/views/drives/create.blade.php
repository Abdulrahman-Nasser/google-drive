@extends('layouts.app')

@section('content')
    <div class="home">
        <div class="overlay"></div>
        <div class="container col-lg-6 py-5">

            <h1 class="text-center text-light">Upload File</h1>
            @if (Session::has('done'))
                <div class="alert alert-success mx-auto text-center">{{ Session::get('done') }}</div>
            @endif
            <div class="card animate__animated animate__fadeInUpBig">
                <div class="card-body">


                    <form action="{{ route('drives.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="animate__animated animate__fadeInUpBig"> File Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror animate__animated animate__fadeInUpBig" name="title"
                                value="{{ old('title') }}">
                            @error('title')
                                <div class="alert alert-danger bg-transparent text-danger mt-2 animate__animated animate__fadeInUpBig">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="animate__animated animate__fadeInUpBig"> File Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror animate__animated animate__fadeInUpBig"
                                name="description" value="{{ old('description') }}">
                            @error('description')
                                <div class="alert alert-danger bg-transparent text-danger mt-2 animate__animated animate__fadeInUpBig">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="animate__animated animate__fadeInUpBig"> File Upload</label>
                            <input type="file" class="form-control @error('fileUpload') is-invalid @enderror animate__animated animate__fadeInUpBig"
                                name="fileUpload" value="{{ old('fileUpload') }}">
                            @error('fileUpload')
                                <div class="alert alert-danger bg-transparent text-danger mt-2 animate__animated animate__fadeInUpBig">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary mt-3">Send Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
