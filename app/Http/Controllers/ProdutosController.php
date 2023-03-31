<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{

    public function index()
    {

        $produtos = Produtos::all();

        return view('produtos.index', compact('produtos'));
    }


    public function create()
    {
        return view('produtos.create');
    }


    public function store(Request $requisicao)
    {

        $produtos = new produto();


        $produtos->nome = $requisicao->nome;
        $produtos->valor = $requisicao->valor;
        $produtos->foto = $requisicao->foto;
        $produtos->descricao = $requisicao->descricao;


        $produtos->save();


        return redirect()->route('produtos.view', $produtos->id);
    }


    public function show(produtos $produtos)
    {

        return view('produtos.view', compact('produtos'));
    }


    public function edit(produtos $produtos)
    {

        return view('produtos.edit', compact('produto'));
    }


    public function update(Request $requisicao, Produto $produto)
    {

        $produto->update($requisicao->all());


        return redirect()->route('produtos.view', $produto>id);
    }


    public function destroy(produtos $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index');
    }
}
