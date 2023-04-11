@extends('layouts.app')
@section('content')

<div class="wrapper">
    @if(session()->has('message'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="index-header">
        <h1> All the modules </h1>
        <a class="mon-bouton" role="button" href="{{route('Modules.create')}}">
            Add a new module
        </a>
    </div>
    <div class="tableau">
        <table class="table">
            <thead class="rass-tableau">
                <tr>
                    <th>id</th>
                    <th>Designation</th>
                    <th>Filiere</th>
                    <th colspan="2"> Edit Module </th>
                </tr>
            </thead>
            <tbody>
                @forelse($modules as $module)
                <tr>
                    <td>{{ $module->id}}</td>
                    <td>{{ $module->designation }}</td>
                    <td>{{ $filieres["$module->filiere_id"] }}</td>

                    <td>
                        <form method="POST" action="{{ route('Modules.destroy', $module->id) }}" onsubmit="return confirm('Are you sure?');">
                            <a href="{{ url('Modules/'.$module->id.'/edit')}}" class="btn btn-success" style="margin-left: 5px;" type="submit">Edit <i class="fa fa-check" style="font-size: 15px;"></i> </a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 5px;" type="submit"><i class="fa fa-trash" style="font-size: 15px;"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <p> Modules not found </p> <i class="fa fa-warning"></i>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection