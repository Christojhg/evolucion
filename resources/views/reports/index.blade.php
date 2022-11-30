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
                        title: 'Reporte de Ventas (' + $("#start_date").val() + ' - ' + $("#end_date").val() + ') creado por ' + user,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8]
                        },
                        className: 'btn-exportar-pdf',
                        customize: function(doc) {
                            var logo = 'data:image/png;base64,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'
                            var now = new Date();
                            var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

                            doc.styles.tableBodyOdd.alignment = 'center';
                            doc.styles.tableBodyEven.alignment = 'center';
                            doc.content[1].margin = [70, 0, 70, 0]
                            doc.pageMargins = [20, 60, 20, 30]
                            var objLayout = {};
                            objLayout['hLineWidth'] = function(i) {
                                return .5;
                            };
                            objLayout['vLineWidth'] = function(i) {
                                return .5;
                            };
                            objLayout['hLineColor'] = function(i) {
                                return '#aaa';
                            };
                            objLayout['vLineColor'] = function(i) {
                                return '#aaa';
                            };
                            objLayout['paddingLeft'] = function(i) {
                                return 4;
                            };
                            objLayout['paddingRight'] = function(i) {
                                return 4;
                            };

                            doc.content[1].layout = objLayout;

                            doc['header'] = (function (){
                                return {
                                    columns: [
                                        {
                                            image: logo,
                                            width: 30
                                        },
                                        {
                                            alignment: 'left',
                                            text: 'SisFacMype',
                                            fontSize: 18,
                                            margin: [10, 5]
                                        },
                                        {
                                            alignment: 'right',
                                            fontSize: 14,
                                            text: ['Reporte creado el ' , { text: jsDate.toString() }],
                                            margin: [0, 5, 10, 5]
                                        }
                                    ]
                                }
                            })

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