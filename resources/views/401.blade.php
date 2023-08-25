@extends('layouts.app')

@section('content')
    <div class="home_auth">
        <div class="container p-5 text-center">
            <div class="row google">
               <h1>Note : this page is not allowed for you</h1>
               <img src="{{asset('img/401-Unauthorized-t.jpg')}}" alt="">
            </div>
        </div>
    </div>
@endsection
