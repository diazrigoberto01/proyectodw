
CREATE TABLE f_usuario (
  id           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  rfc          VARCHAR(255) NOT NULL,
  nombre       VARCHAR(255) NOT NULL,
  apellidos    VARCHAR(255) NOT NULL,
  email        VARCHAR(255) NOT NULL,
  pass         VARCHAR(255) NOT NULL,
  celular      VARCHAR(255) NOT NULL,
  tel_fijo     VARCHAR(255),
  tipo         VARCHAR(15),
  PRIMARY KEY (id)
);

CREATE TABLE f_cliente (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  rfc           VARCHAR(15) NOT NULL,
  razon_social  VARCHAR(150) NOT NULL,
  calle         VARCHAR(50) NOT NULL,
  cp            VARCHAR(5) NOT NULL,
  estado        VARCHAR(30) NOT NULL,
  municipio   VARCHAR(30) NOT NULL,
  no_exterior varchar(30) not null,
  email         VARCHAR(120) NOT NULL,
  telefono   VARCHAR(30) NOT NULL,
  usuario_rfc   VARCHAR(30) NOT NULL,
  PRIMARY KEY(id)
);


CREATE TABLE f_empresas (
  id                INT UNSIGNED NOT NULL AUTO_INCREMENT,
  rfc               VARCHAR(255) NOT NULL,
  razon_social      VARCHAR(255) NOT NULL,
  nombre_comercial  VARCHAR(255) NOT NULL,
  contacto          VARCHAR(255) NOT NULL,
  telefono          VARCHAR(255) NOT NULL,
  celular           VARCHAR(255) NOT NULL,
  email             VARCHAR(255) NOT NULL,
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
  cp                   NUMERIC(5) NOT NULL,
  colonia              VARCHAR(50) NOT NULL,
  calle                VARCHAR(30) NOT NULL,
  n_exterior           VARCHAR(50) NOT NULL,
  n_interior           VARCHAR(50),
  empresa_rfc          VARCHAR(255) NOT NULL,
  empresa_usuario_rfc  VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);


CREATE TABLE f_logo (
  id                   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  imagen               VARCHAR(255) NOT NULL,
  nombre               VARCHAR(255) NOT NULL,
  fecha                varchar(20) NOT NULL,
  empresa_rfc          VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);


CREATE TABLE f_factura (
  id                   INT UNSIGNED NOT NULL AUTO_INCREMENT,
  folio                 INT not null,
  rfc_emisor           VARCHAR(255) NOT NULL,
  direccion_emisor     VARCHAR(255) NOT NULL,
  lugar_expedicion     VARCHAR(255) NOT NULL,
  fecha_emision        varchar(255) NOT NULL,
  rfc_receptor         VARCHAR(255),
  metodo_pago          VARCHAR(255) NOT NULL,
  cantidad             INT NOT NULL,
  unidad_medida        VARCHAR(255) NOT NULL,
  descripcion          VARCHAR(255),
  isr                  FLOAT(2) NOT NULL,
  valor_unitario       FLOAT(2) NOT NULL,
  importe_total        FLOAT(3),
  empresa_usuario_rfc  VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);



CREATE TABLE f_concepto_facturado (
  factura_folio                VARCHAR(255) NOT NULL,
  factura_empresa_rfc          VARCHAR(255) NOT NULL,
  factura_empresa_usuario_rfc  VARCHAR(255) NOT NULL,
  concepto_clave               VARCHAR(255) NOT NULL,
  factura_cliente_rfc          VARCHAR(255) NOT NULL,
  fecha                        varchar(255) NOT NULL
);



CREATE TABLE f_concepto (
  id             INT  NOT NULL AUTO_INCREMENT,
  clave          VARCHAR(255) NOT NULL,
  descripcion    VARCHAR(255) NOT NULL,
  unidad_medida  VARCHAR(255) NOT NULL,
  precio         FLOAT(7,2) NOT NULL,
  PRIMARY KEY (id)
);
--insercion datos USuario
INSERT INTO f_usuario(rfc, nombre, apellidos, email, pass, celular, tel_fijo, tipo)
VALUES ('132asd', 'Testy', 'McTest', 'admin@test.com', 'test123', '222-1234567', '222-1234567', 'admin');
INSERT INTO f_usuario(rfc, nombre, apellidos, email, pass, celular, tel_fijo, tipo)
VALUES ('132asd', 'Testy Aux', 'McTest', 'aux@test.com', 'test123', '222-1234567', '222-1234567', 'auxiliar');

--INSERCION DE DATOS CLIENTES
insert into f_cliente(rfc,razon_social,calle,cp,estado,municipio,email,no_exterior,telefono,usuario_rfc)
values ('GBDP2012758FJ','Gobierno Estatal del Puebla','30 Oriente 3098','72160','Puebla','Puebla','gobpue@gmail.com','9','3456789876','132asd');
insert into f_cliente(rfc,razon_social,calle,cp,estado,municipio,email,telefono,usuario_rfc)
values ('cli456593gb5','Asfaltos de mexico SA de CV','benito juarez norte 53','95160','Pachuca','Hidalgo','asfmex@gmail.com','10','6667778889','132asd');
insert into f_cliente(rfc,razon_social,calle,cp,estado,municipio,email,telefono,usuario_rfc)
values ('HUA8956049FG','URBANIZADORA SAN JUAN','2 Oriente 507','72160','Puebla','Puebla','URBASJ@gmail.com','11','4569871234','132asd');

