<?php

namespace App\Http\Controllers\Veiculos;

use App\Http\Controllers\Controller;
use App\Http\Requests\VeiculosRequest;
use App\Model\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VeiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('veiculos.index',
            [
                'veiculos' => Veiculo::orderBy('ativo', 'desc')->get(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VeiculosRequest $request)
    {
        $nomeDaImagem = Str::random(25);
        $veiculo = Veiculo::create($request->except('_token'));
        $veiculo->img_url = $request->img_url->storeAs("imagens/veiculos/".strtoupper(str_replace('-','',Str::kebab($veiculo->placa))), $nomeDaImagem.'.'.$request->img_url->getClientOriginalExtension());
        $veiculo->save();
        return redirect()->route('veiculos.index')->with('message','Veículo cadastrado com sucesso!');
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
}
