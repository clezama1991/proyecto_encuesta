<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Models\Encuestados;
use App\Models\Votaciones;
use App\Models\VotacionesDetalles;

class EncuestaController extends Controller
{ 
          
    public function store(Request $request)
    {

        try {

            DB::beginTransaction();

                $newEncuesta = new Encuestados;
                $newEncuesta->nombre = $request->nombre;
                $newEncuesta->correo = $request->correo;
                $newEncuesta->edad = $request->edad;
                $newEncuesta->sexo = $request->sexo;
                $newEncuesta->save();

                $newVotaciones = new Votaciones;
                $newVotaciones->user_id = $newEncuesta->id;
                $newVotaciones->favorita_id = $request->favorita_id;
                $newVotaciones->save();

                foreach ($request->prom as $key => $prom) {                    
                    $newVotacionesDetalles = new VotacionesDetalles;
                    $newVotacionesDetalles->votaciones_id = $newVotaciones->id;
                    $newVotacionesDetalles->redes_sociales_id = $key;
                    $newVotacionesDetalles->tiempo_prom = $prom;
                    $newVotacionesDetalles->save();
                }
  
            DB::commit();
        }
        catch (\Throwable $e) {    
 
            DB::rollback();   

            return redirect()->back()->with('flag', 'Ha ocurrido un error durante la ejecución del proceso. '.$e->getMessage());
        }
  
        $request->session()->flash('alert-success', 'Tus respuestas se ha guardado correctamente!!!');
       
        return redirect()->to('/');

    }
    
}