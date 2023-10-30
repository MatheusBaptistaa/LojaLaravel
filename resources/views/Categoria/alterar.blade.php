@extends('TemplateAdmin.index')

@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Alterar Categoria</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categoria.alterar', ['id' => $categoria['id']]) }}" method="POST" style="display: flex; flex-direction: column">
                @csrf
                @method('PUT')

                <label>Nome da Marca</label>
                <input type="text" name="nome" style="margin-bottom: 10px" placeholder="Nome" value="{{ $categoria['nome'] }}">


                <label>Situação</label>
                <select name="situacao" style="margin-bottom: 10px">
                    <option value="1" {{ $categoria['situacao'] == 1 ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ $categoria['situacao'] == 0 ? 'selected' : '' }}>Inativo</option>
                </select>

                <div style="width: 100%; display: flex; justify-content: flex-end">
                    <button type="submit" class="btn btn-success" style="width: 10%">Alterar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
