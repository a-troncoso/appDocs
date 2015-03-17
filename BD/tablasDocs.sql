create table areas(
	EDTArea varchar(12),
	nombreArea varchar(50),
	primary key (EDTArea)
);

create table subAreas(
	EDTSubArea varchar(12),
	nombreSubArea varchar(100),
	EDTArea varchar(12),
	primary key (EDTSubArea),
	foreign key (EDTArea) references areas(EDTArea) on delete cascade
);

create table gruposDisciplina(
	codGrupoDisciplina tinyint(3),
	nombreGrupoDisciplina varchar(50),
	primary key (codGrupoDisciplina)
);

create table disciplinas(
	codDisciplina varchar(4),
	nombreDisciplina varchar(70),
	codGrupoDisciplina tinyint(3),
	primary key (codDisciplina),
	foreign key (codGrupoDisciplina) references gruposDisciplina(codGrupoDisciplina) on delete cascade
);

create table gruposTipoDocumento(
	codGrupoTipoDocumento varchar(3),
	nombreGrupoTipoDocumento varchar(70),
	primary key (codGrupoTipoDocumento)
);

create table tiposDocumento(
	codTipoDocumento varchar(3),
	nombreTipoDocumento varchar(100),
	codGrupoTipoDocumento varchar(3),
	primary key (codTipoDocumento),
	foreign key (codGrupoTipoDocumento) references gruposTipoDocumento(codGrupoTipoDocumento) on delete cascade
);

create table gruposUsuario(
	codGrupoUsuario tinyint(4) NOT NULL AUTO_INCREMENT,
	nombreGrupoUsuario varchar(50),
	primary key (codGrupoUsuario)
);

create table usuarios(
	codUsuario tinyint(4) NOT NULL AUTO_INCREMENT,
	nombreUsuario varchar(30) UNIQUE,
	nombrePersona varchar(25),
	apellidoPersona varchar(25),
	mailPersona varchar(50),
	clave varchar(50),
	rolAdministrador tinyint(1) DEFAULT '0',
	permisoAgregarDoc tinyint(1),
	permisoBuscarVerDoc tinyint(1),
	permisoEditarDoc tinyint(1),
	estado tinyint(1),
	primary key (nombreUsuario)
);
--ESTA TABLA RELACIONA USUARIOS CON SUS GRUPOS
create table grupoUsuarioUsuario(
	codGrupoUsuario tinyint(3) NOT NULL AUTO_INCREMENT,
	codUsuario tinyint(3),
	primary key (codGrupoUsuario, codUsuario),
	foreign key (codGrupoUsuario) references gruposUsuario(codGrupoUsuario) on delete cascade,
	foreign key (codUsuario) references usuarios(codUsuario) on delete cascade
);

create table versiones(
	codVersion varchar(3),
	nombreVersion varchar(50),
	primary key (codVersion)
);

create table documentos(
	codDocumento varchar(30),
	tituloDoc varchar(50),
	EDTSubArea varchar(10),
	codDisciplina varchar(3),
	codTipoDocumento varchar(3),
	codVersion varchar(3),
	resumenDoc varchar(1000),
	observacionesDoc varchar(1000),
	palabrasClave varchar(150),
	fechaSubida datetime DEFAULT CURRENT_TIMESTAMP,
	primary key (codDocumento),
	foreign key (EDTSubArea) references subAreas(EDTSubArea) on delete cascade,
	foreign key (codDisciplina) references disciplinas(codDisciplina) on delete cascade,
	foreign key (codTipoDocumento) references tiposDocumento(codTipoDocumento) on delete cascade

);

--TABLA QUE SIRVE PARA GUARDAR LOS CORRELATIVOS POR CADA DISCIPLINA
create table correlativoDisciplina(
	correlativo tinyint(4),
	codDisciplina varchar(3),
	primary key (correlativo, codDisciplina),
	foreign key (codDisciplina) references disciplinas(codDisciplina) on delete cascade
); 
-- esta tabla relaciona que usuarios revisan que documentos
create table usuariosRevisanDocumentos(
	codDocumento varchar(30),
	codUsuario tinyint(4),
	primary key (codDocumento, codUsuario),
	foreign key (codUsuario) references usuarios(codUsuario) on delete cascade
);

create table logsUsuarios(
	codLog int(7) NOT NULL AUTO_INCREMENT,
	codUsuario tinyint(4),
	accion varchar(250),
	fechaAccion datetime DEFAULT CURRENT_TIMESTAMP,
	primary key (codLog),
	foreign key (codUsuario) references usuarios(codUsuario) on delete cascade
);

--ESTA TABLA GUARDA LA RELACION QUE HAY ENTRE EL USUARIO Y SU CODIGO DE SESION
--REVISAAAAARRRRR!!!!
create table sesionesUsuariosPorID(
	codAcceso int(7) NOT NULL AUTO_INCREMENT,
	codUsuario tinyint(4),
	IDAcceso varchar(20),
	estadoSesion tinyint(1),
	primary key (codAcceso),
	foreign key (codUsuario) references usuarios(codUsuario) on delete cascade
);
create table usuariosdisiplina(
    codUsuario tinyint(4),
    codDisciplina varchar(4)
)