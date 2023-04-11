@extends('layouts.app')
@section('content')

<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <center>
        <h2 class="s-title"> Edit student</h2>
    </center>
    <div class="tableau">
        <form class="form-edit" method="POST" action="{{ route('Students.update',$student->id)}}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input class="form-control" type="text" name='firstName' value="{{$student->firstName}}" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input class="form-control" type="text" name='lastName' value="{{$student->lastName}}" required>
            </div>
            <div class="form-group">
                <label for="code_ap">Code Apogee</label>
                <input class="form-control" type="text" name='code_ap' value=" {{ $student->code_ap }} ">
            </div>
            <div class="form-group">
                <label for="number">Admission number</label>
                <input class="form-control" type="text" name='admissionNumber' value=" {{ $student->admissionNumber }} ">
            </div>
            <div class="form-group">
                <label for="filieres">Filiere</label>
                <select name="filiere_id" class="form-select" id="filieres" required>
                    <option selected disabled value="">Available Filieres</option>
                    @foreach($filiere as $flr)
                    <option value="{{$flr->id}}">{{$flr->Designation}}</option>
                    @endforeach
                </select>
            </div>
            <div class="edit-buttons ">
                <a class="btn btn-danger" href="{{ route('Students.index')}}"> Return </a>
                <button class="btn btn-success"> Modifier </button>
            </div>
        </form>
    </div>
</div>
@endsection