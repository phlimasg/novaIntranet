<?php

namespace App\Http\Controllers\Veiculos;

use App\Http\Controllers\Controller;
use App\Model\HereMaps;
use App\Model\Utilizacao;
use App\Model\Veiculo;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //$maps = new HereMaps("Rua Duarte Coelho, 130 Jardim Catarina");
        //$route = $maps->getTimeRoute($maps->geo,"-22.89704,-43.10657");
        //dd($maps->lng,$maps->lat, $route);
        $solicitacoes = Utilizacao::where('status','<>','Aguardando Coordenador')
        ->orderBy('updated_at','desc')
        ->orderBy('status','desc')
        ->limit('1000')
        ->paginate(10);
        /*
        foreach($solicitacoes as $i){
            $geoDestination = new HereMaps("{$i->rua}, {$i->numero} {$i->bairro} {$i->cidade} {$i->estado}");
            $geoOrigin = new HereMaps("{$i->veiculo->rua}, {$i->veiculo->numero} {$i->veiculo->bairro} {$i->veiculo->cidade} {$i->veiculo->estado}");
            //dd("{$i->veiculo->rua}, {$i->veiculo->numero} {$i->veiculo->bairro} {$i->veiculo->cidade} {$i->veiculo->estado}",$geoOrigin->geo);
            $rota = $geoOrigin->getTimeRoute($geoOrigin->geo,$geoDestination->geo);
            $i->tempo_estimado = $rota->baseDuration;
            $i->km_estimado = $rota->distance;
            $i->save();
            //dd($rota->duration,$i);
            //break;
        }*/
        
        return view('solicitacoes.index',[
            'solicitacoes' => $solicitacoes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        return view('solicitacoes.edit',[
            'solicitacao' => Utilizacao::find($id),
            'veiculos' => Veiculo::get(),
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $solicitacoes = Utilizacao::where('id', 'like',"%{$request->search}%")
        ->orWhere('motivo', 'like',"%{$request->search}%")
        ->orWhere('dt_entrega', 'like',"%{date('Y-m-d', strtotime($request->search))}%")
        ->orWhere('dt_hora_saida', 'like',"%{date('Y-m-d', strtotime($request->search))}%")
        ->orWhere('dt_hora_retorno', 'like',"%{date('Y-m-d', strtotime($request->search))}%")
        ->orWhere('cep', 'like',"%{$request->search}%")
        ->orWhere('rua', 'like',"%{$request->search}%")
        ->orWhere('bairro', 'like',"%{$request->search}%")
        ->orWhere('cidade', 'like',"%{$request->search}%")
        ->orWhere('coordenador_email', 'like',"%{$request->search}%")
        ->orWhere('status', 'like',"%{$request->search}%")
        ->orWhereIn('user_id', User::select('id')->where('name','like',"%{$request->search}%")->get())  
        ->orWhereIn('veiculo_id', 
            Veiculo::select('id')
            ->where('fabricante','like',"%{$request->search}%")
            ->orWhere('placa','like',"%{$request->search}%")
            ->orWhere('modelo','like',"%{$request->search}%")
            ->get()
            )  
        ->orderBy('updated_at','desc')
        ->orderBy('status','desc')      
        ->get();

        
        return view('solicitacoes.index',[
            'solicitacoes' => $solicitacoes,
            'search' => $request->search,
        ]);
    }
}
