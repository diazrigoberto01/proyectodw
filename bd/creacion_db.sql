CREATE TABLE f_cliente (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  rfc           VARCHAR(15) NOT NULL,
  razon_social  VARCHAR(150) NOT NULL,
  calle         VARCHAR(50) NOT NULL,
  cp            VARCHAR(5) NOT NULL,
  estado        VARCHAR(30) NOT NULL,
  email         VARCHAR(120) NOT NULL,
  usuario_rfc   VARCHAR(30) NOT NULL,
  PRIMARY KEY(id)
  FOREIGN KEY(usuario_rfc) REFERENCES f_usuario(rfc)
);

CREATE TABLE f_concepto (
  id             INT UNSIGNED NOT NULL AUTO_INCREMENT,
  clave          VARCHAR(255) NOT NULL,
  descripcion    VARCHAR(255) NOT NULL,
  unidad_medida  VARCHAR(255) NOT NULL,
  precio         INT NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE f_concepto_facturado (
  factura_folio                VARCHAR(255) NOT NULL,
  factura_empresa_rfc          VARCHAR(255) NOT NULL,
  factura_empresa_usuario_rfc  VARCHAR(255) NOT NULL,
  concepto_clave               VARCHAR(255) NOT NULL,
  factura_cliente_rfc          VARCHAR(255) NOT NULL,
  factura_cliente_usuario_rfc  VARCHAR(255) NOT NULL,
  fecha                        DATE NOT NULL
  CONSTRAINT pk_concepto_facturado PRIMARY KEY (factura_folio, factura_empresa_rfc)
);

CREATE TABLE f_empresa (
  id                INT UNSIGNED NOT NULL AUTO_INCREMENT,
  rfc               VARCHAR(255) NOT NULL,
  razon_social      VARCHAR(255) NOT NULL,
  nombre_comercial  VARCHAR(255) NOT NULL,
  contacto          VARCHAR(255) NOT NULL,
  telefono          VARCHAR(255) NOT NULL,
  celular           VARCHAR(255) NOT NULL,
  email             VARCHAR(255) NOT NULL,
  pais              VARCHAR(255) NOT NULL,
  estado            VARCHAR(255) NOT NULL,
  municipio         VARCHAR(255) NOT NULL,
  localidad         VARCHAR(255),
  cp                VARCHAR(255) NOT NULL,
  colonia           VARCHAR(255) NOT NULL,
  calle             VARCHAR(255) NOT NULL,
  n_exterior        INT NOT NULL,
  status            CHAR(1) NOT NULL,
  usuario_rfc       VARCHAR(255) NOT NULL,
  regimen_fiscal    VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE f_direccion_empresa (
  id                   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  pais                 VARCHAR(20) NOT NULL,
  estado               VARCHAR(30) NOT NULL,
  municipio            VARCHAR(50) NOT NULL,
  localidad            VARCHAR(50),
  cp                   NUMBER(5) NOT NULL,
  colonia              VARCHAR(50) NOT NULL,
  calle                VARCHAR(30) NOT NULL,
  n_exterior           VARCHAR(50) NOT NULL,
  n_interior           VARCHAR(50),
  empresa_rfc          VARCHAR(255) NOT NULL,
  empresa_usuario_rfc  VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
  FOREIGN KEY(empresa_rfc) REFERENCES f_empresa(rfc)
);

CREATE TABLE f_logo (
  id                   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  imagen               VARCHAR(255) NOT NULL,
  nombre               VARCHAR(255) NOT NULL,
  fecha                DATE NOT NULL,
  empresa_rfc          VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
  FOREIGN KEY(empresa_rfc) REFERENCES f_empresa(rfc)
);

CREATE TABLE f_factura (
  id                   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  folio                VARCHAR(255) NOT NULL,
  rfc_emisor           VARCHAR(255) NOT NULL,
  direccion_emisor     VARCHAR(255) NOT NULL,
  lugar_expedicion     VARCHAR(255) NOT NULL,
  fecha_emision        DATE NOT NULL,
  rfc_receptor         VARCHAR(255),
  metodo_pago          VARCHAR(255) NOT NULL,
  cantidad             INT NOT NULL,
  unidad_medida        VARCHAR(255) NOT NULL,
  descripcion          VARCHAR(255),
  isr                  FLOAT(2) NOT NULL,
  valor_unitario       FLOAT(2) NOT NULL,
  importe_total        FLOAT(3),
  empresa_rfc          VARCHAR(255) NOT NULL,
  empresa_usuario_rfc  VARCHAR(255) NOT NULL,
  cliente_rfc          VARCHAR(255) NOT NULL,
  cliente_usuario_rfc  VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY(empresa_rfc) REFERENCES f_empresa(rfc),
  FOREIGN KEY(cliente_rfc) REFERENCES f_cliente(rfc)
);

CREATE TABLE f_usuario (
  id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  rfc          VARCHAR(255) NOT NULL,
  nombre       VARCHAR(255) NOT NULL,
  apellidos    VARCHAR(255) NOT NULL,
  email        VARCHAR(255) NOT NULL,
  password     VARCHAR(255) NOT NULL,
  celular      VARCHAR(255) NOT NULL,
  tel_fijo     VARCHAR(255),
  tipo         VARCHAR(15) NOT NULL,
  usuario_rfc  VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);
