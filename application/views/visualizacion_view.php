<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Módulo Visualización</title>
        <meta charset="utf-8">
        <link rel="stylesheet" id="css-style" type="text/css" href="<?php echo base_url(); ?>public/css/visualizacion.css" media="all"/>
        <script src="<?php echo base_url(); ?>public/js/clock.js"></script>

        <!-- jQuery y AJAX Visualización-->
        <script src="<?php echo base_url(); ?>public/js/jquery-1.12.4.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/visualizacion.js"></script>

    </head>

    <body  onload="startTime()">
        <header>
            <img class="img_cab" src="<?php echo base_url(); ?>public/img/WebDECSAI.png" style="float: right;">
            <img class="img_cab" src="<?php echo base_url(); ?>public/img/ugr.png" style="float: left;">
            <div id="clock" class="clock"> </div>
        </header>

        <table>
            <tr>
                <th class="izquierda">Código</th>
                <th class="derecha">Lugar</th>
                <th class="derecha">Hora</th>
            </tr>
            <tr class="par">
                <td id="idc1" class="izquierda"></td>
                <td id="idl1" class="derecha"></td>
                <td id="idh1" class="derecha"></td>
            </tr>
            <tr class="impar">
                <td id="idc2" class="izquierda"></td>
                <td id="idl2" class="derecha"></td>
                <td id="idh2" class="derecha"></td>

            </tr>
            <tr class="par">
                <td id="idc3" class="izquierda"></td>
                <td id="idl3" class="derecha"></td>
                <td id="idh3" class="derecha"></td>

            </tr>

            <tr class="impar">
                <td id="idc4" class="izquierda"></td>
                <td id="idl4" class="derecha"></td>
                <td id="idh4" class="derecha"></td>

            </tr>
            <tr class="par">
                <td id="idc5" class="izquierda"></td>
                <td id="idl5" class="derecha"></td>
                <td id="idh5" class="derecha"></td>

            </tr>

            <tr class="impar">
                <td id="idc6" class="izquierda"></td>
                <td id="idl6" class="derecha"></td>
                <td id="idh6" class="derecha"></td>

            </tr>
        </table>


        <fieldset class="alertas">
            <legend > Alertas </legend>
            <div id="alertas" class="interior_alertas marquee">

            </div>
        </fieldset>


        <footer>
            <img class="img_pie" src="<?php echo base_url(); ?>public/img/pie_izq.png" style=" float: right;" >
            <img class="img_pie" src="<?php echo base_url(); ?>public/img/pie_der.png" style=" float: left;" >
        </footer>

    </body>
</html>
