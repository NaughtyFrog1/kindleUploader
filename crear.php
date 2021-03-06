<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';
  require_once 'includes/secure/db_conn.php';

  $errores = [];
  $extErronea = false;
  $form = [];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = conectarDB();
    $form = [
      'titulo' => mysqli_real_escape_string($db, $_POST['titulo']),
      'libro'  => $_FILES['libro'],
      'nombre' => mysqli_real_escape_string($db, $_POST['nombre']),
      'apellido' => mysqli_real_escape_string($db, $_POST['apellido']),
    ];

    $extLibro = pathinfo($form['libro']['name'], PATHINFO_EXTENSION);


    //* VALIDACIÓN DE ERRORES

    if ($form['titulo'] === '') {
      $errores[] = 'titulo';
    }

    if ($form['libro']['name'] === '') {
      $errores[] = 'libro';
    } else if ($extLibro !== 'mobi') {
      $extErronea = true; 
    }


    //* GUARDAR LIBRO

    if (!($errores || $extErronea)) {
      if (!is_dir(DIR_LIBROS)) {
        mkdir(DIR_LIBROS);
      }

      $nombreLibro = ($form['nombre'] && $form['apellido'])
        ? "{$form['titulo']} - {$form['nombre']} {$form['apellido']}." . $extLibro
        : "{$form['titulo']}.{$extLibro}"; 
          
      move_uploaded_file(
        $form['libro']['tmp_name'],
        DIR_LIBROS . $nombreLibro
      );

      $str_query = 
        "INSERT INTO libros (titulo, libro, nombre, apellido) VALUES (" .
        "'{$form['titulo']}', '{$nombreLibro}', '{$form['nombre']}', " .
        "'{$form['apellido']}')";
    
      $query = mysqli_query($db, $str_query);

      header("Location: index.php?status=0&libro={$form['titulo']}");
    }

    mysqli_close($db);
  }

  $site_title = 'KindleUpdater - Crear';
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
    <h2>Añadir un libro</h2>

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
          value="<?= $form['titulo'] ?? '' ?>"
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
            value="<?= $form['nombre'] ?? '' ?>"
          >
        </div>
        <div class="input-group">
          <label class="label" for="apellido">apellido</label>
          <input 
            class="input--text" 
            name="apellido" 
            placeholder="Apellido del autor"
            type="text"
            value="<?= $form['apellido'] ?? '' ?>"
          >
        </div>
      </div>
      <div class="form__row--submit">
        <a href="./" class="btn--transparent">Volver</a>
        <input 
          class="btn btn--primary btn--sm m0 input--submit"
          type="submit"
          value="Añadir" 
        >
      </div>
    </form>
  </main>

<?php include_once 'includes/layout/footer.php' ?>
