<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\SeanceStartingEvent;
use App\Models\Student;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StartSeanceNotification;
use App\Providers\SeanceStartingEvent as ProvidersSeanceStartingEvent;
use Jenssegers\Mongodb\Query\Builder;
use Jenssegers\Mongodb\Collection;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$absences = Absence::all();
        return view('teacher.absence');
    }

    public function markPresence(Request $request)
    {
        $student = auth()->user()->student;

        $notifications = DB::collection('notifications')
            //  ->where('data->seance', $request->input('seance_id'))
            // ->where('data->module', $request->input('module_id'))
            ->where('notifiable_id', auth()->user()->id)->get();

        if (!isset($notifications)) {
            return redirect()->back();
        }
        Absence::where('admissionNo', $student->admissionNumber)->where('seance', $request->input('seance_id'))
            ->where('module_id', $request->input('module_id'))->update(['status' => "present"]);
        return back()->with('message', ' You have successfully marked your presence');
    }

    public function seanceSheet($id, $absences = [])
    {
        $module =  Auth::user()->teacher->module->id;
        //dd($module);
        $absences = Absence::where('seance', '=', $id)->where('module_id', '=', $module)->get();
        $seance_id = $id;
        return view('teacher.seance', compact('seance_id'))->with('absences', $absences);
    }

    public function seanceStart($id)
    {
        $teacher = Auth::user()->teacher;
        $seance_id = $id;
        $students = $teacher->module->filiere->students;
        //dd($students);
        foreach ($students as $student) {
            if (DB::collection('absences')
                ->where('admissionNo', $student->admissionNumber)
                ->where('seance', $seance_id)
                ->where('module_id', $teacher->module->id)
                ->doesntExist()
            ) {
                $absence = new Absence();
                $absence->admissionNo = $student->admissionNumber;
                $absence->status = "absent";
                $absence->seance = $seance_id;
                $absence->filiere_id = $teacher->module->filiere->id;
                $absence->module_id = $teacher->module->id;
                $absence->save();
            }
        }
        $users = [];
        foreach ($students as $student) {
            $users[] = $student->user;
        }
        //  Notification::send($users, new StartSeanceNotification($seance_id, $teacher));
        event(new ProvidersSeanceStartingEvent($seance_id, $teacher));
        // ProvidersSeanceStartingEvent::dispatch($seance_id, $teacher);
        return $this->seanceSheet($id, $absence = []);
    }
    public function seanceEnd($id, $absences = [])
    {
        $teacher = Auth::user()->teacher;
        DB::collection('notifications')
            ->delete();
        $absences = Absence::where('module_id', $teacher->module->id)->where('seance', $id)->get();
        return $this->seanceSheet($id, $absences);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $absent = $request->input('absent');
        foreach ($absent as $id) {
            $student = Student::find($id);
            Absence::where('admissionNo', $student->admissionNumber)->update(['status' => "present"]);
        }
        // return to_route('teacher_profile');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
