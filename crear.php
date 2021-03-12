<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';

  $site_title = 'KindleUpdater - Crear';
  include_once 'includes/layout/header.php';
?>

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
        <input 
          class="btn btn--primary btn--sm m0 input--submit"
          type="submit"
          value="Añadir" 
        >
      </div>
    </form>
  </main>

<?php include_once 'includes/layout/footer.php' ?>
