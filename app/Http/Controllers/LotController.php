<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\Medicament;


class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lots = Lot::all();
        return view('achat',compact('lots'));

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
        $achat = new lot;
        $achat->date_fabrication = $request->input('date_f');
        $achat->date_peremption = $request->input('date_p');
        $achat->date_achat = $request->input('date_a');
        $achat->quantite_acheter = $request->input('quantite_acheter');
        $achat->quantite_restante = $request->input('quantite_acheter');
        $achat->quantite_minimum = $request->input('quantite_minimum');
        $achat->prix = $request->input('prix');
        $achat->pharmacien_id = 9;
        $achat->fournisseur_id = (int)$request->input('fournisseur_id');
        $achat->medicament_id = (int)$request->input('medicament_id');
        $achat->save();

        return redirect('achats')->with('message','achat ajoutée');
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
        Lot::destroy($id);
        return response()->json(['success'=>true]);
    }

    function getDetailLot($id){
        $lot = Lot::find($id);
        $medicament = Medicament::find($lot->medicament_id);
        //dd($lot);
        return [$lot, $medicament];
    }
}
