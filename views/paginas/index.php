<?php
include_once __DIR__ . '/conferencias.php';
?>


<section class="resumen">
    <div class="resumen__grid">
        <div <?php echo aos_animation(); ?> class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $expositores_total; ?></p>
            <p class="resumen__texto">Speakers</p>
        </div>


        <div <?php echo aos_animation(); ?> class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $conferencias_total; ?></p>
            <p class="resumen__texto">Conferencias</p>
        </div>


        <div <?php echo aos_animation(); ?> class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero"><?php echo $workshops_total; ?></p>
            <p class="resumen__texto">Workshops</p>
        </div>


        <div <?php echo aos_animation(); ?> class="resumen__bloque">
            <p class="resumen__texto resumen__texto--numero">500</p>
            <p class="resumen__texto">Asistentes</p>
        </div>
    </div>
</section>

<section class="speakers">
    <h2 class="speakers__heading">Speakers</h2>
    <p class="speakers__descripcion">Conoce a nuestros expertos de TechVerse</p>


    <div class="speakers__grid">
        <?php foreach($expositores as $expositor) { ?>
                <div <?php echo aos_animation(); ?> class="speaker">
                    <picture>
                        <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $expositor->imagen; ?>.webp" type="image/webp">
                        <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $expositor->imagen; ?>.png" type="image/png">
                        <img class="speaker__imagen" loading="lazy" width="200" height="300" src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $expositor->imagen; ?>.png" alt="Imagen Expositor">
                    </picture>

                    <div class="speaker__informacion">
                        <h4 class="speaker__nombre">
                            <?php echo $expositor->nombre . ' ' . $expositor->apellido; ?>
                        </h4>
                        <p class="speaker__ubicacion">
                            <?php echo $expositor->ciudad . ', ' . $expositor->pais; ?>
                        </p>

                        <nav class="speaker-sociales">
                            <?php 
                                $redes = json_decode( $expositor->redes );
                            ?>

                            <?php if(!empty($redes->facebook)) { ?>
                                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->facebook; ?>">
                                    <span class="speaker-sociales__ocultar">Facebook</span>
                                </a> 
                            <?php } ?>

                            <?php if(!empty($redes->twitter)) { ?>
                                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->twitter; ?>">
                                    <span class="speaker-sociales__ocultar">Twitter</span>
                                </a> 
                            <?php } ?>

                            <?php if(!empty($redes->youtube)) { ?>
                                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->youtube; ?>">
                                    <span class="speaker-sociales__ocultar">YouTube</span>
                                </a> 
                            <?php } ?>

                            <?php if(!empty($redes->instagram)) { ?>
                                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->instagram; ?>">
                                    <span class="speaker-sociales__ocultar">Instagram</span>
                                </a> 
                            <?php } ?>

                            <?php if(!empty($redes->tiktok)) { ?>
                                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->tiktok; ?>">
                                    <span class="speaker-sociales__ocultar">Tiktok</span>
                                </a> 
                            <?php } ?>

                            <?php if(!empty($redes->github)) { ?>
                                <a class="speaker-sociales__enlace" rel="noopener noreferrer" target="_blank" href="<?php echo $redes->github; ?>">
                                    <span class="speaker-sociales__ocultar">GitHub</span>
                                </a>
                            <?php } ?>
                        </nav>

                        <ul class="speaker__listado-skills">
                            <?php $tags = explode(',', $expositor->tags) ?>
                            <?php foreach($tags as $tag) { ?>
                                <li class="speaker__skill"><?php echo $tag; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
        <?php }; ?>
    </div>
</section>

<div id="mapa" class="mapa"></div>

<section class="boletos">
    <h2 class="boletos__heading">Boletos y Precios</h2>
    <p class="boletos__descripcion">Precios para TechVerse</p>

    <div class="boletos__grid">
        <div <?php echo aos_animation(); ?> class="boleto boleto--presencial">
            <h4 class="boleto__logo">&#60;TechVerse /></h4>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">$79,99</p>
        </div>

        <div <?php echo aos_animation(); ?> class="boleto boleto--virtual">
            <h4 class="boleto__logo">&#60;TechVerse /></h4>
            <p class="boleto__plan">Virtual</p>
            <p class="boleto__precio">$39,99</p>
        </div>

        <div <?php echo aos_animation(); ?> class="boleto boleto--gratis">
            <h4 class="boleto__logo">&#60;TechVerse /></h4>
            <p class="boleto__plan">Gratis</p>
            <p class="boleto__precio">Gratis - $0</p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver Paquetes</a>
    </div>
</section>