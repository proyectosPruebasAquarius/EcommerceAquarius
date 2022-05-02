@extends('backend')
@section('title', 'Inicio')
@section('content')

<div class="page-heading">
    <h3>Inicio</h3>
</div>
<div class="page-content">
    <section class="row">


        <div class="row">
            @if(count($peticiones))
                
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="text-center">Peticiones de eliminar cuenta</h4>
                            </div>
                            <br>
                            <div class="card-body">
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-borderless">
                                        <thead class="text-center ">
                                            <tr class="bg-primary  text-white border text-white ">

                                                <th>Usuario</th>
                                                <th>Motivo</th>
                                                <th>Descripción</th>
                                                <th>Fecha</th>      
                                                <th>Generar Enlace</th>                                          
                                            </tr>
                                        </thead>
                                        <tbody class="text-center  me-5">
                                            @foreach ($peticiones as $peticion)
                                            <tr>
                                                <th>{{ $peticion->email }}</th>
                                                <th>{{ $peticion->motivo }}</th>
                                                <th>{{ $peticion->descripcion }}</th>
                                                <th>{{ date('d-m-Y H:i:s', strtotime($peticion->created_at)) }}</th> 
                                                <th><Button class="btn btn-default btn-md rounded-circle" onclick="Livewire.emit('assignMail', @js($peticion->email))" data-bs-toggle="modal" data-bs-target="#uriTrashModal"><i class="bi bi-link-45deg" style="font-size: 16px;"></i></Button></th>                                               
                                            </tr>                                           
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
    
                            </div>
                        </div>
                    </div>
                @livewire('generate-trash-uri')
            @endif
        </div>
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="stats-icon purple">
                                        <i class="fal fa-boxes"></i>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h6 class="text-muted font-semibold">Producto mas Vendido</h6>
                                    <h6 class="font-extrabold mb-0">
                                        @forelse ($sellingProduct as $sp)
                                        {{ $sp->producto }}
                                        @empty
                                        No hay Datos Registrados
                                        @endforelse

                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Mayor Comprador</h6>
                                    <h6 class="font-extrabold mb-0">
                                        @forelse ($maxBuyer as $mb)
                                        {{ $mb->nombre }}
                                        @empty
                                        No hay Datos Registrados
                                        @endforelse


                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="fas fa-th"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Categoria mas Vendida</h6>
                                    <h6 class="font-extrabold mb-0">
                                        @forelse ($maxCat as $mc)
                                        {{ $mc->categoria }}
                                        @empty
                                        No hay Datos Registrados
                                        @endforelse


                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Usuarios visitados</h6>
                                    <h6 class="font-extrabold mb-0">
    
                                        @if ($lastUser == null)
                                        No hay registros
                                        @else
                                        {{ $lastUser }}
                                        @endif
                                    
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Ventas</h4>
                            <div class="card-footer">

                            </div>

                        </div>
                        <div class="card-body text-center">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                <div class="col">
                                    <div class="card h-100">

                                        <div class="card-body">

                                            <h5 class="card-title">Venta Diaria <i class="fal fa-clock"></i></h5>
                                            <br>
                                            <p class="card-text">
                                                @foreach ($ventaDiaria as $vd)
                                                @if ($vd->cuentaTotal == null)
                                                Sin ventas diarias
                                                @else
                                                ${{ $vd->cuentaTotal }}
                                                @endif
                                                @endforeach


                                            </p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <small class="text-muted" id="dia"> Dia: {{ $hoy }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">

                                        <div class="card-body">
                                            <h5 class="card-title">Venta Mensual <i class="fal fa-calendar-alt"></i>
                                            </h5>
                                            <br>
                                            <p class="card-text">

                                                @foreach ($ventaMensual as $vm)
                                                @if ($vm->cuentaTotal == null)
                                                Sin ventas mensual
                                                @else
                                                ${{ $vm->cuentaTotal }}
                                                @endif
                                                @endforeach


                                            </p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <small class="text-muted" id="mes">Mes: {{ $mes }} </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100">

                                        <div class="card-body">
                                            <h5 class="card-title">Venta Anual <i class="fal fa-calendar"></i></h5>
                                            <br>
                                            <p class="card-text">

                                                @foreach ($ventaAnual as $va)
                                                @if ($va->cuentaTotal == null)
                                                Sin ventas anual
                                                @else
                                                ${{ $va->cuentaTotal }}
                                                @endif
                                                @endforeach


                                            </p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <small class="text-muted" id="ano">Año: {{ $ano }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Venta por Fecha</h4>
                            <div class="card-footer">

                            </div>
                            <form class="row text-center" method="POST" action="{{ url('admin/venta/fecha') }}">
                                @csrf
                                @method('POST')
                                <div class="col-8">

                                    <input type="date" required class="form-control" id="inputPassword2"
                                        placeholder="Password" name="venta_fecha">
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary mb-3">Enviar Fecha</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body text-center">

                            <div>
                                <div class="col">
                                    <div class="card h-100">

                                        <div class="card-body">


                                            <p class="card-text">
                                                @if (\Session::has('date'))
                                                @if (\Session::has('date') == 0)
                                                No hay ventas registrados con esa fecha
                                                @else
                                                ${!! \Session::get('date') !!}
                                                @endif

                                                @else

                                                No hay Fecha Selecionada
                                                @endif

                                            </p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <small class="text-muted">
                                                @if (\Session::has('fecha'))
                                                Fecha: {!! \Session::get('fecha') !!}
                                                @else
                                                Fecha: No hay Fecha Selecionada
                                                @endif

                                            </small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="text-center">Productos más Vendidos</h4>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-borderless">
                                    <thead class="text-center bg-primary  text-white border me-5">
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Producto</th>
                                            <th>Veces Comprados</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center  me-5">
                                        @forelse ($maxProducts as $p)
                                        <tr>
                                            <th class="h-25 w-25">
                                                <img src="{{ json_decode($p->imagen)[0] }}" class="h-25 w-25">
                                            </th>
                                            <th>{{ $p->producto }}</th>
                                            <th>{{ $p->cuentaTotal }}</th>
                                        </tr>
                                        @empty
                                        <tr>
                                            <th>
                                                <h1 class="text-center ">No hay Ventas Registradas</h1>
                                            </th>
                                            
                                        </tr>
                                        
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>-->
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="text-center">Categorias más Vendidas</h4>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-borderless">

                                    <tbody class="text-center   me-5">
                                        @forelse ($maxCategories as $c)
                                        <tr>

                                            <th>{{ $c->categoria }}</th>

                                        </tr>
                                        @empty
                                        <tr>
                                            <th>
                                                <h1 class="text-center ">No hay Ventas Registradas</h1>
                                            </th>
                                            
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  col-xl-6">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="text-center">Usuarios con más compras</h4>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-borderless">
                                    <thead class="text-center ">
                                        <tr class="bg-primary  text-white border text-white ">

                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Total de Compras</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center  me-5">
                                        @forelse ($maxBuyers as $cs)
                                        <tr>

                                            <th>{{ $cs->nombre }}</th>
                                            <th>{{ $cs->correo }}</th>
                                            <th>{{ $cs->cuentaCompras }}</th>
                                            <th>${{ $cs->sumtotal }}</th>
                                        </tr>
                                        @empty
                                        <tr>
                                            <th>
                                                <h1 class="text-center ">No hay Ventas Registradas</h1>
                                            </th>
                                            
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12  col-xl-6">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="text-center">Usuarios con menos compras</h4>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <table class="table table-borderless">
                                    <thead class="text-center bg-primary  text-white border ">
                                        <tr>

                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Total de Compras</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center  me-5">
                                        @forelse ($minBuyers as $cs)
                                        <tr>

                                            <th>{{ $cs->nombre }}</th>
                                            <th>{{ $cs->correo }}</th>
                                            <th>{{ $cs->cuentaCompras }}</th>
                                            <th>${{ $cs->sumtotal }}</th>
                                        </tr>
                                        @empty
                                        <tr>
                                            <th>
                                                <h1 class="text-center ">No hay Ventas Registradas</h1>
                                            </th>
                                            
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



            <!-- <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Comments</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="{{ asset('backend/assets/images/faces/5.jpg') }}">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Congratulations on your graduation!</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md">
                                                            <img src="{{ asset('backend/assets/images/faces/2.jpg') }}">
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                    </div>
                                                </td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">Wow amazing design! Can you make another
                                                        tutorial for
                                                        this design?</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>-->
        </div>
</div>
<div class="col-12 col-lg-3">



</div>
</section>
</div>
@endsection
@push('partial-scripts')
<script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.js') }}"></script>
@endpush
@push('datatable-scripts')
<script>
    var ventaAnual = "<?php echo $ventaAnual; ?>"
        var ventaMensual = "<?php echo $ventaMensual; ?>"
        var ventaDiaria = "<?php echo $ventaDiaria; ?>"
        ventaDiaria = [parseInt(ventaDiaria)];
        ventaDiaria = ventaDiaria[0];

        ventaMensual = [parseInt(ventaMensual)];
        ventaMensual = ventaMensual[0];

        ventaAnual = [parseInt(ventaAnual)];
        ventaAnual = ventaAnual[0];



        /*var optionsProfileVisit = {
    	annotations: {
    		position: 'back'
    	},
    	dataLabels: {
    		enabled:false
    	},
    	chart: {
    		type: 'bar',
    		height: 300
    	},
    	fill: {
    		opacity:1
    	},
    	plotOptions: {
    	},
    	series: [{
    		name: 'sales',
    		data: [9,20,30,20,10,20,30,20,10,20,30,20]
    	}],
    	colors: '#FFAA4C',
    	xaxis: {
    		categories: ["Ene","Feb","Mar","Abr","May","Jun","Jul", "Ago","Sep","Oct","Nov","Dic"],
    	},
    }*/
        let optionDailySales = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled: false
            },
            chart: {
                type: 'bar',
                height: 300,

            },
            fill: {
                opacity: 1
            },
            plotOptions: {},
            series: [{
                name: 'Monto $',
                data: [ventaDiaria]
            }],
            colors: '#FFAA4C',
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0,

                    }
                }
            }],
            xaxis: {
                categories: ["Venta Diaria"],

            },
        }


        let optionMonthSales = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled: false
            },
            chart: {
                type: 'bar',
                height: 300,

            },
            fill: {
                opacity: 1
            },
            plotOptions: {},
            series: [{
                name: 'Monto $',
                data: [ventaMensual]
            }],
            colors: '#FFAA4C',
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0,

                    }
                }
            }],
            xaxis: {
                categories: ["Venta Mensual"],
            },
        }


        let optionYearSales = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled: false
            },
            chart: {
                type: 'bar',
                height: 300,

            },
            fill: {
                opacity: 1
            },
            plotOptions: {},
            series: [{
                name: 'Monto $',
                data: [ventaAnual]
            }],
            colors: '#FFAA4C',
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0,

                    }
                }
            }],
            xaxis: {
                categories: ["Venta Anual"],
            },
        }


        let optionEditSales = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled: false
            },
            chart: {
                type: 'bar',
                height: 300,

            },
            fill: {
                opacity: 1
            },
            plotOptions: {},
            series: [{
                name: 'Monto $',
                data: [12]
            }],
            colors: '#FFAA4C',
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0,

                    }
                }
            }],
            xaxis: {
                categories: ["Venta Anual"],
            },
        }

        /*var optionsEurope = {
        	series: [{
        		name: 'series1',
        		data: [310, 800, 600, 430, 540, 340, 605, 805,430, 540, 340, 605]
        	}],
        	chart: {
        		height: 80,
        		type: 'area',
        		toolbar: {
        			show:false,
        		},
        	},
        	colors: ['#37474f'],
        	stroke: {
        		width: 2,
        	},
        	grid: {
        		show:false,
        	},
        	dataLabels: {
        		enabled: false
        	},
        	xaxis: {
        		type: 'datetime',
        		categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z","2018-09-19T07:30:00.000Z","2018-09-19T08:30:00.000Z","2018-09-19T09:30:00.000Z","2018-09-19T10:30:00.000Z","2018-09-19T11:30:00.000Z"],
        		axisBorder: {
        			show:false
        		},
        		axisTicks: {
        			show:false
        		},
        		labels: {
        			show:false,
        		}
        	},
        	show:false,
        	yaxis: {
        		labels: {
        			show:false,
        		},
        	},
        	tooltip: {
        		x: {
        			format: 'dd/MM/yy HH:mm'
        		},
        	},
        };

        let optionsAmerica = {
        	...optionsEurope,
        	colors: ['#008b75'],
        }
        let optionsIndonesia = {
        	...optionsEurope,
        	colors: ['#dc3545'],
        }*/

        /*
        //var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
        var chartDailySales = new ApexCharts(document.getElementById('chart-dailysale'), optionDailySales)
        var chartMonthSales = new ApexCharts(document.getElementById('chart-monthsale'), optionMonthSales)
        var chartYearSales = new ApexCharts(document.getElementById('chart-yearsale'), optionYearSales)
        var chartEdit = new ApexCharts(document.getElementById('chart-edit'), optionEditSales)
        /*var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
        var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
        var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);*/

        /*chartIndonesia.render();
        chartAmerica.render();
        chartEurope.render();
        chartProfileVisit.render();
        chartDailySales.render()
        chartMonthSales.render()
        chartYearSales.render()
        chartEdit.render();*/
</script>
@endpush