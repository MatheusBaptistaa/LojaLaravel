<!-- resources/views/carrinho.blade.php -->

<h1>Seu Carrinho</h1>

<div class="card_produtos">
                                @foreach ($produtos as $produto)
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="card text-center text-bg-dark" style="width: 20rem;">
                                            <img src="https://static.wixstatic.com/media/0791cb_1f5071e374944f50a422d3880cd05d73.jpg/v1/fill/w_544,h_408,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/0791cb_1f5071e374944f50a422d3880cd05d73.jpg"
                                                class="card-img-top" alt="...">
                                            <h5 class="card-title">{{ $produto["nome"] }}</h5>
                                            <p class="card-text" id="descricao">Descrição: {{ $produto["descricao"] }}
                                            </p>
                                            <p class="card-text" id="preco">Preço: {{ $produto["preco"] }}</p>
                                            <p class="card-text" id="quantidade">Quantidade: {{ $produto["quantidade"]
                                                }}</p>
                                            <p class="card-text" id="marca">Marca: {{ $produto["marnome"] }}</p>
                                            <p class="card-text" id="categoria">Categoria: {{ $produto["catnome"] }}</p>
                                            <a style="text-decoration:none;"
                                                href="./detalhesproduto.php?item={{ $produto[" item"] }}">
                                                <div class="card-body"> Adicionar no Carrinho
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

<a href="{{ route('produtos.prodcar') }}">Continuar Comprando</a>
