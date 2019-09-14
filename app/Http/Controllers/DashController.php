<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lot;
use Carbon\Carbon;
use App\Models\Vente;
use App\Models\Pharmacien;
use App\Models\Fournisseur;

class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//récupérer nbr de vente par jour de dernier mois
    	//récupérer tt les ventes
    	$ventes = Vente::all();
    	$l= array();
        $ll= array();
    	for ($i=0; $i < 31; $i++) { 
    		$l[$i] = 0;
    	}
        for ($i=0; $i < 12; $i++) { 
            $ll[$i] = 0;
        }
    	$subMonthName= Carbon::now()->subMonth()->format('F');
        $annee = Carbon::now()->year;
    	$list= array();
    	for ($i=0; $i < 31 ; $i++) { 
    		$list[$i] = $subMonthName .' '.($i+1);
    	}

    	$subMonth= Carbon::now()->month - 1 ;

    	foreach ($ventes as  $key =>$vente){
    		if ((int)explode('-', $vente->date_vente)[1] == $subMonth){
    			$l[(int)explode('-', $vente->date_vente)[2]-1] = $l[(int)explode('-', $vente->date_vente)[2]-1] + 1;
    		}	
    	}
        foreach ($ventes as  $key =>$vente){
           $ll[(int)explode('-', $vente->date_vente)[1]] = $ll[(int)explode('-', $vente->date_vente)[1]] + $vente->prix;
        }
        $p = Pharmacien::all()->count();
        $f = Fournisseur::all()->count();
        $v = $ventes->count();
        $a = Lot::all()->count();
        return view('dash',compact('list','l','subMonthName','annee','ll','p','f','v','a'));

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
        //
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
