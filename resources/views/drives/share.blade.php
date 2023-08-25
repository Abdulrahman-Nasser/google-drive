@extends('layouts.app')

@section('content')
   <div class="home">
    <div class="overlay"></div>
    <div class="container col-lg-6 py-5">

        @if (Session::has('done'))
            <div class="alert alert-success mx-auto text-center">{{ Session::get('done') }}</div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="table text-center">
                    <tr>
                        <th>id</th>
                        <th>Title</th>
                        <th colspan="4">Action</th>
                    </tr>
                    @forelse ($drive as $item)
                    
                    <tr>
                        <td> {{ $item->id }} </td>
                        <td> {{ $item->title }} </td>
                        <td><a href="{{route('drives.publicFile', $item->id)}}" class="btn btn-success Btn"><i class="bi bi-eye"></i></a></td>
                    </tr>
                       
                    @empty
                    <th colspan="4" class="text-danger text-center">Files Removed by authors</th>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
   </div>
@endsection
