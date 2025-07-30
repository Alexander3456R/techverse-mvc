<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Tu cuenta TechVerse</p>
    <?php require_once __DIR__ . '/../templates/alertas.php'; ?>

    <?php if(isset($alertas['exito'])) { ?>
        <div class="acciones acciones--centrar">
            <a href="/login" class="acciones__enlace acciones__enlace--confirmado">Iniciar Sesión</a>
        </div>
  <?php  } ?>
</main>