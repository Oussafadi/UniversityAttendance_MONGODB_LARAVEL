@extends('layouts.app')
@section('content')


<div class="wrapper">
    <div class="index-header">
        <center>
            <h1> Les listes des absences de votre module </h1>
        </center>
    </div>
    <div class="seances">
        <a class="btn btn-primary" href=" {{ url('Teacher/absence/seance/1') }}">Seance 1</a>
        <a class="btn btn-primary" href=" {{ url('Teacher/absence/seance/2') }}">Seance 2</a>
        <a class="btn btn-primary" href=" {{ url('Teacher/absence/seance/3') }}">Seance 3</a>
        <a class="btn btn-primary" href=" {{ url('Teacher/absence/seance/4') }}">Seance 4</a>
        <a class="btn btn-primary" href=" {{ url('Teacher/absence/seance/5') }}">Seance 5</a>
        <a class="btn btn-primary" href=" {{ url('Teacher/absence/seance/6') }}">Seance 6</a>
        <a class="btn btn-primary" href=" {{ url('Teacher/absence/seance/7') }}">Seance 7</a>
    </div>
</div>


@endsection