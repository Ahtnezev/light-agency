console.log('>.<\'');

/*
* GREETING FROM CONSOLE
*/
function Hidev() {
  if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
    var args = ['\n %c Made with ♥ by Light Agency %c %c %c https://www.google.com/ %c %c \n', 'color: #fff; background: #242B9B; padding:5px 0;', 'background: #292929; padding:5px 0;', 'background: #292929; padding:5px 0;', 'color: #fff; background: #292929; padding:5px 0;', 'background: #292929; padding:5px 0;', 'color: #fff; background: #292929; padding:5px 0;'];
    window.console.log.apply(console, args);
  } else if (window.console) {
    window.console.log('Made with love ♥ Light Agency - https://www.google.com/');
  }
}
Hidev();

$(document).ready(function () {
  console.log('jquery it works');
  $('#btn-sales').click(function () {
    showToast('Test', 'info', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, doloremque!');
  });
  $('#button-add-product-cart').click(function () {
    displayMessageProductAdded();
  });
  $('#button-delete-cart-product').click(function () {
    displayMessageProductDeleted();
  });
  $('#button-process-payment').click(function () {
    let timerInterval;
    Swal.fire({
      title: "Procesando pago...",
      html: "Por favor, espere <b></b>.",
      timer: 1700,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading();
        const timer = Swal.getPopup().querySelector("b");
        timerInterval = setInterval(() => {
          timer.textContent = `${Swal.getTimerLeft()}`;
        }, 100);
      },
      willClose: () => {
        clearInterval(timerInterval);
      }
    }).then((result) => {
      if (result.dismiss === Swal.DismissReason.timer) {
        showToast('Pago realizado', 'success', '');
      }
    });
  });
});

// 
function displayMessageProductDeleted() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });
  Toast.fire({
    icon: "success",
    title: "Producto eliminado!"
  });
}

// 
function displayMessageProductAdded() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });
  Toast.fire({
    icon: "success",
    title: "Agregado al carrito!"
  });
}

// display a basic sweetalert
function showToast(title, icon, text) {
  Swal.fire({
    title: title,
    text: text,
    icon: icon,
    confirmButtonText: 'Cerrar',
    allowOutsideClick: false
  });
}