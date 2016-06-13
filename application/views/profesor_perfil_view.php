
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='<?php echo base_url(); ?>'>Inicio</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/profesor/'; ?>'>Profesor</a></li>
            <li><a class='last' href='#'>Perfil</a></li>
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
                        <li class="tipo1 item-second_level first-child"><a href="#">Perfil</a></li>
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
        <h1 id="titulo_pagina"><span class="texto_titulo">Perfil</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">
                <div class='mod-forms'>

                    <?php
                    $atributes = array('id' => 'perfil-profesor');
                    echo form_open('profesor/perfil/', $atributes);
                    ?>

                    <fieldset style='width:100%;'>
                        <legend>Modificar Profesor</legend>
                        <label for='nick'>Nombre Usuario (*) <input type='text' id='nick' name='nick'  value='<?php echo set_value('nick', $usuario['nick']); ?>' size='32'></label>
                        <label for='nombre'>Nombre (*) <input type='text' id='nombre' name='nombre' value='<?php echo set_value('nombre', $usuario['nombre']); ?>' size='32'></label>
                        <label for='apellidos'>Apellidos (*) <input type='text' id='apellidos' name='apellidos' value='<?php echo set_value('apellidos', $usuario['apellidos']); ?>'size='32'></label>                            
                        <label for='email'>Email (*) <input type='email' id='email' name='email' value='<?php echo set_value('email', $usuario['email']); ?>' size='40'></label>

                        <label for='departamento'>Departamento (*) <input type='text' id='departamento' name='departamento' value='<?php echo set_value('departamento', $usuario['departamento']); ?>' size='40'></label>    

                        <label for='passw'>Contraseña (*) <input type='text' id='passw' name='passw' value='' size='40'></label> 


                        <div style='float:right;'><input type='submit' class='submit' name='modificar' id='modificar' value='Modificar'/></div>

                    </fieldset>
                    </form>
                    (* Campos obligatorios)
                </div>
            </div>
        </div>
    </div>

