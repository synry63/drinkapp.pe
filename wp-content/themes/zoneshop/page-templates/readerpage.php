<?php
/**
 * Template Name: Reader Page
 *
 **/
?>
<?php // http://drinkapp.pe/wp-content/themes/zoneshop/page-templates/reader/

if ( !is_user_logged_in() ) {
    wp_redirect( 'http://drinkapp.pe/wp-admin/'); exit;
}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10,se-1.1.0/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10,se-1.1.0/datatables.min.js"></script>

    <script type="text/javascript" src="http://drinkapp.pe/wp-content/themes/zoneshop/page-templates/reader/jquery.noty.packaged.min.js"></script>

    <script type="text/javascript" src="http://drinkapp.pe/wp-content/themes/zoneshop/page-templates/reader/ion.sound.min.js"></script>


    <style>
        td.details-control {
            background: url('http://drinkapp.pe/wp-content/themes/zoneshop/page-templates/reader/ressources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('http://drinkapp.pe/wp-content/themes/zoneshop/page-templates/reader/ressources/details_close.png') no-repeat center center;
        }
        .select-info{
            display: none;
        }
    </style>
</head>
<body>
<table id="main" class="display compact" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th></th>
        <th>Pedido ID</th>
        <th>Fecha y Hora</th>
        <th>Nombre</th>
        <th>Apelidos</th>
        <th>Celular</th>
        <th>Email</th>
        <th>Direccion</th>
        <th>Distrito</th>
        <th>Referencias</th>

    </tr>
    </thead>
    <tfoot>
    <tr>
        <th></th>
        <th>Pedido ID</th>
        <th>Fecha y Hora</th>
        <th>Nombre</th>
        <th>Apelidos</th>
        <th>Celular</th>
        <th>Email</th>
        <th>Direccion</th>
        <th>Distrito</th>
        <th>Referencias</th>
    </tr>
    </tfoot>
</table>
<button id="pedido-clear">PEDIDO ENTREGADO</button>

<script>

    $(document).ready(function() {
        if (Notification.permission !== "granted") Notification.requestPermission();
        if (!Notification) {
            alert('Desktop notifications not available in your browser. Try Chrome.');
            return;
        }
        /*setInterval(function(){
            var notification = new Notification('Notification title', {
                icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
                body: "Hey there! You've been notified!",
            });
        }, 3000);*/


        ion.sound({
            sounds: [
                {
                    name: "metal_plate_2",
                    preload: true
                }
            ],

            path: "http://drinkapp.pe/wp-content/themes/zoneshop/page-templates/reader/ressources/sounds/",
            preload: false,
            multiplay: true,
            volume: 0.9,

            scope: this, // optional scope
            ready_callback: function(){

            }
        });


        // using play for non preloaded sound
        // will force loading process first
        // and only when playback
        ion.sound.play("metal_plate_2");

        var events = $('#events');
        /* Formatting function for row details - modify as you need */
        function format ( order ) {
            // `d` is the original data object for the row
            var total = 0;
            var html = '';
            for (var i=0;i<order.order_items.length;i++){
                total += order.order_items[i].cantidad*parseFloat(order.order_items[i].bebida.price);

                html+='<tr>';
                html+='<td>'+order.order_items[i].cantidad+' x '+order.order_items[i].bebida.nombre+'</td>';
                html+='</tr>';
            }
            total+=3.5;
            html+='<tr><td>Methodo de Pago : '+order.pago_tipo.nombre+'</td></tr>';

            html+='<tr><td>Total a Pagar : '+total.toFixed(2)+' soles</td></tr>';

            if(order.pago_tipo.nombre=='Effectivo'){
                html+='<tr><td>Cancela con : '+order.pago_effectivo_cantidad.toFixed(2)+' soles</td></tr>';
            }

            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                html+
                '</table>';
        }

        var table = $('#main').DataTable( {

            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            "ajax":{
                "url":"http://vrac.ryma-soluciones.com/drinkapp_app_backend/getPedidos_dev",
                "dataSrc": ""
            },
            "iDisplayLength": -1,
            "bFilter": false,
            select: true,
            "bLengthChange": false,
            "columns": [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "id",
                    "render": function ( data, type, row ) {
                        return 'DAPP'+data;
                    }

                },
                {
                    "data": "fecha_pendente",
                    "render": function ( data, type, row ) {
                        // If display or filter data is requested, format the date
                        if ( type === 'display' || type === 'filter' ) {
                            var d = new Date( data * 1000 );
                            return d.getDate() +'-'+ (d.getMonth()+1) +'-'+ d.getFullYear()+' a las '+d.getHours()+'h con '+d.getMinutes()+'min';
                        }

                        // Otherwise the data type requested (`type`) is type detection or
                        // sorting data, for which we want to use the integer, so just return
                        // that, unaltered
                        return data;
                    }
                },
                { "data": "user.nombre" },
                { "data": "user.apellidos" },
                { "data": "user.celular" },
                { "data": "user.email" },
                { "data": "direccion.calle" },
                { "data": "direccion.distrito" },
                { "data": "direccion.referencias" }
            ],
            "order": [[1, 'desc']]
        } );
        table
            .on('xhr.dt', function ( e, settings, json, xhr ) {
                /*for ( var i=0, ien=json.aaData.length ; i<ien ; i++ ) {
                    json.aaData[i].sum = json.aaData[i].one + json.aaData[i].two;
                }*/
                if(table.data().length<xhr.responseJSON.length){
                    var out = [];
                    var rows = table.data();
                    var new_rows = Object.create(json);
                    for (var i=0;i<rows.length;i++){
                        var a_row = rows[i];
                        for (var j=0;j<new_rows.length;j++){
                            var new_row = new_rows[j];
                            if(a_row.id==new_row.id){
                                new_rows.splice(j, 1);
                            }
                        }

                    }

                    if(rows.length!=0){
                        console.log('reste = '+new_rows.length);
                        var time_interval = 100;
                        for (var i=0;i<new_rows.length;i++){
                            var new_pedido = new_rows[i];
                                var notification = new Notification('DrinkApp Notificación', {
                                    icon: 'http://drinkapp.pe/wp-content/themes/zoneshop/page-templates/reader/ressources/LOGO_158X158.png',
                                    body: "Nuevo Pedido Recibido ! Numero DAPP"+new_pedido.id
                                });
                        }
                    }



                }

                //console.log( 'There are'+table.data().length+' row(s) of data in this table' );

                //console.log( table.rows().data() );
                //console.log(xhr.responseJSON);
                // Note no return - manipulate the data directly in the JSON object.
            } )
            .on( 'select', function ( e, dt, type, indexes ) {
                rowDataSelected = table.rows( indexes ).data().toArray()[0];
                //events.prepend( '<div><b>'+type+' selection</b> - '+JSON.stringify( rowData )+'</div>' );
            } )
            .on( 'deselect', function ( e, dt, type, indexes ) {
                rowDataSelected = undefined;
                //var rowData = table.rows( indexes ).data().toArray();
                //events.prepend( '<div><b>'+type+' <i>de</i>selection</b> - '+JSON.stringify( rowData )+'</div>' );
            } );

        $("#pedido-clear").click(function(){
            if(rowDataSelected!=undefined){
                $('#pedido-clear').attr('disabled','disabled');
                $.get( "http://vrac.ryma-soluciones.com/drinkapp_app_backend/pedido_clear?id="+rowDataSelected.id, function( data,status ) {
                    if(status=='success'){
                        eval(data.msg);
                        rowDataSelected = undefined;
                        table.ajax.reload();
                        setTimeout(function(){
                            $('#pedido-clear').removeAttr('disabled');
                        }, 3000);

                    }


                });
            }

        });

// Add event listener for opening and closing details
        $('#main tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {

                var raw_data = row.data();

                $.get( "http://vrac.ryma-soluciones.com/drinkapp_app_backend/getOrderItems_get?id="+raw_data.id, function( data ) {
                    // Open this row
                    raw_data.order_items = data;
                    row.child( format(raw_data) ).show();
                    tr.addClass('shown');
                });


            }
        } );
        setInterval( function () {
            table.ajax.reload(function(data){
                /*var notification = new Notification('Notification title', {
                    icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
                    body: "Hey there! You've been notified!",
                });*/
            });

            /*notification.onclick = function () {
                window.open("http://drinkapp.pe/reader/");
            };*/
        }, 3000 ); //120000

    } );
</script>
</body>
</html>

