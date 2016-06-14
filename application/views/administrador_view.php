
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='#'>Inicio</a></li>
            <li><a class='last' href='#'>Administrador</a></li>
        </ul>
    </div>
</div>

<div id="general">
    <div id="menus">
        <div id="enlaces_secciones" class="mod-menu_secciones">
            <ul>
                <li class="tipo2 item-first_level"><a href="#">Administrador</a></li>

                <li class="selected tipo2-selected item-first_level"><a href="#">Inicio</a>
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
        <h1 id="titulo_pagina"><span class="texto_titulo">Administrador</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">
                <div class='mod-forms'>
                    <table class='inline'>
                        <tbody>
                            <tr>
                                <th class='centeralign'>Nombre</th>
                                <th class='centeralign'>Email</th>
                                <th class='centeralign'>Rol</th>
                            </tr>

                            <?php foreach ($usuarios as $usuario): ?>
                                <tr onclick="location.href = '<?php echo base_url(); ?>index.php/administrador/modificar_eliminar_usuario/<?php echo $usuario['id_usuario']; ?>'" style='border-top: 1px solid #000;'>
                                    <td class='par'><?php echo $usuario['nombre'] . " " . $usuario['apellidos']; ?></td>
                                    <td class='par'><?php echo $usuario['email']; ?></td>
                                    <td class='par'><?php echo $usuario['nombre_rol']; ?></a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


