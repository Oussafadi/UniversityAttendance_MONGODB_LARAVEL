@extends('layouts.app')
@section('content')
<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <center>
        <h2 class="s-title"> Create new student</h2>
    </center>
    <div class="tableau">
        <form class="form-edit" method='POST' action="{{ route('Students.store')}}">
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
                <label for="code_ap">Code Apogee</label>
                <input class="form-control" type="text" name='code_ap' required>
            </div>
            <div class="form-group">
                <label for="admissionNumber">Admission Number</label>
                <input class="form-control" type="text" name='admissionNumber' required>
            </div>

            <div class="form-group">
                <label for="filieres" class="form-label">Filiere</label>
                <select name="filiere_id" class="form-select" id="filieres" required>
                    <option selected disabled value="">Available Filieres</option>
                    @foreach($filieres as $flr)
                    <option value="{{$flr->id}}">{{$flr->Designation}}</option>
                    @endforeach
                </select>
            </div>
            <div class="edit-buttons ">
                <a class="btn btn-danger" href="{{ route('Students.index')}}"> Return </a>
                <button class="btn btn-success"> Ajouter </button>
            </div>


        </form>

    </div>


</div>
@endsection