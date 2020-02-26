CREATE TABLE administradores(
  id NUMBER(5) NOT NULL,
  nombre VARCHAR2(40) NOT NULL,
  apellido VARCHAR2(40) NOT NULL,
  correo VARCHAR2(80),
  contrasena VARCHAR(15) NOT NULL
);

CREATE TABLE empresariales(
  id NUMBER(5) NOT NULL,
  nombre VARCHAR2(40) NOT NULL,
  apellido VARCHAR2(40) NOT NULL,
  correo VARCHAR2(80),
  contrasena VARCHAR(15) NOT NULL
);

CREATE TABLE auxiliares(
  id NUMBER(5) NOT NULL,
  nombre VARCHAR2(40) NOT NULL,
  apellido VARCHAR2(40) NOT NULL,
  correo VARCHAR2(80),
  contrasena VARCHAR(15) NOT NULL
);

CREATE TABLE empresas(
  id NUMBER(5) NOT NULL,
);

CREATE TABLE servicios(
  id NUMBER(5) NOT NULL,
);

CREATE TABLE facturas(
  id NUMBER(5) NOT NULL,
);

CREATE TABLE usuarios(
  id NUMBER(5) NOT NULL,
  nombre VARCHAR2(40) NOT NULL,
  apellido VARCHAR2(40) NOT NULL,
  correo VARCHAR2(80),
);
