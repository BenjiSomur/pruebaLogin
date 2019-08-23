<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'correo' => 'required',
            'password' => 'required'
        ]);

        if(!is_null($request->input('password'))){

            $request->input('password') = hash("sha256", $request->input('password'));
        }

        Usuario::create($request->all());
        return redirect()->route('login.index')->with('success', 'Usuario registrado exitosamente')
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        return view('login.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre'=>'required',
            'apellidos'=>'required',
            'correo'=>'required',
            'password'=>'required'
        ]);

        if(!is_null($request->input('password'))){
            $request->input('password')=hash('sah256', $request->input('password'));
        }

        Usuario::update($request->all());

        return redirect()->route('login.index')->with('success', 'Usuario editado exitosamente, por favor vuelva a iniciar sesión');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('login.index'->with('success', 'Cuenta eliminada correctamente'));
    }
}
