<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\PlanoCliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $clientes = Cliente::all();

      return $clientes->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $email = Cliente::where('email', $request->email)->first();

      if($email) {
        return response()->json([
          'message' => 'Email ja esta sendo usado'], 400);
      } 

      $cliente = $this->validate(request(), [
        'nome' => 'required',
        'email' => 'required',
        'telefone' => 'required',
        'estado' => 'required',
        'cidade' => 'required',
        'dataNascimento' => 'required'
      ]);

      $cliente = Cliente::create($cliente);

      return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $cliente = Cliente::where('id', $id)->first();

      if(!$cliente) {
        return response()->json([
          'message' => 'Cliente não encontrado'], 404);
      }

      return $cliente->toJson();
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
      $cliente = Cliente::where('id', $id)->first();

      if(!$cliente) {
        return response()->json([
          'message' => 'Cliente não encontrado'], 404);
      } 

      $email = Cliente::where('email', $request->email)->first();

      if($cliente->email != $email && $email == $request->email) {
        return response()->json([
          'message' => 'Email ja esta sendo usado'], 400);
      } 

      $cliente->update([
        'nome' => $request->nome,
        'email' => $request->email,
        'telefone' => $request->telefone,
        'estado' => $request->estado,
        'cidade' => $request->cidade,
        'dataNascimento' => $request->dataNascimento
      ]);

      return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cliente = Cliente::where('id', $id)->first();

      if(!$cliente) {
        return response()->json([
          'message' => 'Cliente não encontrado'], 404);
      }

      if($cliente->estado == 'Sao Paulo') {
        $plano_cliente = PlanoCliente::where('cliente_id', $id)->where('plano_id', 1)->first();

        if($plano_cliente) {
          return response()->json([
            'message' => 'Cliente de São Paulo com plano Flex não pode ser excluido'], 400);
        }
      }

      Cliente::destroy($id);

      return $cliente->toJson();

    }
}
