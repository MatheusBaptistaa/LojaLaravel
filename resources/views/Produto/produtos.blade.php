<!-- resources/views/produtos.blade.php -->

<h1>Lista de Produtos</h1>

@foreach ($produtos as $produto)
    <div>
        <h2>{{ $produto->nome }}</h2>
        <p>{{ $produto->descricao }}</p>
        <p>Preço: ${{ $produto->preco }}</p>
        <form action="{{ route('adicionar-ao-carrinho', $produto->id) }}" method="post">
            @csrf
            <button type="submit">Adicionar ao Carrinho</button>
        </form>
    </div>
@endforeach

<a href="{{ route('mostrar-carrinho') }}">Ver Carrinho</a>
