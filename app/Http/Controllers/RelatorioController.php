<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginLog;
use App\Models\AcaoLog;
use App\Models\Compra;
use App\Models\CompraProduto;
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

    // public function logsCompraProduto()
    // {
    //     $compraProduto = CompraProduto::all();
    //     return view('log.compra', compact('compraProduto'));
    // }
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
            $query->where('valor_total', '>=' ,$request->input('valorMinimo'));
        }

        $this->datahoraRelatorio($request, $query);

        $compraLogs = $query->get();

         $relatorio = (object)['valorMinimo' => $request->valorMinimo, 'dataInicial' => $request->dataInicial, 'dataFinal' => $request->dataFinal];
        return view('log.compra')->with(['compraLogs' => $compraLogs, 'relatorio' => $relatorio]);
    }
}
