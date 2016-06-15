
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='#'>Inicio</a></li>
            <li><a class='last' href='#'>Recursos</a></li>
        </ul>
    </div>
</div>

<div id="general">
    <div id="menus">
        <div id="enlaces_secciones" class="mod-menu_secciones">
            <ul>
                <li class="tipo2 item-first_level"><a href="#">Inicio</a></li>

                <li class="selected tipo2-selected item-first_level"><a href="#">Recursos</a></li>
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
        <h1 id="titulo_pagina"><span class="texto_titulo">Recursos</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">
                <div class='mod-forms'>
                    <form method='post' id='profesor' action='#?p=profesores'>
                        <table class='inline'>
                            <tbody>
                                <tr>
                                    <th class='centeralign'>Profesor</th>
                                    <th class='centeralign'>Horario</th>
                                    <th class='centeralign'>Asignatura</th>
                                </tr>

                                <?php foreach ($recursos as $recurso): ?>
                                    <tr onclick="location.href = '<?php echo base_url(); ?>index.php/recurso/<?php echo $recurso['id_recurso']; ?>'" style='border-top: 1px solid #000;'>
                                        <td class='par centeralign'><?php echo $recurso['nombre'] . " " . $recurso['apellidos']; ?></td>
                                        <td class='par centeralign'><?php echo $recurso['fecha_ini']; ?> hasta <?php echo $recurso['fecha_fin']; ?></td>
                                        <td class='par centeralign'><?php echo $recurso['asignatura']; ?></a></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>