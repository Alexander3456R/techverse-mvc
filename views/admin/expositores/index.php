<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/expositores/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Expositor
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if(!empty($expositores)) { ?>
        <div class="table-wrapper">
            <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th scope="col" class="table__th">Nombre</th>
                        <th scope="col" class="table__th">Ubicación</th>
                        <th scope="col" class="table__th"></th>
                    </tr>
                </thead>

                <tbody class="table__tbody">
                    <?php foreach($expositores as $expositor) { ?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo $expositor->nombre . " " . $expositor->apellido; ?>
                            </td>

                            <td class="table__td">
                                <?php echo $expositor->ciudad . ", " . $expositor->pais; ?>
                            </td>


                            <td class="table__td--acciones">
                                <a class="table__accion table__accion--editar" href="/admin/expositores/editar?id=<?php echo $expositor->id; ?>">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Editar
                                </a>

                                <form method="POST" action="/admin/expositores/eliminar" class="table__formulario">
                                    <input type="hidden" name="id" value="<?php echo $expositor->id; ?>">
                                    <button class="table__accion table__accion--eliminar" type="submit">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>                
    <?php } else { ?>
        <p class="text-center">No Hay Expositores Aún</p>

    <?php } ?>
</div>

<?php 
    echo $paginacion;
?>