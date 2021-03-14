<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';
  require_once 'includes/secure/db_conn.php';
  require_once 'includes/functions.php';

  $db = conectarDB();

  $count = mysqli_fetch_assoc(
    mysqli_query($db, "SELECT COUNT(id) AS total FROM libros")
  );

  $query = mysqli_query($db, "SELECT * FROM libros");

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    if ($id) {
      // Borrar libro
      $libro = mysqli_fetch_assoc(mysqli_query(
        $db, "SELECT libro FROM libros WHERE id = {$id}"
      ));
      unlink(DIR_LIBROS . $libro['libro']);

      // Borrar libro de la base de datos
      $borrar = mysqli_query(
        $db, "DELETE FROM libros WHERE id = {$id}"
      );

      if ($borrar) {
        header('Location: ./');
      }
    }
  }

  mysqli_close($db);

  $site_title = 'KindleUpdater';
  include_once 'includes/layout/header.php';
?>

<?php if ($_GET['status'] === '0') { 
  crearAlerta('success', "Se añadió '{$_GET['libro']}'");  
} ?>

<?php if ($_GET['status'] === '1') { 
  crearAlerta('success', "Se editó '{$_GET['libro']}'");  
} ?>

<?php if ($_GET['status'] === '10') { 
  crearAlerta('error', "El libro elegido para editar no existe");  
} ?>

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