--INSERCION DE DATOS EMPRESA
INSERT INTO f_empresas(rfc,razon_social,nombre_comercial,contacto,telefono,celular,email,status,usuario_rfc,regimen_fiscal)
values ('RFCEMP2309SLF','Arturo Lopez','Construcciones Lopez','Arturo Lopez','123321123','2223331234','conslopez@gmail.com','1','132asd','RIF');
INSERT INTO f_empresas(rfc,razon_social,nombre_comercial,contacto,telefono,celular,email,status,usuario_rfc,regimen_fiscal)
values ('HFURB238948SH7','MARIANO RODRIGUEZ','ARRENDADORA DE MAQUINARIA','JUANITA MACIAS','8987654','222324325','ARRMAQ@gmail.com','1','132asd','RIF');
INSERT INTO f_empresas(rfc,razon_social,nombre_comercial,contacto,telefono,celular,email,status,usuario_rfc,regimen_fiscal)
values ('FER457HFU8DS','CONSTRUCTORA DEL BOSQUE SA DE CV','CONSTRUCTORA DEL BOSQUE SA DE CV','MARIA FERNANDA LOPEZ','987789654','22123675','consbosqQ@gmail.com','1','132asd','RIF');

--Insercion datos direccion de empresa
INSERT INTO f_direccion_empresa(calle,colonia,municipio,estado,pais,n_exterior,cp,empresa_rfc,empresa_usuario_rfc)
values ('30 poniente','centro','Puebla','Puebla','Mexico','309','72160','RFCEMP2309SLF','132asd');
INSERT INTO f_direccion_empresa(calle,colonia,municipio,estado,pais,n_exterior,cp,empresa_rfc,empresa_usuario_rfc)
values ('juarez norte','centro','Pachuca','hidalgo','Mexico','9','89029','HFURB238948SH7','132asd');
INSERT INTO f_direccion_empresa(calle,colonia,municipio,estado,pais,n_exterior,cp,empresa_rfc,empresa_usuario_rfc)
values ('2 poniente','centro','Puebla','Puebla','Mexico','1009','72160','FER457HFU8DS','132asd');

--Insercion de logos
insert into f_logo(imagen,nombre,fecha,empresa_rfc)
values ('logo1','Logo construccion lopez','2000/05/03','RFCEMP2309SLF');
insert into f_logo(imagen,nombre,fecha,empresa_rfc)
values ('logoabc','Logo arrendadora ','2012/09/03','HFURB238948SH7');
insert into f_logo(imagen,nombre,fecha,empresa_rfc)
values ('logo21','Logo del bosque','2019/10/04','FER457HFU8DS');

--Insercion de datos Facturas

insert into f_factura(folio, rfc_emisor,direccion_emisor,lugar_expedicion,fecha_emision,rfc_receptor,metodo_pago,cantidad,unidad_medida,descripcion,isr,
valor_unitario,importe_total,empresa_usuario_rfc)
values ('1','RFCEMP2309SLF','30 poniente 309 Puebla,Puebla','Puebla','2020/01/21','GBDP2012758FJ','tarjeta credito','10','m2','TRABAJO DE PINTURA EN MUROS INTERIORES Y PLAFONES','16','1200'
,'12000','132asd');
insert into f_factura(folio, rfc_emisor,direccion_emisor,lugar_expedicion,fecha_emision,rfc_receptor,metodo_pago,cantidad,unidad_medida,descripcion,isr,
valor_unitario,importe_total,empresa_usuario_rfc)
values ('2','HFURB238948SH7','juarez norte 9 Pachuca,Hidalgo','Hidalgo','2020/11/01','cli456593gb5','transferencia','10','m2','COLADO DE LOSA EN PRIMER NIVEL','16','2000'
,'20000','132asd');
insert into f_factura(folio, rfc_emisor,direccion_emisor,lugar_expedicion,fecha_emision,rfc_receptor,metodo_pago,cantidad,unidad_medida,descripcion,isr,
valor_unitario,importe_total,empresa_usuario_rfc)
values ('3','FER457HFU8DS','2 poniente 1009 Puebla,Puebla','Puebla','2020/01/21','HUA8956049FG','tarjeta credito','10','m2','RECUPERADO DE CARPETA ASFALTICA','16','3000'
,'30000','132asd');

--Insercion datos de conceptos facturados
insert into f_concepto_facturado(factura_folio,factura_empresa_rfc,factura_empresa_usuario_rfc,concepto_clave,factura_cliente_rfc,fecha)
values('1','RFCEMP2309SLF','132asd','TRAPIN','GBDP2012758FJ','2020/10/05');
insert into f_concepto_facturado(factura_folio,factura_empresa_rfc,factura_empresa_usuario_rfc,concepto_clave,factura_cliente_rfc,fecha)
values('2','HFURB238948SH7','132asd','COLALO','cli456593gb5','2020/11/01');
insert into f_concepto_facturado(factura_folio,factura_empresa_rfc,factura_empresa_usuario_rfc,concepto_clave,factura_cliente_rfc,fecha)
values('3','FER457HFU8DS','132asd','RECAAS','HUA8956049FG','2020/01/21');

--Insercion de datos CONCEPTOS
insert into f_concepto (clave,descripcion,unidad_medida,precio)
values ('TRAPIN','TRABAJO DE PINTURA EN MUROS INTERIORES Y PLAFONES','M2','1500');
insert into f_concepto (clave,descripcion,unidad_medida,precio)
values ('COLALO','COLADO DE LOSA EN PRIMER NIVEL','M2','2000');
insert into f_concepto (clave,descripcion,unidad_medida,precio)
values ('RECAAS','RECUPERADO DE CARPETA ASFALTICA','M2','3000');


