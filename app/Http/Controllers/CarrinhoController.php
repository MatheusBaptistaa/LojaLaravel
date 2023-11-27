<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function adicionarAoCarrinho($produto)
    {
        // Adicione o produto ao carrinho (você pode armazenar no banco de dados, na sessão, etc.)
        // Exemplo básico usando a sessão
        session()->push('carrinho', $produto);

        return redirect()->route('produtos.index')->with('mensagem', 'Produto adicionado ao carrinho com sucesso.');
    }
}
