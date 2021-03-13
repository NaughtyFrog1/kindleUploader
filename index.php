<?php
  declare(strict_types = 1);
  require_once 'includes/app.php';

  $site_title = 'KindleUpdater';
  include_once 'includes/layout/header.php';
?>

<section class="listado section container container--lg">
  <div class="listado__header-table">
    <div class="listado__total">
      <div class="total__num-container">
        <p class="total__numero shadow-text">3</p>
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

<?php
  include_once 'includes/layout/footer.php';
?>