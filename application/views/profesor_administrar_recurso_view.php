
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='<?php echo base_url() . 'index.php/profesor/'; ?>'>Inicio</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/profesor/'; ?>'>Profesor</a></li>
            <li><a class='last' href='<?php echo base_url() . 'index.php/profesor/recursos'; ?>'>Recursos</a></li>                    
            <li><a class='last' href='#'>Administrar</a></li>
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
        <h1 id="titulo_pagina"><span class="texto_titulo">Turno Actual</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">
                <div style="font-size: 14px;">

                    <?php if ($fin == FALSE): ?>
                        <table class=\"tabla_menu\" style=\"width: 100%; border: none;\"><tbody>
                                <tr>
                                    <td><b style="color: #263465;">Alumno</b></td>
                                    <td><?php echo $cita['nombre'] . " " . $cita['apellidos']; ?></td>
                                </tr>

                                <tr>
                                    <td><b style="color: #263465;">Correo</b></td>
                                    <td> <?php echo$cita['correo']; ?> </td>
                                </tr>
                                <tr>
                                    <td><b style="color: #263465;">DNI</b></td>
                                    <td> <?php echo$cita['dni']; ?> </td>
                                </tr>
                                <tr>
                                    <td><b style="color: #263465;">Prioridad</b></td>
                                    <td><?php echo $cita['prioridad']; ?> </td>
                                </tr>
                                <tr>
                                    <td><b style="color: #263465;">Código</b></td>
                                    <td><?php echo $cita['codigo']; ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class='mod-forms'>
                        <div style='float:right;'>
                            <form action="<?php echo base_url() . 'index.php/profesor/administrar/' . $recurso; ?>" method="post">
                                <input type='hidden' id='prioridad' name='prioridad' value='<?php echo $cita['prioridad']; ?>'/>
                                <input type='hidden' id='id_anterior' name='id_anterior' value='<?php echo $cita['id_cita']; ?>'/>
                                <input type='hidden' id='fecha' name='fecha' value='<?php echo $cita['created_at']; ?>'/>
                                <input style="background-color:#FE642E;" type='submit' class='submit' name='terminado'
                                       id='terminado' value='Terminado'/>
                            </form>
                        </div>

                        <div style='float:left;'>
                            <form action="<?php echo base_url() . 'index.php/profesor/administrar/' . $recurso; ?>" method="post">
                                <input type='hidden' id='prioridad' name='prioridad' value='<?php echo $cita['prioridad']; ?>'/>
                                <input type='hidden' id='id_anterior' name='id_anterior' value='<?php echo $cita['id_cita']; ?>'/>
                                <input type='hidden' id='fecha' name='fecha' value='<?php echo $cita['created_at']; ?>'/>
                                <input style="background-color:#FE642E;" type='submit' class='submit' name='sin_terminar'
                                       id='sin_terminar' value='Sin Terminar'/>
                            </form>
                        </div>
                    </div>

                <?php else: ?>
                    <div style='text-align:center; margin:10px auto; font-size:2em'> 
                        No queda ninguna cita por atender.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

