@extends('layouts.app')
@section('content')

<div class="wrapper">
    <div class="seance-action">
        <div class="divide">
            <h2>Commencer votre seance</h2>
            <form method="POST" action=" {{ url('Teacher/absence/seanceStart/'.$seance_id) }}">
                @csrf
                <button role="button" class=" btn btn-danger">Start seance</button>
            </form>
        </div>
        <div class="divide">
            <h2>Arreter votre seance</h2>
            <form method="POST" action=" {{ url('Teacher/absence/seanceEnd/'.$seance_id) }}">
                @csrf
                <button role="button" class="btn btn-danger">End seance</button>
            </form>
        </div>
    </div>

    <center>
        <h2 class="s-title"> La liste des etudiants absents de cette seance </h2>
    </center>
    @empty($absences[0]->status)
    <div class="alert alert-warning" style="text-align:center;">
        <h5> La seance n'a pas encore commencer</h5>
    </div>
    @endempty
    @if(!empty($absences[0]->status))
    <form method="POST" action="{{ route('teacher.absence.store') }}">
        <table class="table">
            <thead class="rass-tableau">
                <tr>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Code Apogee </th>
                    <th> Present </th>
                </tr>
            </thead>
            <tbody>

                @csrf
                @foreach($absences as $absence)
                <tr>
                    <td> {{ $absence->student()->firstName }} </td>
                    <td> {{ $absence->student()->lastName }} </td>
                    <td> {{ $absence->student()->code_ap }} </td>
                    <td>
                        @if( $absence->status == 'present' )
                        <label for="present">Present</label>
                        <input class="check-box" id="present" type="checkbox" name="absent[]" value=" {{ $absence->student()->id }}" checked>
                        @else
                        <label for="absent">Present</label>
                        <input class="check-box" id="absent" type="checkbox" name="absent[]" value="{{ $absence->student()->id }}">
                        @endif
                    </td>
                </tr>
                @endforeach
                <input type="hidden" value="{{ $seance_id }}" name="seance">
                <input style="float:right;" value="Enregistrer les absences" type="submit" class="mon-bouton">
            </tbody>
        </table>
    </form>
    @endif



</div>
</div>

@endsection