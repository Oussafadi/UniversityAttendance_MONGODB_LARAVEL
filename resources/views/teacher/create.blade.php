@extends('layouts.app')
@section('content')
<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <center>
        <h2 class="s-title"> Create new teacher</h2>
    </center>
    <div class="tableau">
        <form class="form-edit" method='POST' action="{{ route('Teachers.store') }}">
            @csrf
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input class="form-control" type="text" name='firstName' required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input class="form-control" type="text" name='lastName' required>
            </div>
            <div class="form-group">
                <label for="validationCustom04">Module</label>
                <select name="module_id" class="form-select" id="validationCustom04" required>
                    <option selected disabled value="">Available Modules</option>
                    @foreach($modules as $mdl)
                    <option value="{{$mdl->id}}">{{$mdl->designation}}</option>
                    @endforeach
                </select>
            </div>
            <div class="edit-buttons">
                <a class="btn btn-danger" href="{{ route('Teachers.index')}}"> Return </a>
                <button class="btn btn-success"> Modifier </button>
            </div>


    </div>
    </form>

</div>


</div>
@endsection