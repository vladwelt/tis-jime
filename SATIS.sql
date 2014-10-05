CREATE TABLE registros (
  codhito integer NOT NULL,
  codentregable integer NOT NULL,
  entregable character varying(120),
  CONSTRAINT registros_pkey PRIMARY KEY (codhito, codentregable)
);

CREATE TABLE foro (
  codforo serial NOT NULL,
  autor character varying(60),
  titulo character varying(120),
  mensaje text,
  cantidad_comentarios integer,
  CONSTRAINT foro_pkey PRIMARY KEY (codforo)
);

CREATE TABLE DocumentosPublicos (
  codpublico SERIAL NOT NULL,
  titulodocumento VARCHAR(45) NULL,
  descdocpublico VARCHAR(45) NULL,
  nombredocupublico  VARCHAR(300) NULL,
  rutadocpublico  VARCHAR(300) NULL,
  PRIMARY KEY(codpublico)
);
CREATE TABLE Usuario (
  idUsuario SERIAL NOT NULL,
  login VARCHAR(45) UNIQUE,
  passwd VARCHAR(45) NULL,
  habilitada BOOL NOT NULL,
  PRIMARY KEY(idUsuario)
);

CREATE TABLE Funcion (
  codFuncion SERIAL NOT NULL,
  tipoFuncion VARCHAR(45) NULL,
  PRIMARY KEY(codFuncion)
);

CREATE TABLE Rol (
  codRol SERIAL NOT NULL,
  tipoRol VARCHAR(45) NULL,
  PRIMARY KEY(codRol)
);

CREATE TABLE Tipo_Socio (
  codTipo_Socio SERIAL NOT NULL,
  nombreTipo VARCHAR(45) NULL,
  PRIMARY KEY(codTipo_Socio)
);

CREATE TABLE App (
  codApp SERIAL NOT NULL,
  nombreApp VARCHAR(45) NULL,
  PRIMARY KEY(codApp)
);

CREATE TABLE Proyecto (
  codProyecto VARCHAR(25) NOT NULL,
  nombreProyecto VARCHAR(60) NULL,
  fechaFinProyecto DATE NULL,
  vigente BOOL NULL,
  PRIMARY KEY(codProyecto)
);


