@extends('layouts.app')
@section('content')
<div class="wrapper">
    <div class="index-header">
        <h2 class="s-title"> Vos absences </h2>
        <div>
            <a class="mon-bouton" href=" {{ route('student_profile') }}"> Your Profile</a>
        </div>
    </div>
    <section class="text-alert">
        <p> Vous pouvez envoyez un email a votre professeur si vous avez une justification pour votre absence <br>
            Le lien pour envoyez un email se trouve dans votre profile
        </p>

    </section>
    @empty($data[0]['designation'])
    <div class="alert alert-success" style="text-align: center;">
        <h5> Vous n'avez pas d'absences </h5>
    </div>
    @endempty

    @if (!empty($data[0]['designation']))
    <div class="tableau">
        <table class="table">
            <thead class="rass-tableau">
                <tr>
                    <th> Module </th>
                    <th> Seance </th>
                    <th> Status </th>
                    <th> Date </th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $data as $info)
                <tr>
                    <td> {{ $info['designation'] }}</td>
                    <td> {{ $info['seance'] }} </td>
                    <td> {{ $info['status'] }} </td>
                    <td> {{ $info['created_at'] }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
</div>

@endsection