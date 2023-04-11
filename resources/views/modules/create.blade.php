@extends('layouts.app')
@section('content')
<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <center>
        <h2 class="s-title"> Create new module</h2>
    </center>
    <div class="tableau">
        <form class="form-edit" method="POST" action="{{ route('Modules.store') }}">
            @csrf
            <div class="form-group">
                <label for="designation">Designation du module</label>
                <input class="form-control" type="text" name='designation' required>
            </div>
            <div class="form-group">
                <label for="filiere_id">Filiere ID</label>
                <input class="form-control" type="text" name='filiere_id' required>
            </div>
            <div class="edit-buttons">
                <a class="btn btn-danger" href="{{ route('Modules.index')}}"> Return </a>
                <button class="btn btn-success"> Ajouter </button>
            </div>
        </form>
    </div>
</div>

@endsection