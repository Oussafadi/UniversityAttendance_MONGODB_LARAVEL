@extends('layouts.app')
@section('content')

<div class="wrapper">
    <div class="profile">
        <div>
            @if(!empty($photo))
            <img class="profile-img" src="{{ asset('storage/'.$photo) }}" alt="profile">
            @endif
        </div>
        <h1 class="s-title"> {{ $user->name }} </h1>
    </div>

    <center>
        <h2 class="s-title"> User informations </h2>
    </center>
    <div class="tableau">
        <table class="table">
            <thead class="rass-tableau">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->name}}</td>
                    <td>{{ $user->email }}</td>
                    <td> {{ $user->password }}</td>
                    <td>
                        <form method="POST" action="" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="margin-left: 5px;" type="submit"><i class="fa fa-trash" style="font-size: 15px;"></i></button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><br>
</div>

@endsection