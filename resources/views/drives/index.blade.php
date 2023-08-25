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
                        <th>status</th>
                        <th colspan="4">Action</th>
                    </tr>
                    @forelse ($drives as $item)
                    
                    <tr>
                        <td> {{ $item->id }} </td>
                        <td> {{ $item->title }} </td>
                        <td> {{ $item->status }} </td>
                        <td><a href="{{route('drives.show', $item->id)}}" class="btn btn-success Btn"><i class="bi bi-eye"></i></a></td>
                        <td><a href="{{route('drives.edit', $item->id)}}" class="btn btn-primary edit Btn "><i class="bi bi-pencil-square"></i></a></td>
                        <td><a href="{{route('drives.destroy', $item->id)}}" class="btn btn-danger delete Btn "><i class="bi bi-trash"></i></a></td>
                        <td><a href="{{route('drives.share',$item->id)}}" class="btn btn-primary edit Btn"><i class="bi bi-file-earmark-lock"></i></a></td>

                    </tr>
                       
                    @empty
                    <th colspan="4" class="text-danger text-center">No Drives Have been uploaded</th>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
   </div>
@endsection
