@extends('adminlte::page')

@section('title', 'Boletas')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Creación de Boletas</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-dark alert-dismissible fade show" role="alert">
                        <strong>¡Revise los campos!</strong>
                        @foreach ($errors->all() as $error)
                        <span class="badge badge-danger">{{ $error }}</span>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form action="#" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="nameClient">Cliente</label>
                                <input list="clients" class="form-control " name="client_name" class=" form-control" required id='client_name' autocomplete="off">
                                <datalist id="clients">
                                    <option value="Cliente 1">
                                </datalist>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="currencyVoucher">Moneda</label>
                                <select name="currency_voucher" id="currencyVoucher" class="form-control">
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        <div class=table-responsive>
                            <table class="table tables">
                                <thead class="thead-light">
                                    <tr>
                                        <th><input class='check_all' type='checkbox' onclick="select_all()" /></th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type='checkbox' class="case"></td>
                                        <td>
                                            <input list="products" class="form-control " name="product[]" class="monto0 form-control" required id='product0' onkeyup="call_costo(0)" autocomplete="off">
                                            <datalist id="products">
                                                <option value="Valor 1">
                                            </datalist>
                                        </td>
                                        <td>
                                            <input type='number' id='cantidad0' name='cantidad[]' max="" min="1" class="monto0 form-control" onkeyup="multi(0)" required autocomplete="off" />
                                        </td>
                                        <td>
                                            <input type='text' id='precio0' name='precio[]' class="monto0 form-control" onkeyup="multi(0)" required autocomplete="off" readonly />
                                        </td>
                                        <td>
                                            <input type='text' id='total0' name='total' readonly="readonly" class="monto0 form-control" required autocomplete="off" />
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr align="center">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total :</td>
                                        <td colspan="2"><input id='total_final' type="text" name="total_final" readonly="" class="form-control" required /></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class='delete btn btn-danger'>Eliminar</button>
                            <button type="button" class='addmore btn btn-success'>Agregar</button>
                            <button class="btn btn-primary float-right" type="submit" id="boton" name="boton"><i class="fa fa-cloud-upload" aria-hidden="true">Guardar</i></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    var i = 2;
    $(".addmore").on('click', function() {
        var data = `[
        <tr>
            <td>
                <input type='checkbox' class='case'/>
            </td>
            <td>
            <input list="products" name="product[]" class="form-control" required id='product${i}' onkeyup="call_costo(${i})" autocomplete="off">
                                            <datalist id="products">
                                                <option value="valor 1">
                                            </datalist>             
            </td>
            <td>
                <input type='number' id='cantidad${i}' name='cantidad[]' class="monto${i} form-control" onkeyup="multi(${i})" required  autocomplete="off" max=""/>
            </td>
            <td>
                <input type='text' id='precio${i}' name='precio[]' class="monto${i} form-control" onkeyup="multi(${i})" required readonly  autocomplete="off"/>
            </td>
            <td>
                <input type='text'  id='total${i}' name='total' disabled="disabled" class="total form-control " required autocomplete="off"/>
            </td>
        </tr>`;
        $('.tables').append(data);
        i++;
    });
</script>
<script>
    $(".delete").on('click', function() {
        $('.case:checkbox:checked').parents("tr").remove();
        calculo();
    });
</script>
<script>
    function select_all() {
        $('input[class=case]:checkbox').each(function() {
            if ($('input[class=check_all]:checkbox:checked').length == 0) {
                $(this).prop("checked", false);
            } else {
                $(this).prop("checked", true);
            }
        });
    }
</script>
<script>
    // Conclusión
    (function() {
        /**
         * Ajuste decimal de un número.
         *
         * @param {String}  tipo  El tipo de ajuste.
         * @param {Number}  valor El numero.
         * @param {Integer} exp   El exponente (el logaritmo 10 del ajuste base).
         * @returns {Number} El valor ajustado.
         */
        function decimalAdjust(type, value, exp) {
            // Si el exp no está definido o es cero...
            if (typeof exp === 'undefined' || +exp === 0) {
                return Math[type](value);
            }
            value = +value;
            exp = +exp;
            // Si el valor no es un número o el exp no es un entero...
            if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
                return NaN;
            }
            // Shift
            value = value.toString().split('e');
            value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
            // Shift back
            value = value.toString().split('e');
            return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
        }
        // Decimal round
        if (!Math.round10) {
            Math.round10 = function(value, exp) {
                return decimalAdjust('round', value, exp);
            };
        }
        // Decimal floor
        if (!Math.floor10) {
            Math.floor10 = function(value, exp) {
                return decimalAdjust('floor', value, exp);
            };
        }
        // Decimal ceil
        if (!Math.ceil10) {
            Math.ceil10 = function(value, exp) {
                return decimalAdjust('ceil', value, exp);
            };
        }
    })();
</script>
<script>
    function calculo() {
        var totalInp = $('[name="total"]');
        var total_t = 0;
        totalInp.each(function() {
            total_t += parseFloat($(this).val());
        });
        total_t = Math.round10(total_t, -2);
        $('#total_final').val(total_t);
    }
</script>
<script>
    //Consulta por ajax
    function call_costo(a) {
        var articulo2 = $(`[id='product${a}']`).val();
        $.ajax({
            type: "post",
            url: "#",
            data: {
                '_token': $('input[name=_token]').val(),
                'product': articulo2
            },
            success: function(msg) {
                $(`#precio${a}`).val(msg);
            }
        })
    }
</script>
<script>
    function multi(i) {
        var precio = document.querySelector(`#precio${i}`).value;
        var cantidad = document.querySelector(`#cantidad${i}`).value;
        var total = precio * cantidad;
        total = Math.round10(total, -2);
        document.getElementById(`total${i}`).value = total;
        calculo();
    }
</script>
@endsection
