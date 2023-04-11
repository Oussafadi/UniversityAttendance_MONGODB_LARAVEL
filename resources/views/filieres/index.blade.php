@extends('layouts.app')
@section('content')

<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="index-header">
        <h1> All the Filieres </h1>
        <a class="mon-bouton" role="button" href="{{route('Filieres.create')}}">
            Add a new Filiere
        </a>
    </div>
    <div class="tableau">
        <table class="table">
            <thead class="rass-tableau">
                <tr>
                    <th>id</th>
                    <th>Designation</th>
                    <th> Edit Filliere</th>
                </tr>
            </thead>
            <tbody>
                @forelse($filieres as $filiere)
                <tr>
                    <div class="d-flex justify-content-center">
                        <td>{{ $filiere->id}}</td>
                    </div>
                    <div class="d-flex justify-content-center">
                        <td>{{ $filiere->Designation }}</td>
                    </div>
                    <td>
                        <form method="POST" action="{{ route('Filieres.destroy', $filiere->id) }}" onsubmit="return confirm('Are you sure?');">
                            <a href="{{ url('Filieres/'.$filiere->id.'/edit')}}" class="btn btn-success" style="margin-left: 5px;" type="submit">Edit <i class="fa fa-check" style="font-size: 15px;"></i> </a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 5px;" type="submit"><i class="fa fa-trash" style="font-size: 15px;"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <p> Filieres not found</p> <i class="fa fa-warning"></i>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection