
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='<?php echo base_url() . 'index.php/profesor/'; ?>'>Inicio</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/profesor/'; ?>'>Profesor</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/profesor/alertas'; ?>'>Alertas</a></li>                    
            <li><a class='last' href='#'>Detalles</a></li>
        </ul>
    </div>
</div>

<div id="general">
    <div id="menus">
        <div id="enlaces_secciones" class="mod-menu_secciones">
            <ul>
                <li class="tipo2 item-first_level"><a href="<?php echo base_url() . 'index.php/profesor/'; ?>">Profesor</a></li>

                <li class="selected tipo2-selected item-first_level"><a href="<?php echo base_url() . 'index.php/profesor/'; ?>">Inicio</a>
                    <ul>
                        <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url() . 'index.php/profesor/perfil'; ?>">Perfil</a></li>
                        <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url() . 'index.php/logout'; ?>">Cerrar Sesion</a></li>
                    </ul>
                    <a href="<?php echo base_url() . 'index.php/profesor/recursos'; ?>">Recursos</a>
                    <ul>
                        <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url() . 'index.php/profesor/crear'; ?>">Crear Recurso</a></li>
                    </ul>
                    <a href="<?php echo base_url() . 'index.php/profesor/alertas'; ?>">Alertas</a>
                    <ul>
                        <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url() . 'index.php/profesor/crear_alerta'; ?>">Crear Alerta</a></li>
                    </ul>
            </ul>
        </div>
    </div>

    <div id="pagina">
        <h1 id="titulo_pagina"><span class="texto_titulo">Detalles</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">
                <div class='mod-forms'>

                    <?php
                    $atributes = array('id' => 'alerta');
                    echo form_open('profesor/modificar_eliminar_alerta/' . $alerta['id_alerta'], $atributes);
                    ?>
                    <fieldset style='width:100%;'>
                        <legend>Modificar Alerta</legend>

                        <label for='mensaje'>Mensaje (*) <textarea  id='mensaje' name='mensaje'><?php echo $alerta['mensaje']; ?></textarea></label>

                        <div style='float:right;'><input type='submit' class='submit' name='modificar'  id='modificar' value='Modificar'/></div>
                        <div style='float:left;'><input type='submit' class='submit' name='eliminar'  id='eliminar' value='Eliminar'/></div>

                    </fieldset>
                    </form>
                    (* Campos obligatorios)
                </div>
            </div>
        </div>
    </div>
