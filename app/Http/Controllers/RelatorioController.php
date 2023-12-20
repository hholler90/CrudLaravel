<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginLog;
use App\Models\AcaoLog;
use App\Models\Compra;
use App\Models\CompraProduto;
use App\Models\Produto;
use DateTime;
use Auth;


class RelatorioController extends Controller
{

    public function logsLogin()
    {
        $loginLogs = LoginLog::all();
        $primeiroDiaMes = date('Y-m-01 00:00:00');
        $dataInicialFormatada = date('d/m/Y H:i', strtotime($primeiroDiaMes));
        $dataFinal = date('d/m/Y H:i');
        $relatorio = (object)[
            'acaoFiltro' => null,
            'dataInicial' => $dataInicialFormatada,
            'dataFinal' => $dataFinal
        ];
        return view('log.login')->with(['loginLogs' => $loginLogs, 'relatorio' => $relatorio]);
    }

    public function logsAcao()
    {
        $acaoLogs = AcaoLog::all();
        $primeiroDiaMes = date('Y-m-01 00:00:00');
        $dataInicialFormatada = date('d/m/Y H:i', strtotime($primeiroDiaMes));
        $dataFinal = date('d/m/Y H:i');
        $relatorio = (object)[
            'acaoFiltro' => null,
            'dataInicial' => $dataInicialFormatada,
            'dataFinal' => $dataFinal
        ];

        return view('log.acao')->with(['acaoLogs' => $acaoLogs, 'relatorio' => $relatorio]);
    }

    public function logsCompraProduto($id)
    {

        $compraProduto = CompraProduto::with('produto')->where('compra_id', '=', $id)->get();

        $listaProdutoId = $compraProduto->lists('produto_id')->toArray();

        $produto = Produto::whereIn('id', $listaProdutoId)
            ->orderBy('nome', 'desc')
            ->get()
            ->lists('nome', 'id')
            ->put('', 'Todos os Produtos')
            ->reverse()
            ->toArray();

        $relatorio = (object)[
            'id' => $id,
            'acaoFiltro' => null
        ];
        return view('log.compraProduto')->with(['compraProduto' => $compraProduto, 'relatorio' => $relatorio, 'produto' => $produto]);
    }
    public function logsCompra()
    {
        $compraLogs = Compra::with('usuario')->get();
        $primeiroDiaMes = date('Y-m-01 00:00:00');
        $dataInicialFormatada = date('d/m/Y H:i', strtotime($primeiroDiaMes));
        $dataFinal = date('d/m/Y H:i');
        $relatorio = (object)[
            'acaoFiltro' => null,
            'dataInicial' => $dataInicialFormatada,
            'dataFinal' => $dataFinal
        ];
        return view('log.compra')->with(['compraLogs' => $compraLogs, 'relatorio' => $relatorio]);
    }

    private function datahoraRelatorio(Request $request, $query)
    {


        $dataInicial = $request->has('dataInicial');
        $dataFinal = $request->has('dataFinal');


        if ($dataInicial || $dataFinal) {
            $dataInicial = explode(' ', $request->dataInicial);
            if (!isset($dataInicial[1])) {
                $dataInicial[1] = '00:00:00';
            }
            $dataInicial = implode(' ', $dataInicial);
            $dataInicial = strtotime(str_replace('/', '-', $dataInicial));

            $dataFinal = explode(' ', $request->dataFinal);
            if (!isset($dataFinal[1])) {
                $dataFinal[1] = '23:59:59';
            }
            $dataFinal = implode(' ', $dataFinal);

            $dataFinal = strtotime(str_replace('/', '-', $dataFinal));

            if ($dataInicial && $dataFinal) {
                $query->whereBetween('datahora', [$dataInicial, $dataFinal]);
            } elseif ($dataInicial) {

                $query->where('datahora', '>=', $dataInicial);
            } else {

                $query->where('datahora', '<=', $dataFinal);
            }
        }
        return $query;
    }

