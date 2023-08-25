@extends('layouts.app')

@section('content')
    <div class="home">
        <div class="overlay"></div>
        <div class="container col-lg-6 py-5">

            <h1 class="text-center text-light">Edit File</h1>
            @if (Session::has('done'))
                <div class="alert alert-success mx-auto text-center">{{ Session::get('done') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('drives.update',$drive->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for=""> File Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                value="{{ $drive->title }}">
                            @error('title')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""> File Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" value="{{ $drive->description }}">
                            @error('description')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for=""> File Upload : {{$drive->file }}</label>
                            <input type="file" class="form-control @error('fileUpload') is-invalid @enderror"
                                name="fileUpload" value="{{ old('fileUpload') }}">
                            @error('fileUpload')
                                <div class="alert alert-danger mt-3 ">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="send text-center">
                            <button class="btn btn-warning mt-3">Update Data</button>
 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
