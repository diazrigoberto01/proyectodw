CREATE TABLE `f_usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfc` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `tel_fijo` varchar(255) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

CREATE TABLE `f_cliente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfc` varchar(15) NOT NULL,
  `razon_social` varchar(150) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `municipio` varchar(30) NOT NULL,
  `no_exterior` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `usuario_rfc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

CREATE TABLE `f_empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfc` varchar(255) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `nombre_comercial` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` char(1) DEFAULT NULL,
  `usuario_rfc` varchar(255) DEFAULT NULL,
  `regimen_fiscal` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

CREATE TABLE `f_direccion_empresa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pais` varchar(20) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `cp` decimal(5,0) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `calle` varchar(30) NOT NULL,
  `n_exterior` varchar(50) NOT NULL,
  `n_interior` varchar(50) DEFAULT NULL,
  `empresa_rfc` varchar(255) NOT NULL,
  `empresa_usuario_rfc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;


CREATE TABLE `f_logo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imagen` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `empresa_rfc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



CREATE TABLE `f_factura` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `folio` int(11) NOT NULL,
  `rfc_emisor` varchar(255) NOT NULL,
  `direccion_emisor` varchar(255) NOT NULL,
  `lugar_expedicion` varchar(255) NOT NULL,
  `fecha_emision` varchar(255) NOT NULL,
  `rfc_receptor` varchar(255) DEFAULT NULL,
  `metodo_pago` varchar(255) NOT NULL,
  `importe_total` float DEFAULT NULL,
  `empresa_usuario_rfc` varchar(255) NOT NULL,
  `iva` int(11) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `uso_cfdi` varchar(255) DEFAULT NULL,
  `cantidadPagos` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;



CREATE TABLE `f_concepto_facturado` (
  `factura_folio` varchar(255) NOT NULL,
  `factura_empresa_rfc` varchar(255) NOT NULL,
  `concepto_clave` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `concepto_descripcion` varchar(255) DEFAULT NULL,
  `concepto_um` varchar(30) DEFAULT NULL,
  `concepto_cantidad` float DEFAULT NULL,
  `concepto_pu` float DEFAULT NULL,
  `concepto_subtotal` float DEFAULT NULL,
  `concepto_iva` float DEFAULT NULL,
  `concepto_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `f_concepto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `unidad_medida` varchar(255) NOT NULL,
  `precio` float(7,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

CREATE TABLE `f_usoscfdi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(30) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