    public function filtroLogin(Request $request)
    {
        $query = LoginLog::query();
        $this->datahoraRelatorio($request, $query);

        if ($request->has('acaoFiltro')) {
            $query->where('acao', $request->input('acaoFiltro'));
        }

        $loginLogs = $query->get();

        $relatorio = (object)['acaoFiltro' => $request->acaoFiltro, 'dataInicial' => $request->dataInicial, 'dataFinal' => $request->dataFinal];
        return view('log.login')->with(['loginLogs' => $loginLogs, 'relatorio' => $relatorio]);
    }

    public function filtroAcao(Request $request)
    {
        $query = AcaoLog::query();
        $this->datahoraRelatorio($request, $query);

        if ($request->has('acaoFiltro')) {
            $query->where('acao', $request->input('acaoFiltro'));
        }
        if ($request->has('telaFiltro')) {
            $query->where('tela', $request->input('telaFiltro'));
        }

        $acaoLogs = $query->get();

        $relatorio = (object)['acaoFiltro' => $request->acaoFiltro, 'dataInicial' => $request->dataInicial, 'dataFinal' => $request->dataFinal, 'telaFiltro' => $request->telaFiltro];
        return view('log.acao')->with(['acaoLogs' => $acaoLogs, 'relatorio' => $relatorio]);
    }

    public function filtroCompra(Request $request)
    {
        $query = Compra::query();

        if ($request->has('valorMinimo')) {
            $query->where('valor_total', '>=', $request->input('valorMinimo'));
        }

        $this->datahoraRelatorio($request, $query);

        $compraLogs = $query->get();

        $relatorio = (object)['valorMinimo' => $request->valorMinimo, 'dataInicial' => $request->dataInicial, 'dataFinal' => $request->dataFinal];
        return view('log.compra')->with(['compraLogs' => $compraLogs, 'relatorio' => $relatorio]);
    }

    public function filtroCompraProduto(Request $request)
    {
        $query = CompraProduto::where('compra_id', '=', $request->id)->with('produto');
        $compraProduto = $query->get();
        if ($request->has('valorMinimo')) {
            $query->where('valor_total', '>=', $request->input('valorMinimo'));
        }
        if ($request->has('produtoFiltro')) {
            $query->where('produto_id', '=', $request->input('produtoFiltro'));
        }

        $logsCompraProduto = $query->get();
        $listaProdutoId = $compraProduto->lists('produto_id')->toArray();

        $produto = Produto::whereIn('id', $listaProdutoId)
            ->orderBy('nome', 'desc')
            ->get()
            ->lists('nome', 'id')
            ->put('', 'Todos os Produtos')
            ->reverse()
            ->toArray();

        $relatorio = (object)['valorMinimo' => $request->valorMinimo, 'id' => $request->id, 'produto' => $request->produto];
        return view('log.compraProduto')->with(['compraProduto' => $logsCompraProduto, 'relatorio' => $relatorio, 'produto' => $produto]);
    }

    public function produtoRelatorio()
    {

        $compra=CompraProduto::select(\DB::raw('produto_id,sum(quantidade) as qtd'))->groupBy('produto_id')->get()->lists('qtd','produto_id');
        $produtos=Produto::all()->map(function($produto) use ($compra){
            if(isset($compra[ $produto->id ]))
                $produto->qtd_vendido = $compra[ $produto->id ];
            else
                $produto->qtd_vendido = 0;
            return $produto;
        });
        
        $opcoes = "
        {
            type: 'bar',
            data: {
              labels: ['" . $produtos->lists('nome')->implode("','") . "'],
              datasets: [{
                label: 'Produtos Vendidos',
                data: [" . $produtos->lists('qtd_vendido')->implode(',') . "],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          }
        ";



        $opcoes2 = "
        {
            type: 'bar',
            data: {
              labels: ['" . $produtos->lists('nome')->implode("','") . "'],
              datasets: [{
                label: 'Estoque de Produtos',
                data: [" . $produtos->lists('quantidade')->implode(',') . "],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          }
        ";
        return view('log.produto')->with(['opcoes' => $opcoes,'opcoes2'=> $opcoes2]);
    }



    
}
