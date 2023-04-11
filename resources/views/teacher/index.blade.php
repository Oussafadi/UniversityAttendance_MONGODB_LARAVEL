@extends('layouts.app')
@section('content')

<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <!-- Livewire('search-users') -->
    <div class="index-header">
        <h1> All the teachers </h1><br>
        <a class="btn btn-warning" role="button" href="{{route('google_email')}}">
            Send email to all users
        </a>
        <a class="mon-bouton" role="button" href="{{route('Teachers.create')}}">
            Add a new Teacher
        </a>
    </div>
    <div class="tableau">
        <table class="table">
            <thead class="rass-tableau">
                <tr>
                    <th>First tName</th>
                    <th>last Name</th>
                    <th>Module</th>
                    <th colspan="2"> Edit teacher</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->firstName}}</td>
                    <td>{{ $teacher->lastName }}</td>
                    <td> {{ $modules["$teacher->module_id"] }}</td>
                    <td>
                        <form method="POST" action="{{ route('Teachers.destroy', $teacher->id) }}" onsubmit="return confirm('Are you sure?');">
                            <a href="{{ url('Teachers/'.$teacher->id.'/edit')}}" class="btn btn-success" style="margin-left: 5px;" type="submit">Edit <i class="fa fa-check" style="font-size: 15px;"></i> </a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 5px;" type="submit"><i class="fa fa-trash" style="font-size: 15px;"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <p>Teachers not found</p> <i class="fa fa-warning"></i>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection