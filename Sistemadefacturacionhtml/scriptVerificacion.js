var regexLetras = /^[a-zA-Z]+/;
var regexPalabras = /^[a-zA-Z]+ [a-zA-Z]+/;

verificarNombre() {
  // Retorna 1 para error y 0 para éxito
  var nombre = document.getElementById('nombre').value;
  if (regexLetras.test(nombre)) {
    alert('El nombre tiene un formato inválido.');
    return 1;
  } else if (nombre.length < 2) {
    alert('El nombre es muy corto.');
    return 1;
  }
}

verificarApellido() {
  // Retorna 1 para error y 0 para éxito
  var apellido = document.getElementById('apellido').value;
  if (regexLetras.test(apellido)) {
    alert('El apellido tiene un formato inválido.');
    return 1;
  } else if (nombre.length < 2) {
    alert('El apellido es muy corto.');
    return 1;
  }
}

verificarNombreCompleto() {
  var nombre = document.getElementById('nombre').value;
  if (regexLetras.test(nombre)) {
    alert('El nombre tiene un formato inválido.');
    return 1;
  } else if (nombre.length < 2) {
    alert('El nombre es muy corto.');
    return 1;
  }
}
