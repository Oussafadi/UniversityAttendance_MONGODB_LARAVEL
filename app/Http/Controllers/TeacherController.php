<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Module;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Query\Builder;
use Jenssegers\Mongodb\Collection;




class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $teachers = Teacher::all();
        $modules = $this->Designations();
        return view('teacher.index', compact('teachers'))->with('modules', $modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::all();
        return view('teacher.create', compact('modules'));
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
            'module_id' => 'required'
        ]);
        $teacher = new Teacher();
        $teacher->firstName = $request->firstName;
        $teacher->lastName = $request->lastName;
        $user_id = user::where('name', '=', $request->input('lastName'))->first()->id;
        $teacher->user_id = $user_id;
        $teacher->module_id = $request->module_id;
        $teacher->save();
        return redirect()->back()->with('message', 'Teacher added successfully');
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

        $teacher = teacher::findorfail($id);
        $module = Module::all();

        return view('teacher.edit', compact('teacher', 'module'));
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
            'module_id' => 'required'

        ]);
        $teacher = Teacher::findorfail($id);
        $teacher->firstName = $request->firstName;
        $teacher->lastName = $request->lastName;
        $user_id = user::where('name', '=', $request->input('lastName'))->first()->id;
        $teacher->user_id = $user_id;
        $teacher->module_id = $request->module_id;
        $teacher->save();
        return redirect()->back()->with('message', 'Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = teacher::findorfail($id);
        $teacher->delete();
        return redirect()->back()->with('message', 'Teacher deleted successfully');
    }

    public function Profile()
    {
        $photo = File::where('user_id', '=', Auth::User()->id)->first()->fileName;
        $user = Auth::user();
        $teacher = Teacher::where('user_id', 'like', Auth::User()->id)->first();
        /*  $designation = DB::table('teachers')
            ->join('modules', 'teachers.module_id', '=', 'modules.id')
            ->select('modules.designation')
            ->where('teachers.user_id', '=', $user->id)
            ->get();
            */
        $designation = "php";
        return view('Teacher', compact('teacher', 'designation', 'photo'));
    }
    public function Designations()
    {
        /*  $modules = DB::table('teachers')
            ->join('modules', 'teachers.module_id', '=', 'modules.id')
            ->select('modules.id', 'modules.designation')
            ->get();
        */

        $modules = DB::collection('teachers')
            ->get()
            ->map(function ($teacher) {
                $moduleId = $teacher['module_id'];
                $module = DB::collection('modules')
                    ->where('_id', $moduleId)
                    ->first();

                return [
                    'id' => $module['_id'],
                    'designation' => $module['designation']
                ];
            });
        //  dd($modules);

        $designations = [];
        foreach ($modules as $module) {
            if (!isset($designations[(string)$module['id']])) {
                $designations[(string)$module['id']] = $module['designation'];
            }
        }
        return $designations;
    }
}
