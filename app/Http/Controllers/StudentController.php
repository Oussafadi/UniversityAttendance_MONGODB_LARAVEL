<?php

namespace App\Http\Controllers;

use App\Http\Livewire\UploadPhoto;
use App\Models\Filiere;
use App\Models\Student;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\GoogleMail;
use App\Models\Absence;
use Jenssegers\Mongodb\Query\Builder;
use Jenssegers\Mongodb\Collection;



class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        $filieres = $this->Designations();
        return view('student.index', compact('students'))->with('filieres', $filieres);
    }

    /**
     * Get all of the student absences.
     *
     * @return \Illuminate\Http\Response
     */

    public function absence()
    {
        $user = Auth::user();
        /* $data = DB::table('users')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->join('absences', 'students.admissionNumber', '=', 'absences.admissionNo')
            ->join('modules', 'modules.id', '=', 'absences.module_id')
            ->select('modules.designation', 'absences.*')
            ->where('absences.status', '=', 'absent')
            ->where('users.id', '=', $user->id)
            ->get();        
        */

        $user = DB::collection('users')->where('_id', $user->id)->first();
        $student = DB::collection('students')->where('user_id', (string)$user['_id'])->first();
        // Get the absences for the student
        $absences = DB::collection('absences')
            ->where('admissionNo', $student['admissionNumber'])
            ->where('status', 'absent')
            ->get();
        //dd($absences);

        // Get the modules for the absences
        $moduleIds = $absences->pluck('module_id')->unique()->toArray();
        $modules = DB::collection('modules')->whereIn('_id', $moduleIds)->get();

        $data = $absences->map(function ($absence) use ($modules) {
            $module = $modules->where('_id', $absence['module_id'])->first();
            return [
                'designation' => $module['designation'],
                'admissionNo' => $absence['admissionNo'],
                'filiere_id' => $absence['filiere_id'],
                'module_id' => $absence['module_id'],
                'status' => $absence['status'],
                'seance' => $absence['seance'],
                'created_at' => $absence['created_at']->toDateTime()->format("d M Y H:i:s"),
                //'date' => $absence['date'],
            ];
        });


        return view('student.absence', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filieres = Filiere::all();
        return view('student.create')->with('filieres', $filieres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'code_ap' => 'required',
            'admissionNumber' => 'required',
            'filiere_id' => 'required'
        ]);

        $student = new student();
        $student->firstName = $request->input('firstName');
        $student->lastName = $request->input('lastName');
        $student->code_ap = $request->input('code_ap');
        $student->admissionNumber = $request->input('admissionNumber');
        $student->filiere_id = $request->input('filiere_id');
        $user_id = user::where('name', '=', $request->input('firstName'))->first()->id;
        $student->user_Id = $user_id;
        $student->save();
        return redirect()->back()->with('message', 'The Student was succesfully stored');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Currently no need for this method
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $filiere = Filiere::all();
        return view('student.edit', compact('student'))->with('filiere', $filiere);
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

        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'code_ap' => 'required',
            'admissionNumber' => 'required',
            'filiere_id' => 'required'
        ]);


        $student = Student::find($id);
        $student->firstName = $request->input('firstName');
        $student->lastName = $request->input('lastName');
        $student->code_ap = $request->input('code_ap');
        $student->admissionNumber = $request->input('admissionNumber');
        $student->filiere_id = $request->input('filiere_id');
        $user_id = user::where('name', '=', $request->input('firstName'))->first()->id;
        $student->user_Id = $user_id;
        $student->save();

        return redirect()->back()->with('message', 'The Student was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->back()->with('message', 'The Student was deleted');
    }


    public function Profile()
    {
        $cond = File::where('user_id', '=', Auth::user()->id)->first();
        $photo = '';
        if (!empty($cond)) {
            $photo = File::where('user_id', '=', Auth::User()->id)->first()->fileName;
        }
        $student = Student::where('user_id', 'like', Auth::User()->id)->first();
        return view('Student', compact('student', 'photo'));
    }

    public function Designations()
    {
        /*  $filieres = DB::table('students')
            ->join('filieres', 'students.filiere_id', '=', 'filieres.id')
            ->select('filieres.id', 'filieres.Designation')
            ->get();
        */
        $filieres = DB::collection('students')
            ->get()
            ->map(function ($student) {
                $filiereId = $student['filiere_id'];
                $filiere = DB::collection('filieres')
                    ->where('_id', $filiereId)
                    ->first();
                return [
                    'id' => $filiere['_id'],
                    'Designation' => $filiere['Designation']
                ];
            });
        // dd($filieres);
        $designations = [];
        foreach ($filieres as $filiere) {
            if (!isset($designations[(string)$filiere['id']])) {
                $designations[(string)$filiere['id']] = $filiere['Designation'];
            }
        }
        return $designations;
    }

    public function createEmail()
    {
        return view('student.emailForm');
    }

    public function sendEmail(Request $request)
    {
        $this->validate($request, [

            'subject' => 'required',
            'to' => 'required|email',
            'messages' => 'required'
        ]);

        $user = Auth::user();
        //$email = $user->email;

        Mail::to($request->input('to'))
            ->send(new GoogleMail($request->input('subject'), $request->input('messages')));


        return back()->with('message', 'Email succesfully sent !');
    }
}
