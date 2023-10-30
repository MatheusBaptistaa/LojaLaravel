<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        $dados = Categoria::all()->toArray();
        return view('Categoria.index', [
            'listaCategorias' => $dados,
        ]);
    }
    public function inserir(){
        return view('Categoria.inserir');
    }
    public function inserirSubmit(Request $request){
        $request->validate([
            'nome' => 'required',
            'situacao' => 'required',
        ]);

        $categoria = new Categoria();
        $categoria->nome = $request->input('nome');
        $categoria->situacao = $request->input('situacao');
        $categoria->save();

        return redirect()->route('categoria.index')->with('success', 'Categoria inserida com sucesso.');
    }

    public function excluir($id){
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return redirect()->route('categoria.index')->with('error', 'Categoria não encontrada.');
        }

        $categoria->delete();

        return redirect()->route('categoria.index')->with('success', 'Categoria excluida com sucesso.');
    }
    public function alterar($id){
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return redirect()->route('categoria.index')->with('error', 'Categoria não encontrada.');
        }

        return view('Categoria.alterar', compact('categoria'));
    }

    public function alterarCategoria(Request $request, $id){
        $request->validate([
            'nome' => 'required',
            'situacao' => 'required',
        ]);
        $categoria = Categoria::find($id);

        $categoria->nome = $request->input('nome');
        $categoria->situacao = $request->input('situacao');
        $categoria->save();

        return redirect()->route('categoria.index')->with('success', 'Categoria editada com sucesso.');
    }
}
