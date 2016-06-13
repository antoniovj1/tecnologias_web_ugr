
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='<?php echo base_url(); ?>'>Inicio</a></li>
            <li><a class='last' href='<?php echo base_url(); ?>'>Recursos</a></li>
            <li><a class='last' href='#'>Consultar Turno</a></li>
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
                    <li class="tipo1 item-second_level first-child"><a href="#">Consultar Turno</a></li>
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
        <h1 id="titulo_pagina"><span class="texto_titulo">Consultar Turno</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">

                <div style='text-align:center; margin:10px auto; font-size:2em'> 
                    <?php
                    if ($eliminado == TRUE) {
                        echo "Eliminado correctamente.";
                    } elseif ($posicion != NULL) {
                        echo "Tiene por delante menos de " . $posicion . " personas.";
                    }
                    ?>
                </div>
                <div class='mod-forms'>

                    <?php
                    $atributes = array('id' => 'consultar-turno');
                    echo form_open('consultar_turno', $atributes);
                    ?>

                    <fieldset style='width:100%;'>
                        <legend>Consultar Turno</legend>
                        <label for='codigo'>Código (*) <input type='text' id='codigo' name='codigo' value='' size='32'/></label>
                        <div style='float:right;'><input type='submit' class='submit' name='cancelar' id='cancelar' value='Cancelar'/></div>
                        <div style='float:left;'><input type='submit' class='submit' name='consultar' id='consultar' value='Consultar'/></div>
                    </fieldset>
                    </form>
                    (* Campos obligatorios)
                </div>
            </div>
        </div>
    </div>
