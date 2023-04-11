<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Query\Builder;
use Jenssegers\Mongodb\Collection;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filieres = Filiere::all();
        return view('filieres.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('filieres.create');
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

                'Designation' => 'required'
            ]
        );

        $filiere = new Filiere();
        $filiere->Designation = $request->input('Designation');
        $filiere->save();
        return  redirect()->back()->with('message', 'The filiere was successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $filiere = Filiere::findorfail($id);
        return view('filieres.show', compact('filiere'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filiere = Filiere::findorfail($id);
        return view('filieres.edit', compact('filiere'));
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
            'Designation' => 'required'
        ]);

        $filiere = Filiere::findorfail($id);
        $filiere->Designation = $request->input('Designation');
        $filiere->save();
        return redirect()->back()->with('message', 'Filiere information was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filiere = Filiere::findorfail($id);
        $filiere->delete();
        return redirect()->back()->with('message', ' The selected Filiere was deleted');
    }
}
