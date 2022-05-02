@extends('backend')
@section('title','Productos')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="text-center">
                <h3>Lista de Peticiones</h3>

            </div>
            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="text-center">Peticiones de eliminar cuenta</h4>
                    </div>
                    <br>
                    <div class="card-body">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar h-100">
                            <table class="table table-borderless">
                                <thead class="text-center ">
                                    <tr class="bg-primary  text-white border text-white ">

                                        <th>Usuario</th>
                                        <th>Motivo</th>
                                        <th>Descripción</th>
                                        <th>Sugerencia</th>
                                        <th>Fecha</th>
                                        <th>Enlace Generado</th>
                                        <th>Fecha de Enlace Generado</th> 
                                        <th>Cofirmación Aceptada</th>     
                                        <th>Generar Enlace</th>                                          
                                    </tr>
                                </thead>
                                <tbody class="text-center  me-5">
                                    @forelse ($peticiones as $peticion)
                                    <tr>
                                        <th>{{ $peticion->email }}</th>
                                        <th>{{ $peticion->motivo }}</th>
                                        <th>{{ $peticion->descripcion }}</th>
                                        @if($peticion->sugerencia)
                                            <th class="text-break">{{ $peticion->sugerencia }}</th>
                                            @else
                                            <th>
                                                
                                            </th>
                                        @endif
                                        <th>{{ date('d-m-Y H:i:s', strtotime($peticion->created_at)) }}</th> 
                                        <th>{{ $peticion->was_email_send ? 'x' : '' }}</th>
                                        <th class="text-break">{{ $peticion->email_url_date ? date('d-m-Y H:i:s', strtotime($peticion->email_url_date)) : '' }}</th>
                                        <th>{{ $peticion->acepto_terminos ? 'x' : '' }}</th>
                                        <th><Button class="btn btn-default btn-md rounded-circle" onclick="Livewire.emit('assignMail', @js($peticion->email))" data-bs-toggle="modal" data-bs-target="#uriTrashModal" @if ($peticion->acepto_terminos) disabled @endif ><i class="bi bi-link-45deg" style="font-size: 16px;"></i></Button></th>                                               
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="5">No se encontraron pedidos</th>
                                    </tr>                                           
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        @livewire('generate-trash-uri')
        </div>
    </div>
@endsection