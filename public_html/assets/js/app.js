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
    showToast('Test', 'info');
  });
  $('#button-add-product-cart').click(function () {
    displayMessageProductAdded();
  });
});

// 
function displayMessageProductAdded() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
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
function showToast(text, icon) {
  Swal.fire({
    title: text,
    text: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, doloremque!',
    icon: icon,
    confirmButtonText: 'Cerrar',
    allowOutsideClick: false
  });
}