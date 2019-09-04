<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Lot;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventes = Vente::all();
        return view('vente',compact('ventes'));
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
        //add vente
        $vente = new vente;
        $vente->date_vente = $request->input('date_v');
        $vente->quantite_vendu = $request->input('quantite_vendu');
        $vente->prix = $request->input('prix');
        $vente->id_prescription = $request->input('id_prescription');
        $vente->remarque = $request->input('remarque');
        $vente->pharmacien_id = 9;
        $vente->lot_id = $request->input('medicament_id');
        $vente->save();

        //update quantite_restante in achat table 
        $lot = Lot::find($request->input('medicament_id'));
        $lot->quantite_restante -= $request->input('quantite_vendu');
        $lot->save();

        return redirect('ventes')->with('message','vente ajoutée');
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
        Vente::destroy($id);
        return response()->json(['success'=>true]);
    }

    public function checkMedicament($id){
        $test = Lot::where('medicament_id',$id)->get();
        if ($test->isEmpty()) {
            return "rien";
        }
        return [$test[0]->quantite_restante, $test[0]->id];
    }
}
