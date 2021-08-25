<?php

namespace App\Http\Controllers\Veiculos;

use App\Http\Controllers\Controller;
use App\Mail\SolicitacaoStatusMail;
use App\Model\HereMaps;
use App\Model\Utilizacao;
use App\Model\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EntregasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitacoes = Utilizacao::where('status','Autorizado')
        ->OrWhere('status','Em Rota')
        ->orderBy('km_estimado','asc')
        ->orderBy('updated_at','desc')
        ->limit('1000')
        ->paginate(10);
        
        foreach($solicitacoes as $i){
            if(empty($i->tempo_estimado)){
                $geoDestination = new HereMaps("{$i->rua}, {$i->numero} {$i->bairro} {$i->cidade} {$i->estado} {$i->cep}");
                $geoOrigin = new HereMaps("{$i->veiculo->rua}, {$i->veiculo->numero} {$i->veiculo->bairro} {$i->veiculo->cidade} {$i->veiculo->estado}");
                //dd("{$i->veiculo->rua}, {$i->veiculo->numero} {$i->veiculo->bairro} {$i->veiculo->cidade} {$i->veiculo->estado}",$geoOrigin->geo);
                //dd($geoOrigin->geo,$geoDestination->geo,$i, $geoOrigin,$geoDestination);
                $rota = $geoOrigin->getTimeRoute($geoOrigin->geo,$geoDestination->geo);
                //dd($rota);
                if(!empty($rota->baseDuration)){
                    $i->tempo_estimado = $rota->baseDuration;
                    $i->km_estimado = $rota->distance;
                    $i->save();
                }
            }
            //dd($rota->duration,$i);
            //break;
        }
        
        return view('entregas.index',[
            'solicitacoes' => $solicitacoes,
            'veiculos' => Veiculo::where('ativo','sim')->get(),
            
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
        $solicitacoes = Utilizacao::where('status','Autorizado')
        ->OrWhere('status','Em Rota')
        ->orderBy('km_estimado','asc')
        ->orderBy('updated_at','desc')
        ->where('veiculo_id',$id)
        ->limit('1000')
        ->paginate(10);
        
        foreach($solicitacoes as $i){
            if(empty($i->tempo_estimado)){
                $geoDestination = new HereMaps("{$i->rua}, {$i->numero} {$i->bairro} {$i->cidade} {$i->estado} {$i->cep}");
                $geoOrigin = new HereMaps("{$i->veiculo->rua}, {$i->veiculo->numero} {$i->veiculo->bairro} {$i->veiculo->cidade} {$i->veiculo->estado}");
                //dd("{$i->veiculo->rua}, {$i->veiculo->numero} {$i->veiculo->bairro} {$i->veiculo->cidade} {$i->veiculo->estado}",$geoOrigin->geo);
                //dd($geoOrigin->geo,$geoDestination->geo,$i, $geoOrigin,$geoDestination);
                $rota = $geoOrigin->getTimeRoute($geoOrigin->geo,$geoDestination->geo);
                //dd($rota);
                if(!empty($rota->baseDuration)){
                    $i->tempo_estimado = $rota->baseDuration;
                    $i->km_estimado = $rota->distance;
                    $i->save();
                }
            }
        }
        
        return view('entregas.index',[
            'solicitacoes' => $solicitacoes,
            'veiculos' => Veiculo::where('ativo','sim')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $utilizacao = Utilizacao::findOrFail($id);
        $utilizacao->update([
            'dt_hora_saida' => $request->dt_hora_saida,
            'km_inicial' => $request->km_inicial,
            'status' => 'Em Rota',
        ]);
        Mail::send(new SolicitacaoStatusMail($utilizacao));
        return redirect()->back();

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
}
