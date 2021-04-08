<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';
  require_once 'includes/secure/db_conn.php';

  $db = conectarDB();
  $idValidar = filter_var($_GET['id'], FILTER_VALIDATE_INT);
  $query = mysqli_query($db, "SELECT * FROM libros WHERE id = {$idValidar}");

  if (!$idValidar || $query->num_rows === 0) {
    header('Location: index.php?status=10');
  }

  $libro = mysqli_fetch_assoc($query);

  $errores = [];
  $extErronea = false;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form = [
      'titulo' => mysqli_real_escape_string($db, $_POST['titulo']),
      'libro'  => $_FILES['libro'],
      'nombre' => mysqli_real_escape_string($db, $_POST['nombre']),
      'apellido' => mysqli_real_escape_string($db, $_POST['apellido']),
    ];

    $extLibro = ($form['libro']['name']) 
      ? pathinfo($form['libro']['name'], PATHINFO_EXTENSION)
      : pathinfo($libro['libro'], PATHINFO_EXTENSION);


    //* VALIDACIÓN DE ERRORES

    if ($form['titulo'] === '') {
      $errores[] = 'titulo';
    }

    if ($extLibro !== 'mobi') {
      $extErronea = true; 
    }


    //* GUARDAR LIBRO

    if (!($errores || $extErronea)) {
      if (!is_dir(DIR_LIBROS)) {
        mkdir(DIR_LIBROS);
      }

      $nombreLibro = ($form['nombre'] && $form['apellido'])
        ? "{$form['titulo']} - {$form['nombre']} {$form['apellido']}.{$extLibro}" 
        : "{$form['titulo']}.{$extLibro}"; 

      // Si se agrego un nuevo libro; eliminar libro anterior y agregar nuevo
      if ($form['libro']['name'] !== '') {
        unlink(DIR_LIBROS . $libro['libro']);

        move_uploaded_file(
          $form['libro']['tmp_name'],
          DIR_LIBROS . $nombreLibro
        );
      } else {
        // Cambiar nombre libro para coincidir con los cambios
        rename(DIR_LIBROS . $libro['libro'], DIR_LIBROS . $nombreLibro);
      }

      $str_query = 
        "UPDATE libros SET " .
        "titulo = '{$form["titulo"]}', " .
        "libro  = '{$nombreLibro}', " .
        "nombre = '{$form["nombre"]}', " .
        "apellido = '{$form["apellido"]}' " .
        "WHERE id = {$idValidar}";
      $query = mysqli_query($db, $str_query);

      header("Location: index.php?status=1&libro={$form['titulo']}");
    }
  }

  mysqli_close($db);

  $site_title = 'KindleUpdater - Editar';
  include_once 'includes/layout/header.php';
?>

<?php if ($errores || $extErronea) { ?>
  <div class="alerts--error section container container--lg">
    <?php if($errores) { ?>
      <p class="ta--center">
        Falta completar campo de:
        <?php foreach($errores as $error) { echo ucfirst($error) . " "; } ?>
      </p>
    <?php } ?>
    <?php if($extErronea) { ?>
      <p class="ta--center">El archivo debe ser .mobi</p>
    <?php } ?>
  </div>
<?php } ?>

<main class="añadir section container container--lg">
    <h2>Editar libro</h2>

    <form 
      action=""
      class="form form--añadir container container--sm"
      enctype="multipart/form-data"
      method="post"
    >
      <div class="input-group">
        <label class="label" for="titulo">título</label>
        <input 
          class="input--text" 
          name="titulo" 
          placeholder="Título del libro"
          type="text"
          value="<?= $libro['titulo'] ?>"
        >
      </div>
      <div class="input-group">
        <label for="libro" class="label">
          libro 
          <span class="libro__formato">.mobi</span>
        </label>
        <input
          accept=".mobi"
          class="input--text"
          name="libro"
          type="file"
        >
        <p><em>Libro actual:</em> <?= $libro['libro'] ?></p>
      </div>
      <p class="form__aclaracion">
        Sobre el autor
        <span class="libro__formato">(no es obligatorio)</span>
      </p>
      <div class="form__row">
        <div class="input-group">
          <label class="label" for="nombre">nombre</label>
          <input 
            class="input--text" 
            name="nombre" 
            placeholder="Nombre del autor"
            type="text"
            value="<?= $libro['nombre'] ?>"
          >
        </div>
        <div class="input-group">
          <label class="label" for="apellido">apellido</label>
          <input 
            class="input--text" 
            name="apellido" 
            placeholder="Apellido del autor"
            type="text"
            value="<?= $libro['apellido'] ?>"
          >
        </div>
      </div>
      <div class="form__row--submit">
        <a href="./" class="btn--transparent">Volver</a>
        <input 
          class="btn btn--primary btn--sm m0 input--submit"
          type="submit"
          value="Editar" 
        >
      </div>
    </form>
  </main>

<?php include_once 'includes/layout/footer.php' ?>
