<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\Models\Pharmacien;

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
        $pharmacien->mail = $request->input('mail');
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
        $pharmacien->mdp = Hash::make($tmp);

        $pharmacien->save();

        //envoiyer un mail password a l'utilisateur ajoutée
        $to_name = strtoupper($request->input('name'));
        $to_email = $request->input('mail');
        $data = array('name'=>$to_name, "mdp" => $tmp);
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

    public function salut(){
        Mail::send('emails.salutation', ['mdp' => '123'], function($message){
            $message->to('abderrahmenzenagui@gmail.com')->from('haha@gmail.com')->subject('hi');
        });

    }
}
