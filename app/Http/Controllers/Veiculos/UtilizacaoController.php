<?php

namespace App\Http\Controllers\Veiculos;

use App\Http\Controllers\Controller;
use App\Http\Requests\UtilizacaoClienteRequest;
use App\Mail\MailCoordenador;
use App\Model\Utilizacao;
use App\Model\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UtilizacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(isset(Auth::user()->coordenador)){
            $solicitacoes = Utilizacao::where('user_id',Auth::user()->id)
            ->orWhere('coordenador_email',Auth::user()->email)
            ->orderBy('updated_at','desc')
            ->paginate(10);            
            
        }else{
            $solicitacoes = Utilizacao::where('user_id',Auth::user()->id)
            ->paginate(10);
        }
        return view('controle-de-utilizacao.index',[
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

        return view('controle-de-utilizacao.create',[
            'veiculos' => Veiculo::where('ativo','sim')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UtilizacaoClienteRequest $request)
    {
        $utilizacao = Utilizacao::create([
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
            "coordenador_email" => $request->coordenador_email,
            "status" => empty($request->coordenador_email) ? 'Solicitado' : 'Aguardando Coordenador',
            "token" => Str::random(45),
            "user_id" => Auth::user()->id,

        ]);

        if(!Auth::user()->coordenador)
            Mail::send(new MailCoordenador($utilizacao));

        //dd(date("d/m/Y g:i A"),$request->all(), date('Y-m-d H:i', strtotime($request->data)));
        return redirect()->route('controle-de-utilizacao.index');
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

    public function autorizar($token)
    {
        $utilizacao = Utilizacao::where('token', $token)->first();
        if($utilizacao->status == 'Aguardando Coordenador'){
            $utilizacao->update([
                'status' => 'Solicitado'
            ]);
        }
        return view('controle-de-utilizacao.autorizar',[
            'utilizacao' => $utilizacao
        ]);
    }
}
