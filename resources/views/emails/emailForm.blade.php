@extends('layouts.app')
@section('content')
<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align:center;">
        {{ session()->get('message')}}
    </div>
    @endif
    <div class="index-header">
        <h1>Email Form</h1>
    </div>
    <div class="tableau">
        <form class="form-edit email" action="{{ route('send.google_mail') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Subject:</label>
                <input type="text" name="subject" class="form-control" placeholder="Enter subject">
                @error('subject')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" name="messages" id="message" rows="4" placeholder="Message à envoyer ici"></textarea>
                @error('messages')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="edit-button">
                <button class="mon-bouton" type="submit">Envoyer</button>
            </div>
        </form>
    </div>
</div>
@endsection