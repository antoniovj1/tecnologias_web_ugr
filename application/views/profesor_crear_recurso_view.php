
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='<?php echo base_url() . 'index.php/profesor/'; ?>'>Inicio</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/profesor/'; ?>'>Profesor</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/profesor/recursos'; ?>'>Recursos</a></li>
            <li><a class='last' href='#'>Crear</a></li>
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
                        <li class="tipo1 item-second_level first-child"><a href="#">Crear Recurso</a></li>
                    </ul>
                    <a href="<?php echo base_url() . 'index.php/profesor/alertas'; ?>">Alertas</a>
                    <ul>
                        <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url() . 'index.php/profesor/crear_alerta'; ?>">Crear Alerta</a></li>
                    </ul>
            </ul>
        </div>
    </div>

    <div id="pagina">
        <h1 id="titulo_pagina"><span class="texto_titulo">Crear</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">
                <div class='mod-forms'>
                    <?php
                    $atributes = array('id' => 'crear-recurso');
                    echo form_open('profesor/crear', $atributes);
                    ?>
                    <fieldset style='width:100%;'>
                        <legend>Crear Recurso</legend>
                        <label for='lugar'>Lugar (*) <input type='text' id='lugar' name='lugar' value=''  size='32'/></label>
                        <label for='asignatura'>Asignatura (*) <input type='text' id='asignatura' name='asignatura' value='' size='32'/></label>                            
                        <label for='fecha_ini'>Fecha Inicio (*) <input type='datetime' id="fecha_ini"  name='fecha_ini' value='' size='40'/></label>

                        <script>
                            $.datetimepicker.setLocale('es');
                            jQuery('#fecha_ini').datetimepicker();
                        </script>

                        <label for='fecha_fin'>Fecha Fin (*) <input type='datetime' id='fecha_fin' name='fecha_fin' value='' size='40'/></label>
                        <script> jQuery('#fecha_fin').datetimepicker();</script>
                        <label for='descripcion'>Descripcion (*) <textarea  id='descripcion' name='descripcion' ></textarea></label> 

                        <div style='float:right;'><input type='submit' class='submit' name='add' id='add' value='Añadir'/></div>
                    </fieldset>
                    </form>
                    (* Campos obligatorios)
                </div>
            </div>
        </div>
    </div>