CREATE TABLE Grupo_Empresa (
  CodGrupo_Empresa SERIAL NOT NULL,
  Usuario_idUsuario INTEGER NOT NULL,
  nombrelargoGE VARCHAR(45) UNIQUE,
  nombreCortoGE VARCHAR(45) NOT NULL,
  correoGE VARCHAR(45) NOT NULL,
  direccionGE VARCHAR(45) NOT NULL,
  telefonoGE INTEGER NOT NULL,
  PRIMARY KEY(CodGrupo_Empresa, Usuario_idUsuario),
  FOREIGN KEY(Usuario_idUsuario)
    REFERENCES Usuario(idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE propuestapago (
  codpropuestapago serial NOT NULL,
  grupo_empresa_usuario_idusuario integer NOT NULL,
  grupo_empresa_codgrupo_empresa integer NOT NULL,
  montototal real,
  porcentajesatisfaccion integer,
  estado boolean,
  estadoregistro boolean,
  CONSTRAINT propuestapago_pkey PRIMARY KEY (codpropuestapago, grupo_empresa_usuario_idusuario, grupo_empresa_codgrupo_empresa),
  CONSTRAINT propuestapago_grupo_empresa_codgrupo_empresa_fkey FOREIGN KEY (grupo_empresa_codgrupo_empresa, grupo_empresa_usuario_idusuario)
      REFERENCES grupo_empresa (codgrupo_empresa, usuario_idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE plandepagos (
  codplandepagos serial NOT NULL,
  propuestapago_grupo_empresa_codgrupo_empresa integer NOT NULL,
  propuestapago_grupo_empresa_usuario_idusuario integer NOT NULL,
  propuestapago_codpropuestapago integer NOT NULL,
  hitoevento character varying(60),
  porcentajepago integer,
  montopago real,
  fechapago date,
  CONSTRAINT plandepagos_pkey PRIMARY KEY (codplandepagos, propuestapago_grupo_empresa_codgrupo_empresa, propuestapago_grupo_empresa_usuario_idusuario, propuestapago_codpropuestapago),
  CONSTRAINT plandepagos_propuestapago_grupo_empresa_usuario_idusuario_fkey FOREIGN KEY (propuestapago_grupo_empresa_usuario_idusuario, propuestapago_grupo_empresa_codgrupo_empresa, propuestapago_codpropuestapago)
      REFERENCES propuestapago (grupo_empresa_usuario_idusuario, grupo_empresa_codgrupo_empresa, codpropuestapago) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE planpago_entregables (
  codplanpago_entregables serial NOT NULL,
  plandepagos_propuestapago_codpropuestapago integer NOT NULL,
  plandepagos_propuestapago_grupo_empresa_usuario_idusuario integer NOT NULL,
  plandepagos_propuestapago_grupo_empresa_codgrupo_empresa integer NOT NULL,
  plandepagos_codplandepagos integer NOT NULL,
  entregable character varying(120),
  CONSTRAINT planpago_entregables_pkey PRIMARY KEY (codplanpago_entregables, plandepagos_propuestapago_codpropuestapago, plandepagos_propuestapago_grupo_empresa_usuario_idusuario, plandepagos_propuestapago_grupo_empresa_codgrupo_empresa, plandepagos_codplandepagos),
  CONSTRAINT planpago_entregables_plandepagos_propuestapago_grupo_empre_fkey FOREIGN KEY (plandepagos_propuestapago_grupo_empresa_codgrupo_empresa, plandepagos_propuestapago_grupo_empresa_usuario_idusuario, plandepagos_propuestapago_codpropuestapago, plandepagos_codplandepagos)
      REFERENCES plandepagos (propuestapago_grupo_empresa_codgrupo_empresa, propuestapago_grupo_empresa_usuario_idusuario, propuestapago_codpropuestapago, codplandepagos) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);


CREATE TABLE Telf_GE (
  idTelf_GE SERIAL NOT NULL,
  Grupo_Empresa_CodGrupo_Empresa INTEGER NOT NULL,
  Grupo_Empresa_Usuario_idUsuario INTEGER NOT NULL,
  numeroTelf INTEGER NULL,
  PRIMARY KEY(idTelf_GE, Grupo_Empresa_CodGrupo_Empresa, Grupo_Empresa_Usuario_idUsuario),
  FOREIGN KEY(Grupo_Empresa_CodGrupo_Empresa, Grupo_Empresa_Usuario_idUsuario)
    REFERENCES Grupo_Empresa(CodGrupo_Empresa, Usuario_idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE consultor
(
  idconsultor SERIAL NOT NULL,
  usuario_idusuario integer NOT NULL,
  nombreconsultor character varying(45),
  correoconsultor character varying(45),
  telefonoconsultor INTEGER NOT NULL,
  CONSTRAINT consultor_pkey PRIMARY KEY (idconsultor, usuario_idusuario),
  CONSTRAINT consultor_usuario_idusuario_fkey FOREIGN KEY (usuario_idusuario)
      REFERENCES usuario (idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT consultor_idconsultor_key UNIQUE (idconsultor)
);

CREATE TABLE calendario
(
  codcalendario SERIAL NOT NULL,
  grupo_empresa_codgrupo_empresa integer NOT NULL,
  grupo_empresa_usuario_idusuario integer NOT NULL,
  dia_reunion_fijado boolean DEFAULT false,
  CONSTRAINT calendario_pkey PRIMARY KEY (codcalendario, grupo_empresa_codgrupo_empresa, grupo_empresa_usuario_idusuario),
  CONSTRAINT calendario_grupo_empresa_codgrupo_empresa_fkey FOREIGN KEY (grupo_empresa_codgrupo_empresa, grupo_empresa_usuario_idusuario)
      REFERENCES grupo_empresa (codgrupo_empresa, usuario_idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE plan_pago (
  codplan_pago integer NOT NULL,
  calendario_codcalendario integer NOT NULL,
  calendario_grupo_empresa_codgrupo_empresa integer NOT NULL,
  calendario_grupo_empresa_usuario_idusuario integer NOT NULL,
  montototal real,
  porcentajesatisfaccion real,
  CONSTRAINT plan_pago_pkey PRIMARY KEY (codplan_pago, calendario_codcalendario, calendario_grupo_empresa_codgrupo_empresa, calendario_grupo_empresa_usuario_idusuario),
  CONSTRAINT plan_pago_calendario_codcalendario_fkey FOREIGN KEY (calendario_codcalendario, calendario_grupo_empresa_codgrupo_empresa, calendario_grupo_empresa_usuario_idusuario)
      REFERENCES calendario (codcalendario, grupo_empresa_codgrupo_empresa, grupo_empresa_usuario_idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);


CREATE TABLE Socio (
  idSocio SERIAL NOT NULL,
  Grupo_Empresa_CodGrupo_Empresa INTEGER NOT NULL,
  Tipo_Socio_codTipo_Socio INTEGER NOT NULL,
  Grupo_Empresa_Usuario_idUsuario INTEGER NOT NULL,
  Usuario_idUsuario INTEGER NOT NULL,
  nombreSocio VARCHAR(45) NULL,
  apellidosSocio VARCHAR(45) NULL,
  estadoCivil VARCHAR(25) NULL,
  direccion VARCHAR(45) NULL,
  profesion VARCHAR(45) NULL,
  PRIMARY KEY(idSocio, Grupo_Empresa_CodGrupo_Empresa, Tipo_Socio_codTipo_Socio, Grupo_Empresa_Usuario_idUsuario),
  FOREIGN KEY(Grupo_Empresa_CodGrupo_Empresa, Grupo_Empresa_Usuario_idUsuario)
    REFERENCES Grupo_Empresa(CodGrupo_Empresa, Usuario_idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Tipo_Socio_codTipo_Socio)
    REFERENCES Tipo_Socio(codTipo_Socio)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Usuario_idUsuario)
    REFERENCES Usuario(idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE User_Rol (
  codUser_Rol SERIAL NOT NULL,
  Usuario_idUsuario INTEGER NOT NULL,
  Rol_codRol INTEGER NOT NULL,
  PRIMARY KEY(codUser_Rol, Usuario_idUsuario, Rol_codRol),
  FOREIGN KEY(Usuario_idUsuario)
    REFERENCES Usuario(idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Rol_codRol)
    REFERENCES Rol(codRol)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE evaluacion_semanal
(
  codevaluacion_semanal serial NOT NULL,
  calendario_codcalendario integer NOT NULL,
  calendario_grupo_empresa_codgrupo_empresa integer NOT NULL,
  calendario_grupo_empresa_usuario_idusuario integer NOT NULL,
  fecha date,
  CONSTRAINT evaluacion_semanal_pkey PRIMARY KEY (codevaluacion_semanal, calendario_codcalendario, calendario_grupo_empresa_codgrupo_empresa, calendario_grupo_empresa_usuario_idusuario),
  CONSTRAINT evaluacion_semanal_calendario_codcalendario_fkey FOREIGN KEY (calendario_codcalendario, calendario_grupo_empresa_codgrupo_empresa, calendario_grupo_empresa_usuario_idusuario)
      REFERENCES calendario (codcalendario, grupo_empresa_codgrupo_empresa, grupo_empresa_usuario_idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);



CREATE TABLE Tipo_Criterio (
  id_tipo serial NOT NULL,
  tipo VARCHAR(17) NULL,
  PRIMARY KEY(id_tipo)
);

CREATE TABLE Registro_Evaluacion_Final (
  idRegistro_Evaluacion_Final SERIAL NOT NULL,
  Consultor_Usuario_idUsuario INTEGER NOT NULL,
  Consultor_idConsultor INTEGER NOT NULL,
  Proyecto_codProyecto VARCHAR(25) NOT NULL,
  PRIMARY KEY(idRegistro_Evaluacion_Final, Consultor_Usuario_idUsuario, Consultor_idConsultor, Proyecto_codProyecto),
  FOREIGN KEY(Consultor_idConsultor, Consultor_Usuario_idUsuario)
    REFERENCES Consultor(idConsultor, Usuario_idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Proyecto_codProyecto)
    REFERENCES Proyecto(codProyecto)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Criterio (
  id_criterio SERIAL NOT NULL,
  Tipo_Criterio_id_tipo INTEGER NOT NULL,
  Registro_Evaluacion_Final_Proyecto_codProyecto VARCHAR(25) NOT NULL,
  Registro_Evaluacion_Final_Consultor_idConsultor INTEGER NOT NULL,
  Registro_Evaluacion_Final_Consultor_Usuario_idUsuario INTEGER NOT NULL,
  Registro_Evaluacion_Final_idRegistro_Evaluacion_Final INTEGER NOT NULL,
  nombre VARCHAR(100) NULL,
  porcentaje_calificacion integer,
  PRIMARY KEY(id_criterio, Tipo_Criterio_id_tipo, Registro_Evaluacion_Final_Proyecto_codProyecto, Registro_Evaluacion_Final_Consultor_idConsultor, Registro_Evaluacion_Final_Consultor_Usuario_idUsuario, Registro_Evaluacion_Final_idRegistro_Evaluacion_Final),
  FOREIGN KEY(Tipo_Criterio_id_tipo)
    REFERENCES Tipo_Criterio(id_tipo)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Registro_Evaluacion_Final_idRegistro_Evaluacion_Final, Registro_Evaluacion_Final_Consultor_Usuario_idUsuario, Registro_Evaluacion_Final_Consultor_idConsultor, Registro_Evaluacion_Final_Proyecto_codProyecto)
    REFERENCES Registro_Evaluacion_Final(idRegistro_Evaluacion_Final, Consultor_Usuario_idUsuario, Consultor_idConsultor, Proyecto_codProyecto)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);


CREATE TABLE Detalle_Criterio (
  idDetalle_Criterio SERIAL NOT NULL,
  Criterio_Registro_Evaluacion_Final_idRegistro_Evaluacion_Final INTEGER NOT NULL,
  Criterio_Registro_Evaluacion_Final_Consultor_Usuario_idUsuario INTEGER NOT NULL,
  Criterio_Registro_Evaluacion_Final_Consultor_idConsultor INTEGER NOT NULL,
  Criterio_Registro_Evaluacion_Final_Proyecto_codProyecto VARCHAR(25) NOT NULL,
  Criterio_Tipo_Criterio_id_tipo INTEGER NOT NULL,
  Criterio_id_criterio INTEGER NOT NULL,
  porcentaje INTEGER NULL,
 nombre_concepto character varying(30),
  PRIMARY KEY(idDetalle_Criterio, Criterio_Registro_Evaluacion_Final_idRegistro_Evaluacion_Final, Criterio_Registro_Evaluacion_Final_Consultor_Usuario_idUsuario, Criterio_Registro_Evaluacion_Final_Consultor_idConsultor, Criterio_Registro_Evaluacion_Final_Proyecto_codProyecto, Criterio_Tipo_Criterio_id_tipo, Criterio_id_criterio),
  FOREIGN KEY(Criterio_id_criterio, Criterio_Tipo_Criterio_id_tipo, Criterio_Registro_Evaluacion_Final_Proyecto_codProyecto, Criterio_Registro_Evaluacion_Final_Consultor_idConsultor, Criterio_Registro_Evaluacion_Final_Consultor_Usuario_idUsuario, Criterio_Registro_Evaluacion_Final_idRegistro_Evaluacion_Final)
    REFERENCES Criterio(id_criterio, Tipo_Criterio_id_tipo, Registro_Evaluacion_Final_Proyecto_codProyecto, Registro_Evaluacion_Final_Consultor_idConsultor, Registro_Evaluacion_Final_Consultor_Usuario_idUsuario, Registro_Evaluacion_Final_idRegistro_Evaluacion_Final)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Evaluacion_final (
  codEvaluacion_final SERIAL NOT NULL,
  Grupo_Empresa_Usuario_idUsuario INTEGER NOT NULL,
  Grupo_Empresa_CodGrupo_Empresa INTEGER NOT NULL,
  Detalle_Criterio_Criterio_id_criterio INTEGER NOT NULL,
  Detalle_Criterio_Criterio_Tipo_Criterio_id_tipo INTEGER NOT NULL,
  Detalle_Criterio_Criterio_Registro_Evaluacion_Final_Proyecto_codProyecto VARCHAR(25) NOT NULL,
  Detalle_Criterio_Criterio_Registro_Evaluacion_Final_Consultor_idConsultor INTEGER NOT NULL,
  Detalle_Criterio_Criterio_Registro_Evaluacion_Final_Consultor_Usuario_idUsuario INTEGER NOT NULL,
  Detalle_Criterio_Criterio_Registro_Evaluacion_Final_idRegistro_Evaluacion_Final INTEGER NOT NULL,
  Detalle_Criterio_idDetalle_Criterio INTEGER NOT NULL,
  fecha DATE NULL,
  nota INTEGER NULL,
  observaciones TEXT NULL,
  PRIMARY KEY(codEvaluacion_final, Grupo_Empresa_Usuario_idUsuario, Grupo_Empresa_CodGrupo_Empresa, Detalle_Criterio_Criterio_id_criterio, Detalle_Criterio_Criterio_Tipo_Criterio_id_tipo, Detalle_Criterio_Criterio_Registro_Evaluacion_Final_Proyecto_codProyecto, Detalle_Criterio_Criterio_Registro_Evaluacion_Final_Consultor_idConsultor, Detalle_Criterio_Criterio_Registro_Evaluacion_Final_Consultor_Usuario_idUsuario, Detalle_Criterio_Criterio_Registro_Evaluacion_Final_idRegistro_Evaluacion_Final, Detalle_Criterio_idDetalle_Criterio),
  FOREIGN KEY(Grupo_Empresa_CodGrupo_Empresa, Grupo_Empresa_Usuario_idUsuario)
    REFERENCES Grupo_Empresa(CodGrupo_Empresa, Usuario_idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Detalle_Criterio_idDetalle_Criterio, Detalle_Criterio_Criterio_Registro_Evaluacion_Final_idRegistro_Evaluacion_Final, Detalle_Criterio_Criterio_Registro_Evaluacion_Final_Consultor_Usuario_idUsuario, Detalle_Criterio_Criterio_Registro_Evaluacion_Final_Consultor_idConsultor, Detalle_Criterio_Criterio_Registro_Evaluacion_Final_Proyecto_codProyecto, Detalle_Criterio_Criterio_Tipo_Criterio_id_tipo, Detalle_Criterio_Criterio_id_criterio)
    REFERENCES Detalle_Criterio(idDetalle_Criterio, Criterio_Registro_Evaluacion_Final_idRegistro_Evaluacion_Final, Criterio_Registro_Evaluacion_Final_Consultor_Usuario_idUsuario, Criterio_Registro_Evaluacion_Final_Consultor_idConsultor, Criterio_Registro_Evaluacion_Final_Proyecto_codProyecto, Criterio_Tipo_Criterio_id_tipo, Criterio_id_criterio)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);



CREATE TABLE Funcion_App (
  codFuncion_App SERIAL NOT NULL,
  App_codApp INTEGER NOT NULL,
  Funcion_codFuncion INTEGER NOT NULL,
  PRIMARY KEY(codFuncion_App, App_codApp, Funcion_codFuncion),
  FOREIGN KEY(App_codApp)
    REFERENCES App(codApp)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Funcion_codFuncion)
    REFERENCES Funcion(codFuncion)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Rol_Funcion (
  codRol_Funcion SERIAL NOT NULL,
  Rol_codRol INTEGER NOT NULL,
  Funcion_codFuncion INTEGER NOT NULL,
  PRIMARY KEY(codRol_Funcion, Rol_codRol, Funcion_codFuncion),
  FOREIGN KEY(Rol_codRol)
    REFERENCES Rol(codRol)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Funcion_codFuncion)
    REFERENCES Funcion(codFuncion)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE cons_actividad
(
  codcons_actividad serial NOT NULL,
  consultor_usuario_idusuario integer NOT NULL,
  consultor_idconsultor integer NOT NULL,
  visiblepara character varying(30),
  requiererespuesta character varying(15),
  fechainicio date,
  fechafin date,
  horainicio time without time zone,
  horafin time without time zone,
  titulo character varying(30),
  descripcion text,
  contestada boolean,
  ruta text,
  archivo character varying(120),
  CONSTRAINT cons_actividad_pkey PRIMARY KEY (codcons_actividad, consultor_usuario_idusuario, consultor_idconsultor),
  CONSTRAINT cons_actividad_consultor_idconsultor_fkey FOREIGN KEY (consultor_idconsultor, consultor_usuario_idusuario)
      REFERENCES consultor (idconsultor, usuario_idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE GE_Documento (
  idGE_Documento SERIAL NOT NULL,
  Grupo_Empresa_CodGrupo_Empresa INTEGER NOT NULL,
  Grupo_Empresa_Usuario_idUsuario INTEGER NOT NULL,
  nombreDocumento VARCHAR(45) NULL,
  pathDocumentoGE TEXT NULL,
  titulo_gedocumento VARCHAR(45),
  descripciongedocumento text,
  PRIMARY KEY(idGE_Documento, Grupo_Empresa_CodGrupo_Empresa, Grupo_Empresa_Usuario_idUsuario),
  FOREIGN KEY(Grupo_Empresa_CodGrupo_Empresa, Grupo_Empresa_Usuario_idUsuario)
    REFERENCES Grupo_Empresa(CodGrupo_Empresa, Usuario_idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Cons_Documento (
  idCons_Documento SERIAL NOT NULL,
  Consultor_Usuario_idUsuario INTEGER NOT NULL,
  Consultor_idConsultor INTEGER NOT NULL,
  nombreDocumento VARCHAR(45) NULL,
  titulo_consdocumento  VARCHAR(45) NULL,
  descripcionConsultorDocumento TEXT NULL,
  pathDocumentoConsultor TEXT NULL,
  PRIMARY KEY(idCons_Documento, Consultor_Usuario_idUsuario, Consultor_idConsultor),
  FOREIGN KEY(Consultor_idConsultor, Consultor_Usuario_idUsuario)
    REFERENCES Consultor(idConsultor, Usuario_idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE repuesta_actividad (
  codrepuesta_actividad SERIAL NOT NULL,
  Cons_Actividad_Consultor_idConsultor INTEGER NOT NULL,
  Cons_Actividad_Consultor_Usuario_idUsuario INTEGER NOT NULL,
  Cons_Actividad_codCons_Actividad INTEGER NOT NULL,
  GE_Documento_Grupo_Empresa_Usuario_idUsuario INTEGER NOT NULL,
  GE_Documento_Grupo_Empresa_CodGrupo_Empresa INTEGER NOT NULL,
  GE_Documento_idGE_Documento INTEGER NOT NULL,
  PRIMARY KEY(codrepuesta_actividad, Cons_Actividad_Consultor_idConsultor, Cons_Actividad_Consultor_Usuario_idUsuario, Cons_Actividad_codCons_Actividad, GE_Documento_Grupo_Empresa_Usuario_idUsuario, GE_Documento_Grupo_Empresa_CodGrupo_Empresa, GE_Documento_idGE_Documento),
  FOREIGN KEY(Cons_Actividad_codCons_Actividad, Cons_Actividad_Consultor_Usuario_idUsuario, Cons_Actividad_Consultor_idConsultor)
    REFERENCES Cons_Actividad(codCons_Actividad, Consultor_Usuario_idUsuario, Consultor_idConsultor)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(GE_Documento_idGE_Documento, GE_Documento_Grupo_Empresa_CodGrupo_Empresa, GE_Documento_Grupo_Empresa_Usuario_idUsuario)
    REFERENCES GE_Documento(idGE_Documento, Grupo_Empresa_CodGrupo_Empresa, Grupo_Empresa_Usuario_idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE detalle_ge
(
  iddetalle_ge serial NOT NULL,
  evaluacion_semanal_calendario_grupo_empresa_usuario_idusuario integer NOT NULL,
  evaluacion_semanal_calendario_grupo_empresa_codgrupo_empresa integer NOT NULL,
  evaluacion_semanal_calendario_codcalendario integer NOT NULL,
  evaluacion_semanal_codevaluacion_semanal integer NOT NULL,
  rol character varying(120),
  esperado character varying(120),
  CONSTRAINT detalle_ge_pkey PRIMARY KEY (iddetalle_ge, evaluacion_semanal_calendario_grupo_empresa_usuario_idusuario, evaluacion_semanal_calendario_grupo_empresa_codgrupo_empresa, evaluacion_semanal_calendario_codcalendario, evaluacion_semanal_codevaluacion_semanal),
  CONSTRAINT detalle_ge_evaluacion_semanal_codevaluacion_semanal_fkey FOREIGN KEY (evaluacion_semanal_codevaluacion_semanal, evaluacion_semanal_calendario_codcalendario, evaluacion_semanal_calendario_grupo_empresa_codgrupo_empresa, evaluacion_semanal_calendario_grupo_empresa_usuario_idusuario)
      REFERENCES evaluacion_semanal (codevaluacion_semanal, calendario_codcalendario, calendario_grupo_empresa_codgrupo_empresa, calendario_grupo_empresa_usuario_idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE detalle_cons
(
  iddetalle_cons serial NOT NULL,
  consultor_idconsultor integer NOT NULL,
  detalle_ge_evaluacion_semanal_codevaluacion_semanal integer NOT NULL,
  detalle_ge_evaluacion_semanal_calendario_codcalendario integer NOT NULL,
  detalle_ge_evaluacion_semanal_calendario_grupo_empresa_codgrupo integer NOT NULL,
  detalle_ge_evaluacion_semanal_calendario_grupo_empresa_usuario_ integer NOT NULL,
  detalle_ge_iddetalle_ge integer NOT NULL,
  realizado text,
  observaciones text,
  detalle_esperado text,
  CONSTRAINT detalle_cons_pkey PRIMARY KEY (iddetalle_cons, consultor_idconsultor, detalle_ge_evaluacion_semanal_codevaluacion_semanal, detalle_ge_evaluacion_semanal_calendario_codcalendario, detalle_ge_evaluacion_semanal_calendario_grupo_empresa_codgrupo, detalle_ge_evaluacion_semanal_calendario_grupo_empresa_usuario_, detalle_ge_iddetalle_ge),
  CONSTRAINT detalle_cons_consultor_idconsultor_fkey FOREIGN KEY (consultor_idconsultor)
      REFERENCES consultor (idconsultor) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT detalle_cons_detalle_ge_iddetalle_ge_fkey FOREIGN KEY (detalle_ge_iddetalle_ge, detalle_ge_evaluacion_semanal_calendario_grupo_empresa_usuario_, detalle_ge_evaluacion_semanal_calendario_grupo_empresa_codgrupo, detalle_ge_evaluacion_semanal_calendario_codcalendario, detalle_ge_evaluacion_semanal_codevaluacion_semanal)
      REFERENCES detalle_ge (iddetalle_ge, evaluacion_semanal_calendario_grupo_empresa_usuario_idusuario, evaluacion_semanal_calendario_grupo_empresa_codgrupo_empresa, evaluacion_semanal_calendario_codcalendario, evaluacion_semanal_codevaluacion_semanal) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE consultor_proyecto_grupo_empresa (
  Consultor_Usuario_idUsuario INTEGER NOT NULL,
  Consultor_idConsultor INTEGER NOT NULL,
  Grupo_Empresa_Usuario_idUsuario INTEGER NOT NULL,
  Grupo_Empresa_CodGrupo_Empresa INTEGER NOT NULL,
  Proyecto_codProyecto VARCHAR(25) NOT NULL,
  PRIMARY KEY(Consultor_Usuario_idUsuario, Consultor_idConsultor, Grupo_Empresa_Usuario_idUsuario, Grupo_Empresa_CodGrupo_Empresa, Proyecto_codProyecto),
  FOREIGN KEY(Consultor_idConsultor, Consultor_Usuario_idUsuario)
    REFERENCES Consultor(idConsultor, Usuario_idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Grupo_Empresa_CodGrupo_Empresa, Grupo_Empresa_Usuario_idUsuario)
    REFERENCES Grupo_Empresa(CodGrupo_Empresa, Usuario_idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(Proyecto_codProyecto)
    REFERENCES Proyecto(codProyecto)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE hito_pagable (
  codhito_pagable integer NOT NULL,
  plan_pago_codplan_pago integer NOT NULL,
  plan_pago_calendario_codcalendario integer NOT NULL,
  plan_pago_calendario_grupo_empresa_codgrupo_empresa integer NOT NULL,
  plan_pago_calendario_grupo_empresa_usuario_idusuario integer NOT NULL,
  hitoevento character varying(120),
  porcentajepago integer,
  monto real,
  fechapago date,
  CONSTRAINT hito_pagable_pkey PRIMARY KEY (codhito_pagable, plan_pago_codplan_pago, plan_pago_calendario_codcalendario, plan_pago_calendario_grupo_empresa_codgrupo_empresa, plan_pago_calendario_grupo_empresa_usuario_idusuario),
  CONSTRAINT hito_pagable_plan_pago_codplan_pago_fkey FOREIGN KEY (plan_pago_codplan_pago, plan_pago_calendario_grupo_empresa_usuario_idusuario, plan_pago_calendario_grupo_empresa_codgrupo_empresa, plan_pago_calendario_codcalendario)
      REFERENCES plan_pago (codplan_pago, calendario_grupo_empresa_usuario_idusuario, calendario_grupo_empresa_codgrupo_empresa, calendario_codcalendario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE entregables (
  codentregables integer NOT NULL,
  hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar integer NOT NULL,
  hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres integer NOT NULL,
  hito_pagable_plan_pago_calendario_codcalendario integer NOT NULL,
  hito_pagable_plan_pago_codplan_pago integer NOT NULL,
  hito_pagable_codhito_pagable integer NOT NULL,
  entregable character varying(120),
  CONSTRAINT entregables_pkey PRIMARY KEY (codentregables, hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar, hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres, hito_pagable_plan_pago_calendario_codcalendario, hito_pagable_plan_pago_codplan_pago, hito_pagable_codhito_pagable),
  CONSTRAINT entregables_hito_pagable_codhito_pagable_fkey FOREIGN KEY (hito_pagable_codhito_pagable, hito_pagable_plan_pago_codplan_pago, hito_pagable_plan_pago_calendario_codcalendario, hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres, hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar)
      REFERENCES hito_pagable (codhito_pagable, plan_pago_codplan_pago, plan_pago_calendario_codcalendario, plan_pago_calendario_grupo_empresa_codgrupo_empresa, plan_pago_calendario_grupo_empresa_usuario_idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE pago_consultor (
  codpago_consultor serial NOT NULL,
  consultor_idconsultor integer NOT NULL,
  consultor_usuario_idusuario integer NOT NULL,
  hito_pagable_plan_pago_codplan_pago integer NOT NULL,
  hito_pagable_codhito_pagable integer NOT NULL,
  hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar integer NOT NULL,
  hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres integer NOT NULL,
  hito_pagable_plan_pago_calendario_codcalendario integer NOT NULL,
  hitooevento character varying(120),
  porcentajesatisfaccion integer,
  porcentajealcazado integer,
  montopago real,
  estadopago character varying(45),
  CONSTRAINT pago_consultor_pkey PRIMARY KEY (codpago_consultor, consultor_idconsultor, consultor_usuario_idusuario, hito_pagable_plan_pago_codplan_pago, hito_pagable_codhito_pagable, hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar, hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres, hito_pagable_plan_pago_calendario_codcalendario),
  CONSTRAINT pago_consultor_consultor_idconsultor_fkey FOREIGN KEY (consultor_idconsultor, consultor_usuario_idusuario)
      REFERENCES consultor (idconsultor, usuario_idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT pago_consultor_hito_pagable_codhito_pagable_fkey FOREIGN KEY (hito_pagable_codhito_pagable, hito_pagable_plan_pago_codplan_pago, hito_pagable_plan_pago_calendario_codcalendario, hito_pagable_plan_pago_calendario_grupo_empresa_codgrupo_empres, hito_pagable_plan_pago_calendario_grupo_empresa_usuario_idusuar)
      REFERENCES hito_pagable (codhito_pagable, plan_pago_codplan_pago, plan_pago_calendario_codcalendario, plan_pago_calendario_grupo_empresa_codgrupo_empresa, plan_pago_calendario_grupo_empresa_usuario_idusuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);


INSERT INTO rol(tiporol)
    VALUES ('administrador');
INSERT INTO rol(tiporol)
    VALUES ('consultor');
INSERT INTO rol(tiporol)
    VALUES ('empresa');
INSERT INTO rol(tiporol)
    VALUES ('socio');
INSERT INTO usuario(
             login, passwd,habilitada)
    VALUES ( 'admin', 'n@T59bDxP4.',TRUE);

INSERT INTO user_rol(
            usuario_idusuario, rol_codrol)
    VALUES ('1', '1');
INSERT INTO tipo_socio(nombretipo)
               VALUES ('representante legal');
INSERT INTO tipo_socio(nombretipo)
               VALUES ('socio regular');

INSERT INTO tipo_criterio(
            tipo)
    VALUES ('verdadero/falso');
INSERT INTO tipo_criterio(
            tipo)
    VALUES ('numerico');
INSERT INTO tipo_criterio(
            tipo)
    VALUES ('escala conceptual');
INSERT INTO tipo_criterio(
            tipo)
    VALUES ('escala numeral');
