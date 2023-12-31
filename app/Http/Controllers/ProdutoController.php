<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\AcaoLog;
use App\Models\Categoria;

use Auth;

class ProdutoController extends Controller
{
    private $log;
    private $objProduto;

    public function __construct()
    {
        $this->objProduto = new Produto();
        $this->log = new AcaoLog('Produto');
    }

    public function index()
    {
        return view('produto.index')->with([
            'produtos' => $this->objProduto->all(),
            'categorias' => Categoria::lists('nome', 'id'),
            'formulario' => new Produto()
        ]);
    }
    public function formulario($id)
    {
        return view('produto.formulario')->with([
            'formulario' => Produto::find($id),
            'categorias' => Categoria::lists('nome', 'id'),
        ]);
    }

    public function salvar(Request $request)
    {
        try {
            $req = $request->except(['_token', 'upload']);
            if (!empty($request->upload)) {
                $nomeArquivo = $request->upload->getClientOriginalName();
                $hash = sha1_file($request->upload->getRealPath());
                $extensao = $request->upload->getClientOriginalExtension();
                $nomeArquivoUnico = $hash . '.' . $extensao;
                $destino = public_path('imagens/') . $nomeArquivoUnico;

                if (!is_dir(public_path('imagens/'))) {
                    mkdir($destino, 0755, true);
                }
                $counter = 1;
                while (file_exists($destino)) {
                    $nomeArquivoUnico = $hash . '_' . $counter . '.' . $extensao;
                    $destino = public_path('imagens/') . $nomeArquivoUnico;
                    $counter++;
                }

                copy($request->upload->getRealPath(), $destino);
                $req['imagem'] = '/imagens/' . $nomeArquivoUnico;
            }

            $req['nome'] = trim($request->nome);
            $req['preco'] = trim($request->preco);
            $req['quantidade'] = trim($request->quantidade);
            try {
                $acao = 'Criar';
                if (!empty($req['id'])) {
                    $acao = 'Editar';
                    Produto::whereId($req['id'])->update($req);
                } else {
                    Produto::create($req);
                }

                $this->log->registrar($acao);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect('/produtos');
    }
    public function deletar($id)
    {
        if (!Auth::user()->temPermissao('del')) {
            abort(503);
        }
        $this->log->registrar('Delete');
        Produto::where("id", "=", $id)->delete();
        return redirect('/produtos');
    }
}
