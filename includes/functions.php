<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';
?>

<?php function crearAlerta(string $type, string $msg ) { ?>
  <div class="alerts--<?= $type ?> alerts--fixed">
    <p class="ta--center"><?= $msg ?></p>
  </div>
<?php } ?>
