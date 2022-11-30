@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1>Reporte Ventas</h1>
            <hr class="bg-dark w100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="start_date" placeholder="Fecha inicio" readonly>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="end_date" placeholder="Fecha final" readonly>
                    </div>
                </div>
                <div class="col-sm">
                    <button id="filter" class="btn btn-success">Filtrar</button>
                    <button id="reset" class="btn btn-danger">Reiniciar</button>
                </div>
            </div>

            <table class="table table-light mt-2 nowrap" style="width: 100%;" id="reportTable">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Codigo</th>
                        <th>Comprobante</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Subtotal</th>
                        <th>Impuesto</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align:right">Total:</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function() {
        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });

        var user = "{{$creador}}"

        function cargar_datos(start_date = '', end_date = '') {
            $('#reportTable').DataTable({
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };

                    total = api
                        .column(8)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    pageTotal = api
                        .column(8, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);


                    $(api.column(8).footer()).html('' + pageTotal + ' ( ' + total + ' total)');
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('reports.index')}}",
                    data: {
                        start_date: start_date,
                        end_date: end_date
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    }, {
                        data: 'voucher_serie',
                        name: 'voucher_serie'
                    },
                    {
                        data: 'type_name',
                        name: 'type_name'
                    },
                    {
                        data: 'client_name',
                        name: 'client_name'
                    },
                    {
                        data: 'voucher_date',
                        render: function(data, type, row, meta) {
                            return moment(row.voucher_date).format('YYYY-MM-DD');
                        },
                        name: 'voucher_date'
                    },
                    {
                        data: 'status_name',
                        name: 'status_name'
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal'
                    },
                    {
                        data: 'igv',
                        name: 'igv'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    }
                ],
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                },
                responsive: true,
                columnDefs: [{
                        targets: 0,
                        visible: false
                    },
                    {
                        targets: 5,
                        render: function(data) {
                            if (data == 'No Enviado') {
                                return `<span class="badge badge-dark">${data}</span>`;
                            } else {
                                return `<span class="badge badge-success">${data}</span>`;
                            }
                        }
                    }
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: 'Excel',
                        footer: true,
                        filename: 'Reporte Ventas',
                        title: 'Reporte de Ventas ' + $("#start_date").val() + ' - ' + $("#end_date").val() + ' creado por ' + user,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        className: 'btn-exportar-excel',
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        footer: true,
                        filename: 'Reporte Ventas',
                        title: 'Reporte de Ventas ' + $("#start_date").val() + ' - ' + $("#end_date").val() + ' creado por ' + user,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        className: 'btn-exportar-pdf',
                        customize: function(doc) {
                            doc.content[1].margin = [100, 0, 200, 0]
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Reporte de Ventas',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        className: 'btn-exportar-print',
                    },
                    'pageLength'
                ]
            })
        }
        cargar_datos()
        $('#filter').click(function(e) {
            e.preventDefault();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            if (start_date != '' && end_date != '') {
                $('#reportTable').DataTable().destroy();
                cargar_datos(start_date, end_date);
            } else {
                Swal.fire(
                    'Alerta!',
                    'Debe de ingresar ambas fechas',
                    'warning'
                )
            }
        });
        $('#reset').click(function(e) {
            e.preventDefault();
            $('#start_date').val('');
            $('#end_date').val('');
            $('#reportTable').DataTable().destroy();
            cargar_datos();
        });
    });
</script>
@stop