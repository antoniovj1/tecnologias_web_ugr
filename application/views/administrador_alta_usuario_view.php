<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='<?php echo base_url() . 'index.php/administrador/'; ?>'>Inicio</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/administrador/'; ?>'>Administrador</a></li>
            <li><a class='last' href='#'>Alta Usuario</a></li>
        </ul>
    </div>
</div>

<div id="general">
    <div id="menus">
        <div id="enlaces_secciones" class="mod-menu_secciones">
            <ul>
                <li class="tipo2 item-first_level"><a href="<?php echo base_url() . 'index.php/administrador/'; ?>">Administrador</a></li>

                <li class="selected tipo2-selected item-first_level"><a href="<?php echo base_url() . 'index.php/administrador/'; ?>">Inicio</a>
                    <ul>
                        <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url() . 'index.php/administrador/perfil'; ?>">Perfil</a></li>
                        <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url() . 'index.php/logout'; ?>">Cerrar Sesion</a></li>
                    </ul>
                    <a href="<?php echo base_url() . 'index.php/administrador/recursos'; ?>">Recursos</a>
                    <ul>
                        <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url() . 'index.php/administrador/crear_recurso'; ?>">Crear Recurso</a></li>
                    </ul>
                <li class="selected tipo2-selected item-first_level"><a href="<?php echo base_url() . 'index.php/administrador/usuarios'; ?>">Usuarios</a></li>
                <ul>
                    <li class="tipo1 item-second_level first-child"><a href="<?php echo base_url() . 'index.php/administrador/alta_usuario'; ?>">Alta Usuario</a></li>
                </ul>
            </ul>
        </div>
    </div>

    <div id="pagina">
        <h1 id="titulo_pagina"><span class="texto_titulo">Alta Usuario</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">
                <div class='mod-forms'>

                    <?php
                    $atributes = array('id' => 'alta-usuario');
                    echo form_open('administrador/alta_usuario', $atributes);
                    ?>
                    <fieldset style='width:100%;'>
                        <legend>Alta Usuario</legend>
                        <label for='nick'>Nombre Usuario (*) <input type='text' id='nick' name='nick'  size='32'></label>
                        <label for='nombre'>Nombre (*) <input type='text' id='nombre' name='nombre'  size='32'></label>
                        <label for='apellidos'>Apellidos (*) <input type='text' id='apellidos' name='apellidos' size='32'></label>                            
                        <label for='email'>Email (*) <input type='text' id='email' name='email' size='40'></label>


                        <label> Rol (*) <br />
                            <select name="rol" id="rol" style="width: 150px">
                                <?php foreach ($roles as $rol): ?>
                                    <option name="<?php echo $rol['nombre_rol']; ?>" value="<?php echo $rol['id_rol']; ?>"><?php echo ucfirst($rol['nombre_rol']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label> 


                        <div id="extraProfesor" name ="extraProfesor" style="display: none">
                            <label for='departamento'>Departamento (*) <input type='text' id='departamento' name='departamento' value='' size='40'></label>
                        </div>    

                        <label for='passw'>Contraseña (*) <input type='text' id='passw' name='passw' value='' size='40'></label> 

                        <div style='float:right;'><input type='submit' class='submit' name='alta' id='alta' value='Alta'/></div>
                    </fieldset>
                    </form>
                    (* Campos obligatorios)
                    <!-- AltaUsuario -->
                    <script src="<?php echo base_url(); ?>public/js/altaUsuario.js"></script>
                </div>
            </div>
        </div>
    </div>



