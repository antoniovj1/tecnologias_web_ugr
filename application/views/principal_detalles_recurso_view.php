
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='<?php echo base_url(); ?>'>Inicio</a></li>
            <li><a class='last' href='<?php echo base_url(); ?>'>Recursos</a></li>
            <li><a class='last' href='#'>Detalles Recurso</a></li>
        </ul>
    </div>
</div>

<div id="general">
    <div id="menus">
        <div id="enlaces_secciones" class="mod-menu_secciones">
            <ul>
                <li class="tipo2 item-first_level"><a href="<?php echo base_url(); ?>">Inicio</a></li>

                <li class="selected tipo2-selected item-first_level"><a href="<?php echo base_url(); ?>">Recursos</a></li>
                <ul>
                    <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url(); ?>index.php/consultar_turno/">Consultar Turno</a></li>
                </ul>
            </ul>
        </div>

        <?php
        $atributes = array('id' => 'login', 'class' => 'widget_loginform');
        echo form_open('login', $atributes);
        ?>

        <div id="login_form_widget" class="mod-buttons fieldset login_form login_form_widget">
            <label id="login_widget" for="ilogin_widget" class="login login_widget">
                <span>Usuario</span>
                <input name="nick" id="nick" type="text">
            </label>
            <label id="password_widget" for="ipassword_widget" class="password password_widget">
                <span>Contraseña</span>
                <input name="passw" id="ipassword_widget" type="password">
            </label>
            <label id="enviar_login_widget" for="submit_login_widget" class="enviar_login enviar_login_widget">
                <input src="<?php echo base_url(); ?>public/img/transp.gif" alt="enviar datos de identificación" name="submit" id="submit_login_widget" class="image-enviar" type="image">
            </label>
            <span id="login_error_widget"> </span>
        </div>
        </form>
    </div>

    <div id="pagina">
        <h1 id="titulo_pagina"><span class="texto_titulo">Detalles Recurso</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">

                <?php if ($nuevo == FALSE) : ?>

                    <div style="font-size: 14px;">
                        <table class="tabla_menu" style="width: 100%; border: none;"><tbody>
                                <tr>
                                    <td><b style="color: #263465;">Asignatura</b></td>
                                    <td> <?php echo$recurso['asignatura']; ?> </td>
                                </tr>
                                <tr>
                                    <td><b style="color: #263465;">Lugar</b></td>
                                    <td> <?php echo$recurso['lugar']; ?> </td>
                                </tr>
                                <tr>
                                    <td><b style="color: #263465;">Fecha</b></td>
                                    <td><?php echo $recurso['fecha_ini']; ?> a <?php echo $recurso['fecha_fin']; ?></td>
                                </tr>
                                <tr>
                                    <td><b style="color: #263465;">Código</b></td>
                                    <td><?php echo $recurso['codigo']; ?></td>
                                </tr>
                                <tr>
                                    <td><b style="color: #263465;">Profesor</b></td>
                                    <td><?php echo $recurso['nombre'] . " " . $recurso['apellidos']; ?></td>
                                </tr>

                                <tr>
                                    <td><b style="color: #263465;">Descripción</b></td>
                                    <td><?php echo $recurso['descripcion']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="alta_cita" class='mod-forms'>

                        <?php
                        $attributes = array('id' => 'crear-cita');
                        echo form_open('principal/add_cita/' . $recurso['id_recurso'], $attributes);
                        ?>

                        <fieldset style='width:100%;'>
                            <legend>Apuntarse a la cola del recurso</legend>
                            <label for='nombre'>Nombre (*) <input type='text' id='nombre' name='nombre' value=''  size='32'/></label>
                            <label for='ape'>Apellidos (*) <input type='text' id='apellidos' name='apellidos' value='' size='40'/></label>
                            <label for='dni'>NIF / NIE / CIF (*) <input type='text' id='dni' name='dni'  value='' size='12'/></label>
                            <label for='email'>Correo electrónico (*) <input type='text' id='email' name='email' value='' size='40'/></label>

                            <!--Para validación-->
                            <input type="hidden"  id='id_recurso' name='id_recurso' value='<?php echo set_value('id_recurso', $recurso['id_recurso']); ?>' />

                            <div style='float:right;'><input type='submit' class='submit' name='apuntarse' id='apuntarse' value='Apuntarse'/></div>
                        </fieldset>
                        </form>
                        (* Campos obligatorios)
                    </div> 
                    <div id="inscripcion_cerrada" style='text-align:center; margin:10px auto; font-size:2em'>

                        Ya ha pasado la fecha de inscripción.

                    </div>

                <?php else : ?>
                    <div style='text-align:center; margin:10px auto; font-size:2em'>
                        <?php
                        echo "Su código es $codigo.";
                        ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>


    <!-- Detalles 
        Cada 15 segundos se revisa si la fecha ha pasado, en caso de ser asó,
        muestra un mensaje y oculta el formulario de inscripcion.
    -->
    <script src="<?php echo base_url(); ?>public/js/detalles_recurso.js"></script>
    <script>
        detalles("<?php echo $recurso['fecha_ini']; ?>");
        setInterval(function () {
            detalles("<?php echo $recurso['fecha_ini']; ?>");
        }, 15000);
    </script>
