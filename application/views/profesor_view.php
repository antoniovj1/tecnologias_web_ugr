
<div id="rastro-idiomas">
    <div class="language">
    </div>
    <div id="rastro">
        <ul id="rastro_breadcrumb">
            <li class='first'><a class='first' href='#'>Inicio</a></li>
            <li><a class='last' href='#'>Profesor</a></li>
        </ul>
    </div>
</div>

<div id="general">
    <div id="menus">
        <div id="enlaces_secciones" class="mod-menu_secciones">
            <ul>
                <li class="tipo2 item-first_level"><a href="#">Profesor</a></li>

                <li class="selected tipo2-selected item-first_level"><a href="#">Inicio</a>
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
        <h1 id="titulo_pagina"><span class="texto_titulo">Proximos Recursos</span></h1>
        <div id="contenido" class="sec_interior">
            <div class="content_doku">
                <div class='mod-forms'>
                    <table class='inline'>
                        <tbody>
                            <tr>
                                <th class='centeralign'>Asignatura</th>
                                <th class='centeralign'>Horario</th>
                                <th class='centeralign'>Lugar</th>
                            </tr>

                            <?php foreach ($recursos as $recurso): ?>
                                <tr onclick="location.href = '<?php echo base_url(); ?>index.php/profesor/modificar_eliminar/<?php echo $recurso['id_recurso']; ?>'" style='border-top: 1px solid #000;'>
                                    <td class='par'><?php echo $recurso['asignatura']; ?></td>
                                    <td class='par'><?php echo $recurso['fecha_ini']; ?> hasta <?php echo $recurso['fecha_fin']; ?></td>
                                    <td class='par'><?php echo $recurso['lugar']; ?></a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

