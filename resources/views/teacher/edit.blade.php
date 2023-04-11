@extends('layouts.app')
@section('content')

<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <center>
        <h2 class="s-title"> Edit teacher</h2>
    </center>
    <div class="tableau">
        <form class="form-edit" method="POST" action="{{ route('Teachers.update',$teacher->id)}}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input class="form-control" type="text" name='firstName' value="{{$teacher->firstName}}" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input class="form-control" type="text" name='lastName' value="{{$teacher->lastName}}" required>
            </div>
            <div class="form-group">
                <label for="modules" class="form-label">Module</label>
                <select name="module_id" class="form-select" id="modules" required>
                    <option selected disabled value="">Available Modules</option>
                    @foreach($module as $mdl)
                    <option value="{{$mdl->id}}">{{$mdl->designation}}</option>
                    @endforeach
                </select>
            </div>
            <div class="edit-buttons ">
                <a class="btn btn-danger" href="{{ route('Teachers.index')}}"> Return </a>
                <button class="btn btn-success"> Modifier </button>
            </div>
        </form>
    </div>

</div>


@endsection