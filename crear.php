<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';
  require_once 'includes/secure/db_conn.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = conectarDB();
    $errores = [];
    $form = [
      'titulo' => '',
      'libro'  => '',
      'nombre' => '',
      'apellido' => '',
    ];

    $form['titulo']   = mysqli_real_escape_string($db, $_POST['titulo']);
    $form['libro']    = $_FILES['libro'];
    $form['nombre']   = mysqli_real_escape_string($db, $_POST['nombre']);
    $form['apellido'] = mysqli_real_escape_string($db, $_POST['apellido']);


    //* VALIDACIÓN DE ERRORES

    foreach ($form as $key => $value) {
      if ($value === '') {
        $errores[] = $key;
      }
    }

    if ($form['libro']['name'] === '') {
      $errores[] = 'libro';
    }


    //* GUARDAR LIBRO

    if (!$errores) {
      if (!is_dir(DIR_LIBROS)) {
        mkdir(DIR_LIBROS);
      }

      $nombreLibro = 
        "{$form['titulo']} - {$form['nombre']} {$form['apellido']}." .
        pathinfo($form['libro']['name'], PATHINFO_EXTENSION);

      move_uploaded_file(
        $form['libro']['tmp_name'],
        DIR_LIBROS . $nombreLibro
      );

      $str_query = 
        "INSERT INTO libros (titulo, libro, nombre, apellido) VALUES (" .
        "'{$form['titulo']}', '{$nombreLibro}', '{$form['nombre']}', " .
        "'{$form['apellido']}')";
    
      $query = mysqli_query($db, $str_query);

      header('Location: /kindleUploader/index.php?status=0');
    }
  }

  $site_title = 'KindleUpdater - Crear';
  include_once 'includes/layout/header.php';
?>

<?php if ($errores) { ?>
  <div class="alerts--error section container container--lg">
    <p>
      Falta completar campo de:
      <?php foreach($errores as $error) { echo ucfirst($error) . " "; } ?>
    </p>
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
        >
      </div>
      <div class="input-group">
        <label for="libro" class="label">libro</label>
        <input 
          accept=".mobi"
          class="input--text"
          name="libro"
          type="file"
        >
      </div>
      <p class="form__aclaracion">Sobre el autor</p>
      <div class="form__row">
        <div class="input-group">
          <label class="label" for="nombre">nombre</label>
          <input 
            class="input--text" 
            name="nombre" 
            placeholder="Nombre del autor"
            type="text"
          >
        </div>
        <div class="input-group">
          <label class="label" for="apellido">apellido</label>
          <input 
            class="input--text" 
            name="apellido" 
            placeholder="Apellido del autor"
            type="text"
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
