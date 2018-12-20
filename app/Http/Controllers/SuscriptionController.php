<?php

namespace App\Http\Controllers;

use App\Suscription;
use App\System;
use App\User;
use Illuminate\Http\Request;

class SuscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $suscriptions = Suscription::where('user_id', auth()->user()->id)->get();
    
        return view('suscription.index',compact('suscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $systems = System::all();
        $users = User::all();
        return view('suscription.create',['systems' => $systems,'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suscription = new Suscription();
        $data = $this->validate($request, [
            'system_id'=> 'required',
            'plan' => 'required'
        ]);
       
        $suscription->saveSuscription($data);
        return redirect('/suscriptions')->with('success', 'New suscription has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suscription  $suscription
     * @return \Illuminate\Http\Response
     */
    public function show(Suscription $suscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suscription  $suscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Suscription $suscription)
    {
        $suscription = Suscription::where('user_id', auth()->user()->id)
                        ->where('id', $id)
                        ->first();

        return view('user.edit', compact('suscription', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suscription  $suscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suscription $suscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suscription  $suscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suscription $suscription)
    {
        //
    }

}