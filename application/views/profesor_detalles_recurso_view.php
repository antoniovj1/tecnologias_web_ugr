
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='<?php echo base_url() . 'index.php/profesor/'; ?>'>Inicio</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/profesor/'; ?>'>Profesor</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/profesor/recursos'; ?>'>Recursos</a></li>                    
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
                    <div align="center">
                        <form action="<?php echo base_url() . 'index.php/profesor/administrar/' . $recurso['id_recurso']; ?>" method="post">
                            <input style="background-color:#FE642E;" type='submit' class='submit' name='administrar' id='administrar' value='Administrar'/>
                            <input type='hidden' id='lugar' name='lugar' value='<?php echo set_value('lugar', $recurso['lugar']); ?>' size='32'/>
                        </form>
                    </div>

                    <?php
                    $atributes = array('id' => 'crear-recurso');
                    echo form_open('profesor/modificar_eliminar/' . $recurso['id_recurso'], $atributes);
                    ?>
                    <fieldset style='width:100%;'>
                        <legend>Modificar Recurso</legend>
                        <label for='lugar'>Lugar (*) <input type='text' id='lugar' name='lugar' value='<?php echo set_value('lugar', $recurso['lugar']); ?>'  size='32'/></label>
                        <label for='asignatura'>Asignatura (*) <input type='text' id='asignatura' name='asignatura' value='<?php echo set_value('asignatura', $recurso['asignatura']); ?>'  size='32'/></label>                            
                        <label for='fecha_ini'>Fecha Inicio (*) <input type='datetime' id='fecha_ini' name='fecha_ini' value='<?php echo set_value('fecha_ini', $recurso['fecha_ini']); ?>' size='40'/></label>

                        <script>
                            $.datetimepicker.setLocale('es');
                            jQuery('#fecha_ini').datetimepicker();
                        </script>

                        <label for='fecha_fin'>Fecha Fin (*) <input type='datetime' id='fecha_fin' name='fecha_fin' value='<?php echo set_value('fecha_fin', $recurso['fecha_fin']); ?>' size='40'/></label>
                        <script> jQuery('#fecha_fin').datetimepicker();</script>
                        <label for='descripcion'>Descripcion (*) <textarea  id='descripcion' name='descripcion'><?php echo $recurso['descripcion']; ?></textarea></label>

                        <div style='float:right;'><input type='submit' class='submit' name='modificar'  id='modificar' value='Modificar'/></div>
                        <div style='float:left;'><input type='submit' class='submit' name='eliminar'  id='eliminar' value='Eliminar'/></div>

                    </fieldset>
                    </form>
                    (* Campos obligatorios)
                </div>
            </div>
        </div>
    </div>
