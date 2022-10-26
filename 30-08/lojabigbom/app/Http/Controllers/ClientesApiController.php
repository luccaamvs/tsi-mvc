<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Clientes::all();
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
    $json = $request->getContent();
        return Clientes::create(
            json_decode($json, JSON_OBJECT_AS_ARRAY)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $clientes = Clientes::find($id);

        if($clientes){
            return $clientes;
        }else{
            return json_encode([$id => 'Não Existe']);
        }
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
        $clientes = Clientes::find($id);

        if($clientes){

            $json = $request->getContent();
            $atualizacao = json_decode($json, JSON_OBJECT_AS_ARRAY);
            $clientes->nome = $atualizacao['nome'];
            $clientes->endereco = $atualizacao['endereco'];
            $clientes->email = $atualizacao['email'];
            $clientes->telefone = $atualizacao['telefone'];
            $ret = $clientes->update() ? [$id => 'atualizado'] : [$id => 'erro ao atualizar'];
        }else{
            $ret = [$id => 'Não Existe'];
        }
        return json_encode($ret);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientes = Clientes::find($id);
        if($clientes){
            $ret = $clientes->delete() ? [$id => 'apagado'] : [$id => 'erro ao apagar'];
        }else{
            $ret = [$id => 'não existe'];
        }
        return json_encode($ret);
    }
}
