<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Medicament;
use DB;

class MedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicaments = Medicament::all();
        return view('medicaments',compact('medicaments'));
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
        $medicament = new Medicament;
        $medicament->nom = strtoupper($request->input('nom'));
        $medicament->famille = $request->input('famille');
        $medicament->voie = $request->input('voie');
        $medicament->forme = $request->input('forme');
        $medicament->dosage = $request->input('dosage');
        $medicament->unite = $request->input('unite');
        $medicament->volume = $request->input('volume');
        $medicament->unite_volume = $request->input('unite_vol');
        $medicament->solvant = $request->input('solvant');
        $medicament->save();

        return redirect('medicaments')->with('message','Medicament ajoutée');
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
        Medicament::destroy($id);
        return response()->json(['success'=>true]);
    }
    /**
     * [getMedicamentNom description]
     * @return [type] [description]
     */
    public function getMedicamentNom(){
        $result = array();
        $sp1 = DB::table('medicaments')
              ->where('medicaments.nom','LIKE' , '%' . $_POST['phrase'] . '%')
              ->Orwhere('medicaments.dosage','LIKE' , '%' . $_POST['phrase'] . '%')
              ->Orwhere('medicaments.unite','LIKE' , '%' . $_POST['phrase'] . '%')
              ->limit(15)     
              ->get();
          $result =  $sp1; 
          return response()->json($result);
    }
}
