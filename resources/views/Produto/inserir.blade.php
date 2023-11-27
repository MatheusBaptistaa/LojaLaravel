@extends('TemplateAdmin.index')

@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Cadastro de Produto</h1>
    <div class="card">
        <div class="card-body">
            <form action="/produto/inserir" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column">
                @csrf
                <label><strong>Nome do Produto</strong></label>
                <input type="text" name="nome" style="margin-bottom: 10px" placeholder="Nome">

                <label><strong>Marca</strong></label>
                <select name="id_marca" style="margin-bottom: 10px" placeholder="Marca">
                    @foreach ($marcas as $dado)
                        <option value="{{ $dado['id'] }}">{{ $dado["nome"] }}</option>
                    @endforeach
                </select>


                <label><strong>Categoria</strong></label>
                <select name="id_categoria" style="margin-bottom: 10px">
                    @foreach ($categorias as $dado)
                        <option value="{{ $dado['id'] }}">{{ $dado["nome"] }}</option>
                    @endforeach
                </select>

                <label><strong>Preço</strong></label>
                <input type="text" name="preco" style="margin-bottom: 10px" placeholder="Preço">

                <label><strong>Quantidade</strong></label>
                <input type="text" name="quantidade" style="margin-bottom: 10px" placeholder="Quantidade">

                <label><strong>Descrição</strong></label>
                <textarea id="editDesc" name="descricao" style="margin-bottom: 10px" placeholder=""></textarea>

               <!-- <label for="image"><strong>Imagem</strong></label>
                <input type="file" id="image" name="imagem" style="margin-bottom: 10px" class="from-control-file">-->

                <div style="width: 100%; display: flex; justify-content: flex-end">
                    <button type="submit" class="btn btn-success" style="width: 10%">Inserir</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    ClassicEditor
        .create( document.querySelector( '#editDesc' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection