@extends('layouts.app')
@section('content')

<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <center>
        <h2 class="s-title"> Edit module</h2>
    </center>
    <div class="tableau">
        <form class="form-edit" method="POST" action="{{ route('Modules.update',$module->id)}}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="designation">Designation du module</label>
                <input class="form-control" type="text" name='designation' value="{{$module->designation}}" required>
            </div>
            <div class="form-group">
                <label for="filiere_id">id de la filiere</label>
                <input class="form-control" type="text" name='filiere_id' value="{{$module->filiere_id}}" required>
            </div>
            <div class="edit-buttons">
                <a class="btn btn-danger" href="{{ route('Modules.index')}}"> Return </a>
                <button class="btn btn-success"> Modifier </button>
            </div>
        </form>
    </div>
</div>


@endsection