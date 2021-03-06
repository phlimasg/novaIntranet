<?php

namespace App\Http\Controllers\Veiculos;

use App\Http\Controllers\Controller;
use App\Mail\SolicitacaoStatusMail;
use App\Model\HereMaps;
use App\Model\Utilizacao;
use App\Model\Veiculo;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $solicitacoes = Utilizacao::where('status','Solicitado')
        ->orderBy('updated_at','desc')
        ->orderBy('status','desc')
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
        //dd($id);
        $utilizacao = Utilizacao::find($id);
        if(!empty($request->status)){
            $utilizacao->update(
                [
                    'status' => $request->status,
                    'observacao_recusado' => $request->observacao_recusado
                ]
            );
            Mail::send(new SolicitacaoStatusMail($utilizacao));
        }else{
            $utilizacao->update([
                "motivo" => $request->motivo,
                "dt_entrega" =>  date('Y-m-d H:i', strtotime($request->data)),
                "veiculo_id" => $request->veiculo_id,
                "cep" => $request->cep,
                "rua" => $request->rua,
                "numero" => $request->numero,
                "complemento" => $request->complemento,
                "bairro" => $request->bairro,
                "cidade" => $request->cidade,
                "estado" => $request->estado,
                "endereco" => $request->endereco,
                //"coordenador_email" => $request->coordenador_email,
                //"status" => empty($request->coordenador_email) ? 'Solicitado' : 'Aguardando Coordenador',
                //"token" => Str::random(45),
                //"user_id" => Auth::user()->id,    
            ]);
        }        
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
        ->paginate(15);

        
        return view('solicitacoes.index',[
            'solicitacoes' => $solicitacoes,
            'search' => $request->search,
        ]);
    }
}
