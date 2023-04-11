@extends('layouts.app')
@section('content')
<div class="header">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <center>
                <h1 class="title"> Application <span>web</span> de gestion des <span>absences</span></h1>
            </center>
            <div class="title-button">
                <button class="boutons">
                    <a href=" {{ route('login') }} ">Login</a>
                </button>
                <button class="boutons">
                    <a href=" {{ route('register') }} ">Register</a>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection