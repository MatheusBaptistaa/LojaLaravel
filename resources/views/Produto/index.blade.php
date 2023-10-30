@extends('TemplateAdmin.index')

@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Produtos Cadastrados</h1>

    <div class="card">
        <div class="card-body">
            <a href="/produto/inserir" class="btn btn-success" style="margin-bottom: 10px">Novo</a>
            <table class="table table-bordered dataTable">
                <thead>
                <td>ID</td>
                <td>Nome</td>
                <td>Marca</td>
                <td>Categoria</td>
                <td>Preço</td>
                <td>Quantidade</td>
                <td>Descrição</td>
            </thead>
            <tbody>
                @foreach ($produtos as $dados)
                    <tr>
                        <td>{{ $dados["id"] }}</td>
                        <td>{{ $dados["nome"] }}</td>
                        <td>{{ $dados["marnome"] }}</td>
                        <td>{{ $dados["catnome"] }}</td>
                        <td>{{ $dados["preco"] }}</td>
                        <td>{{ $dados["quantidade"] }}</td>
                        <td>{{ $dados["descricao"] }}</td>
                        <td>
                        <div style="display: flex; width: 100%">
                                <form style="margin-left: 20px"
                                      action="{{ route('produto.alterar', ['id' => $dados['id']]) }}" method="get">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn btn-success">
                                        Alterar
                                    </button>
                                </form>
                                <form style="margin-left: 20px"
                                      action="{{ route('produto.excluir', ['id' => $dados['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection
