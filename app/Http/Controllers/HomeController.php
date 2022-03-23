<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuestados;
use App\Models\RedesSociales;
use App\Models\VotacionesDetalles;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    { 
        $edades = ['18-25', '26-33', '34-40', '40+'];
        $topPromedio = [];
        $incio = null;
        $fin = null;

        if(!is_null($request->inicio)){
            $incio = $request->inicio;
        }
        if(!is_null($request->fin)){
            $fin = $request->fin;
        }


        $votaciones = RedesSociales::
            withCount(['votaciones' => function($q) use($incio, $fin){
                $q->when(!is_null($incio), function($q2) use($incio){ 
                    $q2->where('created_at', '>=', $incio.' 00:00:00');
                });
                $q->when(!is_null($fin), function($q2) use($fin){ 
                    $q2->where('created_at', '<=', $fin.' 00:00:00');
                }); 
            }])
            ->orderBy('votaciones_count','DESC')          
            // with(['votaciones' => function($q) use($incio, $fin){
            //     $q->when(!is_null($incio), function($q2) use($incio){ 
            //         $q2->where('created_at', '>=', $incio.' 00:00:00');
            //     });
            //     $q->when(!is_null($fin), function($q2) use($fin){ 
            //         $q2->where('created_at', '<=', $fin.' 00:00:00');
            //     }); 
            // }])
            ->get();
        // dd($votaciones);
        foreach($votaciones as $item){

            //-------------
            $topVotaciones[] = [
                'name' => $item->nombre,
                'y' => $item->votaciones_count
            ];

        
            $count_edades = [];
            foreach ($edades as $value) {
                $count_edades[] = Encuestados::whereEdad($value)->whereHas('votacion', function($q) use($item, $incio, $fin){
                    $q->where('favorita_id', $item->id);
                    $q->when(!is_null($incio), function($q2) use($incio){ 
                        $q2->where('created_at', '>=', $incio.' 00:00:00');
                    });
                    $q->when(!is_null($fin), function($q2) use($fin){ 
                        $q2->where('created_at', '<=', $fin.' 00:00:00');
                    }); 

                  })->count();                
            }

            
            $promedios = VotacionesDetalles::
                where('redes_sociales_id',$item->id)
                ->when(!is_null($incio), function($q2) use($incio){ 
                    $q2->where('created_at', '>=', $incio.' 00:00:00');
                })
                ->when(!is_null($fin), function($q2) use($fin){ 
                    $q2->where('created_at', '<=', $fin.' 00:00:00');
                })
                ->get();
            
            $promedio_por_red = $promedios->sum('tiempo_prom');
 
            $topEdades[] = [
                'name' => $item->nombre,
                'data' => $count_edades
            ];

            $topPromedio[] = [
                'name' => $item->nombre,
                'y' => ($promedio_por_red/$promedios->count())
            ];

        }
        
       $order_promedios = $this->sortArrayByKey($topPromedio, 'y');


        $Encuestados = Encuestados::
        when(!is_null($incio), function($q2) use($incio){ 
            $q2->where('created_at', '>=', $incio.' 00:00:00');
        })
        ->when(!is_null($fin), function($q2) use($fin){ 
            $q2->where('created_at', '<=', $fin.' 00:00:00');
        })->get();

        $total_encuesta = $Encuestados->count();
        $mas_votada = $votaciones->first();
        $menos_votada = $votaciones->last();
        $mayor_promedio = $order_promedios[count($order_promedios)-1];;
  
                 
        $estadistica_encuestado_edad = Encuestados::
        when(!is_null($incio), function($q2) use($incio){ 
            $q2->where('created_at', '>=', $incio.' 00:00:00');
        })
        ->when(!is_null($fin), function($q2) use($fin){ 
            $q2->where('created_at', '<=', $fin.' 00:00:00');
        })
        ->select('edad', DB::raw('count(*) as total'))
        ->groupBy('edad')
        ->get(); 
        foreach($estadistica_encuestado_edad as $item){
            $encuestadoEdad[] = [
                'name' => $item->edad,
                'y' => ($item->total/$total_encuesta*100)
            ];
        }

        $estadistica_encuestado_sexo = Encuestados::
        when(!is_null($incio), function($q2) use($incio){ 
            $q2->where('created_at', '>=', $incio.' 00:00:00');
        })
        ->when(!is_null($fin), function($q2) use($fin){ 
            $q2->where('created_at', '<=', $fin.' 00:00:00');
        })
        ->select('sexo', DB::raw('count(*) as total'))
        ->groupBy('sexo')
        ->get();
        foreach($estadistica_encuestado_sexo as $item){
            $encuestadoSexo[] = [
                'name' => ($item->sexo=='f')?'Femenino':'Masculino',
                'y' => ($item->total/$total_encuesta*100)
            ];
        }


        $encuestadoSexo = json_encode($encuestadoSexo);
        $encuestadoEdad = json_encode($encuestadoEdad);
        $topVotaciones = json_encode($topVotaciones);
        $edades = json_encode($edades);
        $topEdades = json_encode($topEdades);
        $topPromedio = json_encode($topPromedio);

        
        
        return view('home', compact('total_encuesta',
        'incio',
        'fin',
        'mas_votada',
        'mayor_promedio',
        'menos_votada',
        'Encuestados',
        'encuestadoEdad',
        'encuestadoSexo',
        'topVotaciones',
        'edades',
        'topEdades',
        'topPromedio'
    ));

    }

 
    static  function sortArrayByKey($array,$key){
      
        $groupedItems = []; 
        $Items = []; 
        foreach ($array as $item) {
            $pool = $item[$key];
            $groupedItems[$pool][] = $item;
        }
        ksort($groupedItems);

        foreach ($groupedItems as $key => $value) {
          $Items[] = $value[0];
        }

        return $Items;
    } 

}
