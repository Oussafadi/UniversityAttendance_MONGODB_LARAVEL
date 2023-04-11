@extends('layouts.app')
@section('content')

<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <center>
        <h2 class="s-title"> Edit filiere</h2>
    </center>
    <div class="tableau">
        <form class="form-edit" method="POST" action="{{ route('Filieres.update',$filiere->id)}}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="Designation">Designation de la filiere</label>
                <input class="form-control" type="text" name='Designation' value="{{$filiere->Designation}}" required>
            </div>
            <div class="edit-buttons ">
                <a class="btn btn-danger" href="{{ route('Filieres.index')}}"> Return </a>
                <button class="btn btn-success"> Modifier </button>
            </div>
        </form>
    </div>

</div>


@endsection