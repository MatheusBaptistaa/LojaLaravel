@extends('TemplateAdmin.index')

@section('contents')
<h1 class="h3 mb-4 text-gray-800">Alterar Produto</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('produto.atualizar', ['id' => $produto['id']]) }}" method="POST"
            style="display: flex; flex-direction: column">
            @csrf
            @method('PUT')

            <label>Nome do Produto</label>
            <input type="text" name="nome" value="{{$produto['nome']}}" style="margin-bottom: 10px" placeholder="Nome">

            <label>Marca</label>
            <select name="id_marca" style="margin-bottom: 10px" placeholder="Marca">
                @foreach ($listaMarcas as $dado)
                <option value="{{ $dado['id'] }}" @if(isset($marca) && $dado['id']==$marca['id']) selected @endif>{{
                    $dado["nome"] }}</option>
                @endforeach
            </select>



            <label>Categoria</label>
            <select name="id_categoria" style="margin-bottom: 10px">
                @foreach ($listaCategorias as $dado)
                <option value="{{ $dado['id'] }}">{{ $dado["nome"] }}</option>
                @endforeach
            </select>

            <label>Preço</label>
            <input type="text" name="preco" value="{{$produto['preco']}}" style="margin-bottom: 10px"
                placeholder="Preço">

            <label>Quantidade</label>
            <input type="text" name="quantidade" value="{{$produto['quantidade']}}" style="margin-bottom: 10px"
                placeholder="Quantidade">

            <label>Descrição</label>
            <textarea id="editDesc" name="descricao" style="margin-bottom: 10px"
                placeholder="Descrição">{{$produto['descricao']}}</textarea>


            <div style="width: 100%; display: flex; justify-content: flex-end">
                <button type="submit" class="btn btn-success" style="width: 10%">Alterar</button>
            </div>


        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#editDesc'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection