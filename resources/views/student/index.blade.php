@extends('layouts.app')
@section('content')

<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <!-- livewire('search-users') -->
    <div class="index-header">
        <h1> All the students </h1><br>
        <a class="btn btn-warning" role="button" href="{{route('google_email')}}">
            Send email to all users
        </a>
        <a class="mon-bouton" role="button" href="{{route('Students.create')}}">
            Add a new student
        </a>
    </div>
    <div class="tableau">
        <table class="table">
            <thead class="rass-tableau">
                <tr>
                    <th>First tName</th>
                    <th>last Name</th>
                    <th>Code Apogee</th>
                    <th>Admission Number</th>
                    <th>Filiere </th>
                    <th colspan="2"> Edit student</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td>{{ $student->firstName}}</td>
                    <td>{{ $student->lastName }}</td>
                    <td> {{ $student->code_ap }}</td>
                    <td> {{ $student->admissionNumber }}</td>
                    <td> {{ $filieres["$student->filiere_id"] }}</td>
                    <td>
                        <form method="POST" action="{{ route('Students.destroy', $student->id) }}" onsubmit="return confirm('Are you sure?');">
                            <a href="{{ url('Students/'.$student->id.'/edit')}}" class="btn btn-success" style="margin-left: 5px;" type="submit"> Edit <i class="fa fa-check" style="font-size: 15px;"></i> </a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 5px;" type="submit"><i class="fa fa-trash" style="font-size: 15px;"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <p> Students not found </p> <i class="fa fa-warning"></i>
                @endforelse
            </tbody>
        </table>

    </div>
</div>


@endsection