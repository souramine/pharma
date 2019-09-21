<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use DB;
use App\Models\Lot;
use Carbon\Carbon;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs',compact('fournisseurs'));
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
        $fournisseur = new Fournisseur;
        $fournisseur->name = strtoupper($request->input('name'));
        $fournisseur->mail = $request->input('mail');
        $fournisseur->numero_tel = $request->input('numero');
        $fournisseur->naissance = $request->input('naissance');
        $fournisseur->numero_reg = $request->input('numero_reg');
        $fournisseur->save();

        return redirect('fournisseur')->with('message','Fournisseur ajoutée');
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
        $fournisseur = Fournisseur::find($request->input('id'));
        $fournisseur->name = strtoupper($request->input('name_modif'));
        $fournisseur->mail = $request->input('mail_modif');
        $fournisseur->numero_tel = $request->input('numero_modif');
        $fournisseur->naissance = $request->input('naissance_modif');
        $fournisseur->numero_reg = $request->input('numero_reg_modif');
        $fournisseur->save();

        return redirect('fournisseur')->with('message2','Fournisseur modifier');
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
        Fournisseur::destroy($id);
        return response()->json(['success'=>true]);
    }

    public function getFournisseurNom(){
        $result = array();
        $sp1 = DB::table('fournisseurs')
              ->where('fournisseurs.name','LIKE' , '%' . $_POST['phrase'] . '%')
              ->Orwhere('fournisseurs.mail','LIKE' , '%' . $_POST['phrase'] . '%')
              ->Orwhere('fournisseurs.numero_tel','LIKE' , '%' . $_POST['phrase'] . '%')
              ->limit(15)     
              ->get();
          $result =  $sp1; 
          return response()->json($result);
    }

    public function getDetailFournisseur($id){
        $fourniseur = Fournisseur::find($id);
        $list_achats = Lot::where('fournisseur_id',$id)->get(); 
       
        $month = Carbon::now()->month;
        $subMonth= Carbon::now()->month - 1 ;
        $prix_month = 0 ; 
        $prix_subMonth = 0 ;
        $nbrAchat_month = 0 ;
        $nbrAchat_subbMonth = 0 ;

        foreach ($list_achats as  $achat) {
            if ((int)explode('-', $achat->date_achat)[1] == $month) {
                $nbrAchat_month ++ ;
                $prix_month += $achat->prix;
            }
            elseif ((int)explode('-', $achat->date_achat)[1] == $subMonth) {
                $nbrAchat_subbMonth ++ ;
                $prix_subMonth += $achat->prix;
            }
        }
        return view('details.fournisseur',compact('fourniseur','list_achats','nbrAchat_month','nbrAchat_subbMonth','prix_month','prix_subMonth'));
    }


    public function getFournisseur($id){
        $fourniseur = Fournisseur::find($id);
        return [$fourniseur];
    }
}
