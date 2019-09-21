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
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $medi = Medicament::find($id);
        $medi->nom = strtoupper($request->input('nom_modif'));
        $medi->famille = $request->input('famille_modif');
        $medi->voie = $request->input('voie_modif');
        $medi->forme = $request->input('forme_modif');
        $medi->dosage = $request->input('dosage_modif');
        $medi->unite = $request->input('unite_modif');
        if ($request->input('forme_modif') == 'Poudre') {
            $medi->volume = $request->input('volume_modif');
         $medi->unite_volume = $request->input('unite_vol_modif');
         $medi->solvant = $request->input('solvant_modif');
        }else{  
            
         $medi->volume = null;
         $medi->unite_volume = null;
         $medi->solvant = null;

        }
        
        $medi->save();

        return redirect('medicaments')->with('message2','Medicament modifier');

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

    public function getDetailMedi($id){
        $medi = Medicament::find($id);
        return [$medi];
    }

    
}
