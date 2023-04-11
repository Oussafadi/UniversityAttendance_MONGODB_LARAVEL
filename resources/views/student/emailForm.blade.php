@extends('layouts.app')
@section('content')

<div class="wrapper">
    <div class="alert alert-success">
        @if(session()->has('message'))
        <div class="alert alert-succes" style="text-align: center;">
            {{ session()->get('message') }}
        </div>
        @endif
    </div>
    <center>
        <h2 class="s-title"> Send Email</h2>
    </center>
    <div class='tableau'>
        <form class="form-edit" action="{{ route('send.mail') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="to"> To </label>
                <input type="email" name="to" class="form-control" placeholder="Enter the recipient Email">
                @error('email')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="">Subject:</label>
                <input type="text" name="subject" class="form-control" placeholder="Enter subject">
                @error('subject')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

            <div class="form-group">
                <strong>Message:</strong>
                <textarea name="messages" rows="5" class="form-control" placeholder="Enter Your Message"></textarea>
                @error('messages')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="edit-buttons">
                <button type="submit" class="btn btn-success">Envoyer</button>
                <a class="btn btn-danger" href="{{ url('Profile')}}"> Return </a>

            </div>


        </form>
    </div>
</div>
@endsection