<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor">
    <?php if(!empty($registros)) { ?>
        <div class="table-wrapper">
            <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th scope="col" class="table__th">Nombre</th>
                        <th scope="col" class="table__th">E-mail</th>
                        <th scope="col" class="table__th">Plan</th>
                    </tr>
                </thead>

                <tbody class="table__tbody">
                    <?php foreach($registros as $registro) { ?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido; ?>
                            </td>

                            <td class="table__td">
                                <?php echo $registro->usuario->email; ?>
                            </td>

                            <td class="table__td">
                                <?php echo $registro->paquete->nombre; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>                
    <?php } else { ?>
        <p class="text-center">No Hay Registros Aún</p>

    <?php } ?>
</div>

<?php 
    echo $paginacion;
?>