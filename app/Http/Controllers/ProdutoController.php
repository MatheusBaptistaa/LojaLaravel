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
        $produto->descricao = html_entity_decode(strip_tags($request->input('descricao')));

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

    public function clientes(Request $request) {
        $marcaSelecionada = $request->input('id_marca');
        $categoriaSelecionada = $request->input('id_categoria');
        $marcas = Marca::all()->toArray();
        $categoria = Categoria::all()->toArray();
    
        $produtosQuery = Produto::select(
                "produto.id",
                "produto.nome",
                "produto.quantidade",
                "produto.preco",
                "categoria.nome AS catnome",
                "marca.nome AS marnome",
                "produto.descricao"
            )
            ->join("categoria", "categoria.id", "=", "produto.id_categoria")
            ->join("marca", "marca.id", "=", "produto.id_marca");
    
        // Se uma marca foi selecionada, filtre os produtos por essa marca
        if ($marcaSelecionada !== null) {
            // Certifique-se de que $marcaSelecionada é um array
            $marcaSelecionada = is_array($marcaSelecionada) ? $marcaSelecionada : [$marcaSelecionada];
    
            $produtosQuery = $produtosQuery->whereIn("marca.id", $marcaSelecionada);
        }
        if ($categoriaSelecionada !== null) {
            
            $categoriaSelecionada = is_array($categoriaSelecionada) ? $categoriaSelecionada : [$categoriaSelecionada];
    
            $produtosQuery = $produtosQuery->whereIn("categoria.id", $categoriaSelecionada);
        }
    
        $produtos = $produtosQuery->get();
    
        return view("Produto.clientes", [
            "produtos" => $produtos,
            'listaMarcas' => $marcas,
            "listaCategorias" => $categoria,
            "marca" => $marcaSelecionada
        ]);
    }
    
    
    
    public function prodcar()
    {
        $produtos = Produto::all();
        return view('produtos', ['produtos' => $produtos]);
    }

    public function adicionarAoCarrinho(Request $request, Produto $produto)
    {
        // Recuperar o carrinho da sessão (ou criar um novo, se não existir)
        $carrinho = session()->get('carrinho', []);

        // Adicionar o produto ao carrinho
        $carrinho[] = $produto->id;

        // Armazenar o carrinho de volta na sessão
        session(['carrinho' => $carrinho]);

        return redirect()->route('produtos.index')->with('success', 'Produto adicionado ao carrinho');
    }

    public function mostrarCarrinho()
    {
        // Recuperar o carrinho da sessão
        $carrinho = session('carrinho', []);

        // Recuperar os detalhes dos produtos no carrinho
        $produtosNoCarrinho = Produto::whereIn('id', $carrinho)->get();

        return view('carrinho', ['produtos' => $produtosNoCarrinho]);
    }
}
