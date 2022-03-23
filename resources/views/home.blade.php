@extends('layouts.app')

@section('content')
<div class="container-fluid px-5">

    <form action="/home" method="POST">
        @csrf
        <div class="row pb-5">
            <div class="col-3">
                <div class="pb-2 text-left">       
                    <h2>Estadísticas</h2>      
                </div>
            </div>
            <div class="col-2 offset-4">
                <input type="date" name="inicio" id="inicio" value="{{!is_null($incio)?$incio:null}}" class="form-control" placeholder="Fecha Incio">  
            </div>
            <div class="col-2">
                <input type="date" name="fin" id="fin" value="{{!is_null($fin)?$fin:null}}" class="form-control" placeholder="Fecha Fin">  
            </div>
            <div class="col-1">
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button> 
            </div>
        </div>
    </form>

    <div class="row pb-5">
        <div class="col-md-12">
            <div class="row ">
                <div class="col-xl-3 col-lg-6">
                    <div class="card bg-primary text-white">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Encuestas</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-10">
                                    <h4 class="d-flex align-items-center mb-0">
                                        {{$total_encuesta}}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card bg-warning text-white">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-clock"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Con Mayor Promedio</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-10">
                                    <h4 class="d-flex align-items-center mb-0">
                                        {{$mayor_promedio['name']}} ({{round($mayor_promedio['y'], 2)}})
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card bg-success text-white">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-thumbs-up"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Más Favorita</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-10">
                                    <h4 class="d-flex align-items-center mb-0">
                                        {{$mas_votada->nombre}} ({{$mas_votada->votaciones_count}})
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card bg-danger text-white">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-thumbs-down"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Menos Favorita</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-10">
                                    <h4 class="d-flex align-items-center mb-0">
                                        {{$menos_votada->nombre}} ({{$menos_votada->votaciones_count}})
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Redes Sociales</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow p-3 mb-5 bg-white rounded">
                                <div id="container3"></div>
                            </div>
                        </div>  
                        <div class="col-md-6">
                            <div class="card shadow p-3 mb-5 bg-white rounded">
                                <div id="container4"></div>
                            </div>  
                        </div>  
                        <div class="col-md-6">
                            <div class="card shadow p-3 mb-5 bg-white rounded">
                                <div id="container5"></div>
                            </div>                    
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Encuestados</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div id="container1"></div>
                        </div>
                        <div class="col-md-2">
                            <div id="container2"></div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-striped table-bordered nowrap" id="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Sexo</th>
                                        <th>Edad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($Encuestados as $item)                        
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->nombre}}</td>
                                            <td>{{$item->correo}}</td>
                                            <td>{{($item->sexo=='f')?'Femenino':'Masculino'}}</td>
                                            <td nowrap>{{$item->edad}}</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
	$('#table').DataTable({
		language: {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
   	});
</script>

<script>
    
    $(function(){        
        // Create the chart
  
        Highcharts.chart('container1', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Promedio Por Edad'
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: false,
                            format: false
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
                },
            series: [
                {
                    name: "Edad",
                    colorByPoint: true,
                    data: {!! $encuestadoEdad !!}
                }
            ],
        });
    });
    $(function(){        
        // Create the chart
        Highcharts.chart('container2', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Promedio Por Sexo'
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: false,
                            format: false
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b><br/>'
                },
            series: [
                {
                    name: "Sexo",
                    colorByPoint: true,
                    data: {!! $encuestadoSexo !!}
                }
            ],
        });
    });
    
    $(function(){        
        // Create the chart
  
        Highcharts.chart('container3', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Favoritas'
                },
                subtitle: {
                    text: 'Representadas de Más favorita a menos favorita'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: false,
                            format: false
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
                },
            series: [
                {
                    name: "Red Social",
                    colorByPoint: true,
                    data: {!! $topVotaciones !!}
                }
            ],
        });
    });
    $(function(){        
        // Create the chart
  
        Highcharts.chart('container4', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rango por Edades'
                },
                subtitle: {
                    text: ''
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    categories: {!! $edades !!},
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">Edad: {point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
            series: {!! $topEdades !!},
        });
    });
    $(function(){        
        // Create the chart
  
        Highcharts.chart('container5', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Promedio Por Redes Sociales'
                },
                subtitle: {
                    text: 'Representadas en horas'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: false,
                            format: false
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} horas</b><br/>'
                },
            series: [
                {
                    name: "Red Social",
                    colorByPoint: true,
                    data: {!! $topPromedio !!}
                }
            ],
        });
    });
</script>
@endsection