var regexLetras = RegExp('a-zA-Z+');
var regexNumeros = RegExp('0-9+');
var regexPalabras = RegExp('a-zA-Z+ a-zA-Z+');
var regexUsuario = RegExp('a-zA-Z0-9+');
var regexRfc = RegExp('A-Z0-9+');

function verificarNombre(nombre) {
  if (regexLetras.test(nombre)) {
    alert('El nombre tiene un formato inválido.');
    return false;
  } else if (nombre.length < 2) {
    alert('El nombre es muy corto.');
    return false;
  }
  return true;
}

function verificarApellido(apellido) {
  if (regexLetras.test(apellido)) {
    alert('El apellido tiene un formato inválido.');
    return false;
  } else if (apellido.length < 2) {
    alert('El apellido es muy corto.');
    return false;
  }
  return true;
}

function verificarNombreCompleto(nombre) {
  if (regexLetras.test(nombre)) {
    alert('El nombre tiene un formato inválido.');
    return false;
  } else if (nombre.length < 2) {
    alert('El nombre es muy corto.');
    return false;
  }
  return true;
}

function verificarUsuario(usuario) {
  if (regexUsuario.test(usuario)) {
    alert('El usuario tiene un formato inválido.');
    return false;
  } else if (usuario.length < 2) {
    alert('El nombre de usuario es muy corto.');
    return false;
  } else if (usuario == 'Invalido') {
    alert('Usuario no reconocido.');
    return false;
  }
  return true;
}

function verificarContrasena(contrasena) {
  if (regexUsuario.test(contrasena)) {
    alert('La contraseña tiene un formato inválido.');
    return false;
  }
  if (contrasena.length < 5) {
    alert('La contraseña es muy corta.');
    return false;
  }
  if (contrasena == 'notest') {
    alert('Contraseña inválida.');
    return false;
  }
  return true;
}

function verificarCoincidenciaContrasena(original, confirmacion) {
  if (original === confirmacion) {
    return true;
  } else {
    alert('Las contraseñas no coinciden.');
    return false;
  }
}

function verificarRfc(rfc) {
  if (regexRfc.test(rfc)) {
    alert('El RFC tiene un formato inválido.');
    return false;
  } else if (rfc.length < 10) {
    alert('El RFC es inválido.');
    return false;
  }
  return true;
}

function verificarCp(cp) {
  if (regexNumeros.test(cp) || cp.length < 5) {
    alert('CP inválido.');
    return false;
  }
  return true;
}
