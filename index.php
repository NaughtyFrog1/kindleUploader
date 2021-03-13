<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';
  require_once 'includes/secure/db_conn.php';

  $db = conectarDB();

  $count = mysqli_fetch_assoc(
    mysqli_query($db, "SELECT COUNT(id) AS total FROM libros")
  );

  $query = mysqli_query($db, "SELECT * FROM libros");

  
  $site_title = 'KindleUpdater';
  include_once 'includes/layout/header.php';
?>

<?php if ($_GET['status'] === '0') { ?>
  <div class="alerts--success section container container--lg">
    <p class="ta--center">Se añadió "<?= $_GET['libro'] ?>"</p>
  </div>
<?php } ?>

<?php if ($_GET['status'] === '10') { ?>
  <div class="alerts--error section container container--lg">
    <p class="ta--center">El libro elegido para editar no existe</p>
  </div>
<?php } ?>

<section class="listado section container container--lg">
  <div class="listado__header-table">
    <div class="listado__total">
      <div class="total__num-container">
        <p class="total__numero shadow-text">
          <?= $count['total'] ?>
        </p>
      </div>
      <p class="total__text">Libros</p>
    </div>
    <a href="crear.php" class="btn--transparent">
      Añadir un libro
    </a>
  </div>

  <div class="table-container">
    <table class="listado__table">
      <thead>
        <th class="shadow-text">Nombre</th>
        <th class="shadow-text">Autor</th>
        <th class="shadow-text">Acciones</th>
      </thead>
      <tbody>
        <?php while ($libro = mysqli_fetch_assoc($query)) { ?>
          <tr>
            <td><?= $libro['titulo'] ?></td>
            <td><?= $libro['nombre'] . " " . $libro['apellido'] ?></td>
            <td class="table__acciones">
              <div class="acciones__container">
                <a 
                  class="table__accion"
                  href="editar.php?id=<?= $libro['id'] ?>" 
                >
                  <img 
                    src="src/assets/images/icons/pen.svg" 
                    alt="Actualizar"
                  >
                </a>
                <a 
                  class="table__accion"
                  href="libros/<?= $libro['libro'] ?>" 
                  download="<?= $libro['libro'] ?>"
                >
                  <img 
                    src="src/assets/images/icons/download.svg" 
                    alt="Download"
                  >
                </a>
                <form class="table__accion" method="post">
                  <input
                    name="id"
                    type="hidden"
                    value="<?= $libro['id'] ?>"
                  >
                  <input type="submit" value=''>
                </form>
              </div>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>

<?php
  include_once 'includes/layout/footer.php';
?>