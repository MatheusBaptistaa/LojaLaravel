<!-- resources/views/carrinho.blade.php -->

<h1>Seu Carrinho</h1>

@foreach ($produtos as $produto)
    <div>
        <h2>{{ $produto->nome }}</h2>
        <p>{{ $produto->descricao }}</p>
        <p>Preço: ${{ $produto->preco }}</p>
    </div>
@endforeach

<a href="{{ route('produtos.prodcar') }}">Continuar Comprando</a>
