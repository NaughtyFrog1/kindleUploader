!(function () {
    `use strict`;
    
    let alertas = document.querySelectorAll('.alerts--fixed')

    setTimeout(() => {
      alertas.forEach(alerta => {
        alerta.remove();
      });
    }, 2500);
}());