@extends('TemplateAdmin.index')

@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Alterar Cor</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('cor.alterar', ['id' => $cor['id']]) }}" method="POST" style="display: flex; flex-direction: column">
            @csrf
                @method('PUT')

                <label>Nome da Cor</label>
                <input type="text" name="cor" style="margin-bottom: 10px" placeholder="Nome" value="{{ $cor['cor'] }}">

                <label>Situação</label>
                <select name="situacao" style="margin-bottom: 10px">
                    <option value="1" {{ $cor['situacao'] == 1 ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ $cor['situacao'] == 0 ? 'selected' : '' }}>Inativo</option>
                </select>

                <div style="width: 100%; display: flex; justify-content: flex-end">
                    <button type="submit" class="btn btn-success" style="width: 10%">Alterar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
