@extends('layouts.app')
@section('content')

<div class="wrapper">
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="profile">
        @if(!empty($photo))
        <img class="profile-img" src="{{ asset('storage/'.$photo) }}" alt="profile">
        @endif
        <h1 class="s-title"> {{ $teacher->firstName}} </h1>
    </div>

    <a style=" float:right" class="mon-bouton" href="{{ route('uploadFile') }}"> Add or Change your profile photo </a>
    <h2 class="s-title"> Vos informations </h2>

    <div class="tableau">
        <table class="table">
            <thead class="rass-tableau">
                <tr>
                    <th>First tName</th>
                    <th>last Name</th>
                    <th>Module</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $teacher->firstName}}</td>
                    <td>{{ $teacher->lastName }}</td>
                    <td> {{ $designation}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="edit-buttons">
        <a class="btn btn-primary" role="button" href="{{route('email')}}">
            Send an Email to a student
        </a>
        <a class="btn btn-success" role="button" href="{{route('subscribe_start')}}">
            Subscribe to the newsletter
        </a>
    </div>

</div>

@endsection