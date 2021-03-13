<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';
  require_once 'includes/secure/db_conn.php';
?>

<?php function crearAlerta(string $type, string $msg ) { ?>
  <div class="alerts--<?= $type ?> section container container--lg">
    <p class="ta--center"><?= $msg ?></p>
  </div>
<?php } ?>
