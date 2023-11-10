<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Marca;


class ProdutoController extends Controller
{
    public function index() {
        $produtos = Produto::select(
                "produto.id",
                "produto.nome",
                "produto.quantidade",
                "produto.preco",
                "categoria.nome AS catnome",
                "marca.nome AS marnome",
                "produto.descricao"
            )
            ->join("categoria", "categoria.id", "=", "produto.id_categoria")
            ->join("marca", "marca.id", "=", "produto.id_marca")
            ->get();
    
        return view("Produto.index", [
            "produtos" => $produtos
        ]);
    }    

    public function inserir() {
        $categorias = Categoria::all()->toArray();
        $marca = Marca::all()->toArray();
        return view("Produto.inserir", [
                                'categorias' => $categorias,
                                'marcas' => $marca
                            ]);
    }

    public function salvar_novo(Request $request) {

        $produto = new Produto();

        $produto->nome = $request->input("nome");
        $produto->id_categoria = $request->input("id_categoria");
        $produto->id_marca = $request->input("id_marca");
        $produto->preco = $request->input("preco");
        $produto->quantidade = $request->input("quantidade");
        $produto->descricao = $request->input("descricao");

        $produto->save();

        return redirect()->route("produto.index");
 
       }

       public function excluir($id){
        $produto = produto::find($id);
        if (!$produto) {
            return redirect()->route('produto.index')->with('error', 'produto não encontrada.');
        }

        $produto->delete();

        return redirect()->route('produto.index')->with('success', 'produto excluida com sucesso.');
    }

    public function atualizar(Request $request, $id) {
        $produto = Produto::find($id);
    
        if (!$produto) {
            return redirect()->route('produto.index')->with('error', 'Produto não encontrado.');
        }
    
        $produto->nome = $request->input('nome');
        $produto->id_categoria = $request->input('id_categoria');
        $produto->id_marca = $request->input('id_marca');
        $produto->preco = $request->input('preco');
        $produto->quantidade = $request->input('quantidade');
        $produto->descricao = html_entity_decode(strip_tags($request->input('descricao')));
    
        $produto->save();
    
        return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso.');
    }
    
    public function alterar($id) {
        $produto = Produto::find($id);
        $marca = Marca::find($produto['id_marca']);
        $categoria = Categoria::find($produto['id_categoria']);
        $categorias = Categoria::all()->toArray();
        $marcas = Marca::all()->toArray();
    
        if (!$produto) {
            return redirect()->route('produto.index')->with('error', 'Produto não encontrado.');
        }
    
        return view('produto.alterar', [
            'produto' => $produto,
            'marca' => $marca,
            'categoria' => $categoria,
            'listaCategorias' => $categorias,
            'listaMarcas' => $marcas,
        ]);
    }
}
