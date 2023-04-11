@extends('layouts.app')
@section('content')
<div class="wrapper">
    @if ( session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message')}}
    </div>
    @endif
    <div class="notif-head">
        <div class="alert alert-warning">
            <p> Please mark you presence before you mark notification as-read or you will be considered absent !!
        </div>
        <h1> Vos notification non lus </h1><br>
        @forelse( $notifications as $notif)
        <div class="alert alert-success" role="alert">
            [ {{ $notif->created_at->toDateTime()->format("d M Y H:i:s") }}] Teacher {{ $notif->data['firstName'] }} has started seance {{ $notif->data['seance'] }} for the module {{ $notif->data['module_Name'] }}
        </div>
        <!--  data-id='{{ $notif->id }}'    -->
        <div class="notifications">
            <form action="{{ route('markPresence') }}" method="POST">
                @csrf
                <input name='seance_id' type="hidden" value="{{ $notif->data['seance'] }}">
                <input name="module_id" type="hidden" value="{{ $notif->data['module'] }}">
                <button class="btn btn-success"> Mark your presence</button>
            </form><br>
            <a class="btn btn-primary" href="{{ url('ReadNotification/'. $notif->id ) }} "> Mark-as-read </a>
        </div>
    </div>
    @empty
    <div class="notifs">
        <p>Pas de nouvelles notifications</p><i class="fa fa-check"></i>
    </div>
    @endforelse

</div>
@endsection