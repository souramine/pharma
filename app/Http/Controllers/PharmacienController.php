<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\Models\Pharmacien;
use App\Models\Lot;
use Carbon\Carbon;
use App\Models\Vente;

class PharmacienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmaciens = Pharmacien::all();
        return view('pharmaciens',compact('pharmaciens'));
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
        $pharmacien = new Pharmacien;
        $pharmacien->name = strtoupper($request->input('name'));
        $pharmacien->email = $request->input('mail');
        $pharmacien->numero = $request->input('numero');
        $pharmacien->naissance = $request->input('naissance');
        $pharmacien->adresse = $request->input('adresse');
        $pharmacien->grade = $request->input('grade');
        $pharmacien->spe = $request->input('spe');
        if ($request->input('admin') != null) {
            $pharmacien->admin = 1;
        }else
            $pharmacien->admin = 0;

        $tmp = substr(md5(microtime()),rand(0,26),8);
        $pharmacien->password = Hash::make($tmp);

        $pharmacien->save();

        //envoiyer un mail password a l'utilisateur ajoutée
        $to_name = strtoupper($request->input('name'));
        $to_email = $request->input('mail');
        $data = array('name'=>$to_name, "password" => $tmp);
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Password');
        $message->from('ibrazen7@gmail.com','Password');
        });

        return redirect('pharmacien')->with('message','Pharmacien ajoutée');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pharmacien  $pharmacien
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacien $pharmacien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pharmacien  $pharmacien
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacien $pharmacien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pharmacien  $pharmacien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pharmacien $pharmacien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pharmacien  $pharmacien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pharmacien::destroy($id);
        return response()->json(['success'=>true]);
    }

    public function getDetailPharmacien($id){
        $pharmacien = Pharmacien::find($id);
        $list_achats = Lot::where('pharmacien_id',$id)->get(); 
        $list_achats_vente = Vente::where('pharmacien_id',$id)->get(); 

        $month = Carbon::now()->month;
        $subMonth= Carbon::now()->month - 1 ;
        $prix_month = 0 ; 
        $prix_subMonth = 0 ;
        $nbrAchat_month = 0 ;
        $nbrAchat_subbMonth = 0 ;

        $prix_month_vente = 0 ; 
        $prix_subMonth_vente= 0 ;
        $nbrVente_month = 0 ;
        $nbrVente_subbMonth = 0 ;

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

        foreach ($list_achats_vente as  $vente) {
            if ((int)explode('-', $vente->date_vente)[1] == $month) {
                $nbrVente_month ++ ;
                $prix_month_vente += $vente->prix;
            }
            elseif ((int)explode('-', $vente->date_vente)[1] == $subMonth) {
                $nbrVente_subbMonth ++ ;
                $prix_subMonth_vente += $vente->prix;
            }
        }

        return view('details.pharmacien',compact('pharmacien','list_achats','nbrAchat_month','nbrAchat_subbMonth','prix_month','prix_subMonth','prix_month_vente','prix_subMonth_vente','nbrVente_month','nbrVente_subbMonth','list_achats_vente'));
    }

}
