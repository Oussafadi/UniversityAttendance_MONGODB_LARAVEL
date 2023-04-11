<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Query\Builder;
use Jenssegers\Mongodb\Collection;


class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();
        $filieres = $this->Filieres();
        return view('modules.index', compact('modules'))->with('filieres', $filieres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filieres = Filiere::all();
        return view('modules.create')->with('filieres', $filieres);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'designation' => 'required',
                'filiere_id'  => 'required'
            ]
        );

        $module = new Module();
        $module->designation = $request->input('designation');
        $module->filiere_id = $request->input('filiere_id');
        $module->save();
        return redirect()->back()->with('message', 'the module was successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module = Module::findorfail($id);
        return view('module.show', compact('module'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = Module::findorfail($id);
        return view('modules.edit', compact('module'));
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
        $this->validate(
            $request,
            [
                'designation' => 'required',
                'filiere_id'  => 'required'
            ]
        );

        $module = Module::findorfail($id);
        $module->designation = $request->input('designation');
        $module->filiere_id = $request->input('filiere_id');
        $module->save();

        return redirect()->back()->with('message', 'the module was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Module::findorfail($id);
        $module->delete();
        return redirect()->back()->with('message', 'The module was deleted');
    }

    public function Filieres()
    {
        // $filieres = DB::collection('modules');
        /*    ->join('filieres', 'modules.filiere_id', '=', 'filieres._id')
            ->select('filieres._id', 'filieres.Designation')
            ->get();
          */

        //  dd($filieres);

        // Get the modules with their related filieres
        $modules = DB::collection('modules')
            ->where('filiere_id', '!=', null)
            ->get();

        // Get the filieres related to the modules
        $filiereIds = $modules->pluck('filiere_id')->unique()->toArray();
        $filieres = DB::collection('filieres')
            ->whereIn('_id', $filiereIds)
            ->get();

        // Combine the data into a single result set
        $filieresById = $filieres->keyBy('_id')->map(function ($filiere) {
            return [
                'id' => $filiere['_id'],
                'Designation' => $filiere['Designation'],
            ];
        });

        $results = collect();
        foreach ($modules as $module) {
            if (isset($filieresById[$module['filiere_id']])) {
                $filieresData = $filieresById[$module['filiere_id']];
                $results->push([
                    'filiere_id' => $filieresData['id'],
                    'Designation' => $filieresData['Designation'],
                ]);
            }
        }

        // Result
        // dd($results);

        $designations = [];
        foreach ($results as $res) {
            if (!isset($designations[(string)$res['filiere_id']])) {
                $designations[(string)$res['filiere_id']] = $res['Designation'];
            }
        }
        // dd($designations);
        return $designations;

        /*  $designations = [];
        foreach ($filieres as $filiere) {
            $designations["$filiere->id"] = $filiere->Designation;
        }
        return $designations;
        */
    }
}
