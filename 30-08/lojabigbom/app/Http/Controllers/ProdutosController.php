<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;

class ProdutosController extends Controller
{

    private $qtdPorPagina = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prod = Produtos::orderBy('id','ASC')->paginate($this->qtdPorPagina);

        return view('produtos.index', compact('prod'))
                    ->with('i', ($request->input('page', 1  ) - 1) * $this->qtdPorPagina);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nome'  => 'required',
                                   'descricao' => 'required',
                                    'preco' =>'required']);

        $input = $request->all();
        $produto = Produtos::create($input);

        return redirect()->route('produtos.index')->with('success','Produto cadastrado com successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produtos::find($id);
        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produtos::find($id);
        return view('produtos.edit', compact('produto'));
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
        $this->validate($request, [ 'nome'  => 'required',
                                    'descricao' => 'required',
                                    'preco' =>'required']);

        $produto = Produtos::find($id);

        $input = $request->all();

        $produto->update($input);

        return redirect()->route('produtos.index')->with('success','Produto atualizado com successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produtos::find($id)->delete();
        return redirect()->route('produtos.index')->with('success','Vendedor removido com successo');
    }
}

