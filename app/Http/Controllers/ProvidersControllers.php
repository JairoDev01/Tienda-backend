<?php

namespace App\Http\Controllers;

use App\ProvidersModel;
use Illuminate\Http\Request;

class ProvidersControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $status_code = 400;
    public $message = "";
    public $result  = false;
    public $records = [];
    public function index()
    {
        //
        try
        {
            $registro = ProvidersModel::all();
            $statusCode      = 200;
            $this->records   =  $registro;
            $this->message   =  "Consulta exitosa normal";
            $this->result    =  true;
        }

        catch (\Exception $e)
        {
            $statusCode     = 404;
            $this->message  =   "Ocurrió un problema al consultar los datos";
            $this->result   =   false;
        }

        finally
        {
            $response =
                [
                    'message'   =>  $this->message,
                    'result'    =>  $this->result,
                    'records'   =>  $this->records
                ];

            return response()->json($response, $statusCode);
        }
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
        try
        {
            \DB::beginTransaction();
            $registro = new ProvidersModel;
            $registro->nombre        =   $request->input('nombre');
            $registro->direccion     =   $request->input('direccion');
            $registro->email         =   $request->input('email');
            $registro->telefono      =   $request->input('telefono');
            $registro->save();

            $statusCode      = 200;
            $this->records   =  $registro;
            $this->message   =  "Registro Creado";
            $this->result    =  true;
            \DB::commit();
        }
        catch (\Exception $e)
        {
            \DB::rollback();
            $statusCode = 200;
            $this->records   =   [];
            $this->message   =   env('APP_DEBUG')?$e->getMessage():'El registro no se creó';
            $this->result    =   false;
        }

        finally
        {
            $response =
                [
                    'message'   =>  $this->message,
                    'result'    =>  $this->result,
                    'records'   =>  $this->records,
                ];

            return response()->json($response, $statusCode);
        }
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
        try
        {
            $registro          =  ProvidersModel::find($id);
            $statusCode        =  200;
            $this->records     =  $registro;
            $this->message     =  "Consulta exitosa id";
            $this->result      =  true;
        }
        catch (\Exception $e)
        {
            $statusCode     =   400;
            $this->message  =   "Registro no existe";
            $this->result   =   false;
        }
        finally
        {
            $response =
                [
                    'message'   =>  $this->message,
                    'result'    =>  $this->result,
                    'records'   =>  $this->records
                ];

            return response()->json($response);
        }
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
        try{
            $registro = ProvidersModel::findOrFail($id);

            if ($registro){
                $this->records   =  $registro;
                $this->message   =  'Editar';
                $this->result    =  true;

            }else{
                $this->records   =  [];
                $this->message   =  'error';
                $this->result    =  false;

            }
        }catch (\Exception $e){
            $statusCode     =   400;
            $this->message  =   'Registro no existe';
            $this->result   =   false;

        }finally{
            $response =
                [
                    'message'   =>  $this->message,
                    'result'    =>  $this->result,
                    'records'   =>  $this->records
                ];
            return response()->json($response);
        }

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
        try
        {
            $registro = ProvidersModel::find($id);
            $registro->nombre        =   $request->input('nombre',$registro->nombre);
            $registro->direccion     =   $request->input('direccion', $registro->direccion);
            $registro->email         =   $request->input('email',$registro->email);
            $registro->telefono      =   $request->input('telefono',$registro->telefono);
            $registro->save();

            $statusCode = 200;
            $this->records   =   $registro;
            $this->message   =   "El registro se editó correctamente";
            $this->result    =   true;
        }

        catch (\Exception $e)
        {
            $statusCode = 200;
            $this->message   =   env('APP_DEBUG')?$e->getMessage():'El registro no se editó';
            $this->result    =   false;
        }

        finally
        {
            $response =
                [
                    'message'   =>  $this->message,
                    'result'    =>  $this->result,
                    'records'   =>  $this->records,
                ];

            return response()->json($response, $statusCode);
        }

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
        try {
            $registro = ClientModel::find($id);
            if($registro){
                if($registro->delete()){
                    $this->status_code = 200;
                    $this->records = $registro;
                    $this->message = "Usuario Eliminado Correctamente";
                    $this->result = true;

                }else{
                    throw new Exception("El usuario no puede ser Eliminado");
                }
            }else{
                throw new Exception("El usuario no Existe");
            }
        } catch (\Exception $e) {
            $this->status_code = 400;
            $this->result = false;
            $this->message = $e->getMessage();
        }
        finally{
            $response =
                [
                    'message'   =>  $this->message,
                    'result'    =>  $this->result,
                    'records'   =>  $this->records
                ];
            return response()->json($response);
        }
    }
}
