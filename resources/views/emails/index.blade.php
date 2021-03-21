
@extends('layouts.app')
@section('css')
<style>
    .parsley-normal{
        border-color: #000 !important
    }
</style>
@endsection
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <button onclick="create()" class="btn btn-success">
                Crear
            </button>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <label class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-form-label">Remitente</label>
                    <div class="col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <input id="search_remitente" type="text" class="form-control w-100">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <label class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-form-label">Destinatario</label>
                    <div class="col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <input id="search_destinatario" type="text" class="form-control w-100">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <label class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-form-label">Asunto</label>
                    <div class="col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <input id="search_asunto" type="text" class="form-control w-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Remitente</th>
                        <th>Destinatario</th>
                        <th>Asunto</th>
                        <th>Estado</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    /* variables de inicio */
    let data_modal_current = []
    let menu = document.getElementById('email-list');
    menu.classList.remove("closed");
    menu.classList.add("active");
    menu.classList.add("expand");

    function create() {
        Swal.fire({
            title: 'Enviar Correo',
            showConfirmButton: false,
            html:`
                <form id="form_email_create" >
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Remitente <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input type="text" id="remitente" name="remitente" class="form-control parsley-normal upper" style="color: #000 !important" placeholder="Ingrese su Remitente" >
                                    <div id="text-error-remitente"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Destinatario <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input type="text" id="destinatario" name="destinatario" class="form-control parsley-normal upper" style="color: #000 !important" placeholder="Ingrese su Destinatario" >
                                    <div id="text-error-destinatario"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Asunto</label>
                                <div class="col-lg-12">
                                    <textarea type="email"  id="asunto" name="asunto" class="form-control parsley-normal upper" style="color: #000 !important" placeholder="Ingrese su Asunto" ></textarea>
                                    <div id="text-error-asunto"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="create_Submit()" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;">Enviar Correo</button>
                        </div>
                    </div>
                </form>`
        })
    }

    function create_Submit() {
        let remitente_act = $('#remitente').val()
        let destinatario_act = $('#destinatario').val()
        let asunto_act = $('#asunto').val()
        let url = "{{ route('emails.store') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                "destinatario": destinatario_act,
                "remitente": remitente_act,
                "asunto": asunto_act,
            },
            success: function (res) {
                if(res.type === 'error'){
                    Object.keys(res.data).find( ( item ) => {
                        $(`#${item}`).removeClass('parsley-normal').addClass('parsley-error')
                        $(`#text-error-${item}`).empty().append(`<ul class="parsley-errors-list filled"><li class="parsley-required" style="text-align: left"> ${ res.data[item] } </li></ul>`)
                    })
                }
                
            }
        });

    }
    
    /* funcion requerida para dar propiedad a datatable */
    function dataTable() {
        let table = $('#data-table-default').DataTable({
            searching: false,
            responsive: true,
            processing: true,
            serverSide: true,
            lengthChange: true,
            columns: [
                { data: 'id' },
                { data: 'remitente' },
                { data: 'destinatario' },
                { data: 'asunto' },
                { 
                    render: function ( data,type, row  ) {
                        if(row.estado === 0 ){
                            return 'No Enviado' ;
                        }
                        if(row.estado === 1 ){
                            return 'Enviado' ;
                        }

                        
                    }
                },
            ],
            ajax: {
                "url": "{{route('emails.service')}}",
                "data": function (d) {[
                    d.search_remitente = $('#search_remitente').val(),
                    d.search_destinatario = $('#search_destinatario').val(),
                    d.search_asunto = $('#search_asunto').val(),
                ]}
            },
            columnDefs: [
                { 
                    orderable: false, 
                    targets: 1 
                }
            ],
            language: {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "emptyTable":  "Sin datos disponibles",
                "zeroRecords": "Ningun resultado encontrado",
                "info": "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
                "infoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "infoEmpty": "Ningun valor disponible",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
            }
        }).on( 'processing.dt', function ( e, settings, processing ) {
            if(processing){ }else{ }
        });
    }

    /* ejecutar despues de cargar la pagina */
    $(document).ready(function() {
        dataTable()
        $("#search_remitente").blur( () =>{ $('#data-table-default').DataTable().ajax.reload() }); 
        $("#search_destinatario").blur( () => { $('#data-table-default').DataTable().ajax.reload() }); 
        $("#search_asunto").blur( () => { $('#data-table-default').DataTable().ajax.reload() });  
    });
</script>
@endsection




