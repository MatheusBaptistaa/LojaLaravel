<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;

class CorController extends Controller
{
    public function index(){
        $dados = Cor::all()->toArray();
        return view('Cor.index', [
            'listaCores' => $dados,
        ]);
    }
    public function inserir(){
        return view('Cor.inserir');
    }
    public function inserirSubmit(Request $request){
        $request->validate([
            'cor' => 'required',
            'situacao' => 'required',
        ]);

        $cor = new Cor();
        $cor->cor = $request->input('cor');
        $cor->situacao = $request->input('situacao');
        $cor->save();

        return redirect()->route('cor.index')->with('success', 'Cor inserida com sucesso.');
    }

    public function excluir($id){
        $cor = Cor::find($id);
        if (!$cor) {
            return redirect()->route('cor.index')->with('error', 'Cor não encontrada.');
        }

        $cor->delete();

        return redirect()->route('cor.index')->with('success', 'Cor excluida com sucesso.');
    }
    public function alterar($id){
        $cor = Cor::find($id);

        if (!$cor) {
            return redirect()->route('cor.index')->with('error', 'Cor não encontrada.');
        }

        return view('Cor.alterar', compact('cor'));
    }

    public function alterarCor(Request $request, $id){
        $request->validate([
            'cor' => 'required',
            'situacao' => 'required',
        ]);
        $cor = Cor::find($id);

        $cor->cor = $request->input('cor');
        $cor->situacao = $request->input('situacao');
        $cor->save();

        return redirect()->route('cor.index')->with('success', 'Cor editada com sucesso.');
    }
}
