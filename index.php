<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';

  $site_title = 'KindleUpdater';
  include_once 'includes/layout/header.php';
?>

<div class="container container container--lg">
  <main class="añadir section">
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

  <section class="listado section">
    <h2>Libros</h2>

    <div class="input-group">
      <input
        class="input--text listado__buscar"
        type="text"
        placeholder="Buscar Libros..."
      >
    </div>

    <div class="listado__total">
      <div class="total__num-container">
        <p class="total__numero shadow-text">3</p>
      </div>
      <p class="total__text">Libros</p>
    </div>

    <div class="table-container">
      <table class="listado__table">
        <thead>
          <th class="shadow-text">Nombre</th>
          <th class="shadow-text">Autor</th>
          <th class="shadow-text">Acciones</th>
        </thead>
        <tbody>
          <tr>
            <td>Metro 2033</td>
            <td>El ruso ese</td>
            <td class="table__acciones">
              <div class="acciones__container">
                <a 
                  class="table__accion"
                  href="#" 
                >
                  <img 
                    src="src/assets/images/icons/pen.svg" 
                    alt="Actualizar"
                  >
                </a>
                <form class="table__accion" method="post">
                  <input
                    name="id"
                    type="hidden"
                    value="#"
                  >
                  <input type="submit" value=''>
                </form>
              </div>
            </td>
          </tr>
          <tr>
            <td>Metro 2033</td>
            <td>El ruso ese</td>
            <td class="table__acciones">
              <div class="acciones__container">
                <a 
                  class="table__accion"
                  href="#" 
                >
                  <img 
                    src="src/assets/images/icons/pen.svg" 
                    alt="Actualizar"
                  >
                </a>
                <form class="table__accion" method="post">
                  <input
                    name="id"
                    type="hidden"
                    value="#"
                  >
                  <input type="submit" value=''>
                </form>
              </div>
            </td>
          </tr>
          <tr>
            <td>Metro 2033</td>
            <td>El ruso ese</td>
            <td class="table__acciones">
              <div class="acciones__container">
                <a 
                  class="table__accion"
                  href="#" 
                >
                  <img 
                    src="src/assets/images/icons/pen.svg" 
                    alt="Actualizar"
                  >
                </a>
                <form class="table__accion" method="post">
                  <input
                    name="id"
                    type="hidden"
                    value="#"
                  >
                  <input type="submit" value=''>
                </form>
              </div>
            </td>
          </tr>
          <tr>
            <td>Metro 2033</td>
            <td>El ruso ese</td>
            <td class="table__acciones">
              <div class="acciones__container">
                <a 
                  class="table__accion"
                  href="#" 
                >
                  <img 
                    src="src/assets/images/icons/pen.svg" 
                    alt="Actualizar"
                  >
                </a>
                <form class="table__accion" method="post">
                  <input
                    name="id"
                    type="hidden"
                    value="#"
                  >
                  <input type="submit" value=''>
                </form>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</div>

<?php
  include_once 'includes/layout/footer.php';
?>