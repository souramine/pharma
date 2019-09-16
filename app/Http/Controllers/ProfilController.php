<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pharmacien;
use App\Models\Lot;
use App\Models\Vente;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_achats = Lot::where('pharmacien_id',Auth::user()->id)->get(); 
        $list_achats_vente = Vente::where('pharmacien_id',Auth::user()->id)->get(); 
        return view('profile',compact('list_achats','list_achats_vente'));
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
        $nvmdp = '';

        $name = strtoupper($request->input('name'));
        $email = $request->input('mail');
        $numero = $request->input('numero');
        $naissance = $request->input('naissance');
        $adresse = $request->input('adresse');
        $grade = $request->input('grade');
        $spe = $request->input('spe');
        $mdp1 = $request->input('mdp1');

        if (isset($mdp1)){
            if (Hash::check($mdp1, Auth::user()->password)) {
                $mdp2 = $request->input('mdp2');
                $mdp3 = $request->input('mdp3');
                if ($mdp2 == $mdp3) {
                    $nvmdp = $mdp2;
                }else
                    return redirect('profile')->with('erreur2','Le nv mot de passe entrée n est pas identique');
            }
            else
                return redirect('profile')->with('erreur','Le mot de passe entré est incorrect');    
        }
        $pharma = Pharmacien::find(Auth::user()->id);
        $pharma->name = $name;
        $pharma->email = $email;
        $pharma->numero = $numero;
        $pharma->naissance = $naissance;
        $pharma->adresse = $adresse;
        if (isset($grade)) {
            $pharma->grade = $grade;
        }
        if (isset($spe)) {
            $pharma->spe = $spe;
        }
        if ($nvmdp != '') {
           $pharma->password = Hash::make($nvmdp);
        }
        $pharma->save();
        return redirect('profile')->with('message','sss');  
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
        //
    }
}
