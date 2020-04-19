function regresarAnterior() {
  window.history.go(-1);
}

function irIndex() {
  window.history.go('index.php');
}

function irA(pagina) {
  console.log(pagina);
  location.href = pagina;
}
