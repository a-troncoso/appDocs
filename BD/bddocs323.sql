-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2014 a las 19:28:51
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bddocs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `EDTArea` varchar(12) NOT NULL DEFAULT '',
  `nombreArea` varchar(50) DEFAULT NULL
) TYPE=InnoDB;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`EDTArea`, `nombreArea`) VALUES
('1.01', 'Direccion del Proyecto'),
('1.02', 'Asuntos publicos'),
('1.03', 'Legal'),
('1.04', 'Medio ambiente'),
('1.05', 'Geologia y recursos'),
('1.06', 'Hidrogeologia'),
('1.07', 'Mineria y reserva'),
('1.08', 'Prueba de concepto D.I.S'),
('1.09', 'Costos'),
('1.10', 'Caso de negocio proyecto comercial'),
('1.11', 'Control documental');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativodisciplina`
--

CREATE TABLE IF NOT EXISTS `correlativodisciplina` (
  `correlativo` tinyint(4) NOT NULL DEFAULT '0',
  `codDisciplina` varchar(3) NOT NULL DEFAULT ''
) TYPE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disciplinas`
--

CREATE TABLE IF NOT EXISTS `disciplinas` (
  `codDisciplina` varchar(4) NOT NULL DEFAULT '',
  `nombreDisciplina` varchar(70) DEFAULT NULL,
  `codGrupoDisciplina` tinyint(3) DEFAULT NULL
) TYPE=InnoDB;

--
-- Volcado de datos para la tabla `disciplinas`
--

INSERT INTO `disciplinas` (`codDisciplina`, `nombreDisciplina`, `codGrupoDisciplina`) VALUES
('10', 'Sondaje', 1),
('11', 'Geoquímica', 1),
('12', 'Geología', 1),
('13', 'Geofísica', 1),
('14', 'Sistema de información Geografica', 1),
('15', 'Estimacion de recursos', 1),
('21', 'Hidrogeologia', 2),
('31', 'Perforacion', 3),
('32', 'Plan Minero Desorción In-situ', 3),
('33', 'Estimacion de reservas', 3),
('34', 'Evaluacion economica', 3),
('41', 'Desorcion', 4),
('42', 'Precipitacion', 4),
('43', 'Separacion solido -liquido', 4),
('44', 'Calcinacion', 4),
('45', 'Manejo de Residuos (RISES Y RILES)', 4),
('50', 'Arquitectura', 5),
('51', 'Servicio de Construccion', 5),
('52', 'Civil', 5),
('53', 'Comunicaciones', 5),
('54', 'Concreto', 5),
('55', 'Sistema de control', 5),
('56', 'Eléctrico', 5),
('57', 'Estudios de Electrificación', 5),
('58', 'Gestión de Ingeniería', 5),
('59', 'Geotécnica', 5),
('5A', 'Instrumentación', 5),
('5B', 'Layout', 5),
('5C', 'Mecánica', 5),
('5D', 'Piping', 5),
('5E', 'Procesos', 5),
('5F', 'Estructural', 5),
('5G', 'Transporte', 5),
('61', 'Operación', 6),
('62', 'Entrenamiento', 6),
('70', 'Contabilidad', 7),
('71', 'Administración', 7),
('72', 'Finanzas', 7),
('73', 'Recursos Humanos', 7),
('74', 'Logística', 7),
('75', 'Comercialización', 7),
('76', 'Evaluación de proyectos', 7),
('77', 'Publicidad', 7),
('80', 'Control de Proyecto', 8),
('81', 'Control de documentos', 8),
('82', 'Gestión', 8),
('83', 'Planificación de proyecto', 8),
('90', 'Relaciones públicas', 9),
('91', 'Corporativo', 9),
('92', 'Ambiental', 9),
('93', 'Salud y seguridad.', 9),
('94', 'Sistema Integrado de Gestión', 9),
('95', 'Legal.', 9),
('96', 'Calidad', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `codDocumento` varchar(30) NOT NULL DEFAULT '',
  `nombreArchivo` varchar(250) NOT NULL,
  `tituloDoc` varchar(50) DEFAULT NULL,
  `EDTSubArea` varchar(10) DEFAULT NULL,
  `codDisciplina` varchar(3) DEFAULT NULL,
  `codTipoDocumento` varchar(3) DEFAULT NULL,
  `codVersion` varchar(3) NOT NULL,
  `estadoEmision` varchar(30) NOT NULL,
  `resumenDoc` varchar(1000) DEFAULT NULL,
  `observacionesDoc` varchar(1000) DEFAULT NULL,
  `palabrasClave` varchar(150) DEFAULT NULL,
  `fechaSubida` datetime DEFAULT NULL
) TYPE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposdisciplina`
--

CREATE TABLE IF NOT EXISTS `gruposdisciplina` (
  `codGrupoDisciplina` tinyint(3) NOT NULL DEFAULT '0',
  `nombreGrupoDisciplina` varchar(50) DEFAULT NULL
) TYPE=InnoDB;

--
-- Volcado de datos para la tabla `gruposdisciplina`
--

INSERT INTO `gruposdisciplina` (`codGrupoDisciplina`, `nombreGrupoDisciplina`) VALUES
(1, 'Geologia'),
(2, 'Hidrogeologia'),
(3, 'Minería'),
(4, 'Metalurgia'),
(5, 'Aboveground'),
(6, 'Operación'),
(7, 'Administración'),
(8, 'Direccion y Control'),
(9, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupostipodocumento`
--

CREATE TABLE IF NOT EXISTS `grupostipodocumento` (
  `codGrupoTipoDocumento` varchar(3) NOT NULL DEFAULT '',
  `nombreGrupoTipoDocumento` varchar(70) DEFAULT NULL
) TYPE=InnoDB;

--
-- Volcado de datos para la tabla `grupostipodocumento`
--

INSERT INTO `grupostipodocumento` (`codGrupoTipoDocumento`, `nombreGrupoTipoDocumento`) VALUES
('A', 'Requerimiento'),
('B', 'Dibujo/Plano'),
('C', 'Especificacion'),
('D', 'Diseño'),
('E', 'Licitacion'),
('F', 'Administracion del Contrato'),
('G', 'Comunicación'),
('H', 'Formato'),
('I', 'Entregable'),
('J', 'Pagos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposusuario`
--

CREATE TABLE IF NOT EXISTS `gruposusuario` (
`codGrupoUsuario` tinyint(4) NOT NULL,
  `nombreGrupoUsuario` varchar(50) DEFAULT NULL
) TYPE=InnoDB  AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `gruposusuario`
--

INSERT INTO `gruposusuario` (`codGrupoUsuario`, `nombreGrupoUsuario`) VALUES
(1, 'Sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupousuariousuario`
--

CREATE TABLE IF NOT EXISTS `grupousuariousuario` (
`codGrupoUsuario` tinyint(3) NOT NULL,
  `codUsuario` tinyint(3) NOT NULL DEFAULT '0'
) TYPE=InnoDB  AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `grupousuariousuario`
--

INSERT INTO `grupousuariousuario` (`codGrupoUsuario`, `codUsuario`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logsusuarios`
--

CREATE TABLE IF NOT EXISTS `logsusuarios` (
`codLog` int(7) NOT NULL,
  `codUsuario` tinyint(4) DEFAULT NULL,
  `accion` varchar(250) DEFAULT NULL,
  `fechaAccion` datetime
) TYPE=InnoDB AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesionesusuariosporid`
--

CREATE TABLE IF NOT EXISTS `sesionesusuariosporid` (
`codAcceso` int(7) NOT NULL,
  `codUsuario` tinyint(4) DEFAULT NULL,
  `IDAcceso` varchar(20) DEFAULT NULL,
  `estadoSesion` tinyint(1) DEFAULT NULL
) TYPE=InnoDB AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subareas`
--

CREATE TABLE IF NOT EXISTS `subareas` (
  `EDTSubArea` varchar(12) NOT NULL DEFAULT '',
  `nombreSubArea` varchar(100) DEFAULT NULL,
  `EDTArea` varchar(12) DEFAULT NULL
) TYPE=InnoDB;

--
-- Volcado de datos para la tabla `subareas`
--

INSERT INTO `subareas` (`EDTSubArea`, `nombreSubArea`, `EDTArea`) VALUES
('1.01.01', 'Inicio proyecto', '1.01'),
('1.01.02', 'Elaborar Plan de Dirección', '1.01'),
('1.01.03', 'Plan de direccion elaborado', '1.01'),
('1.01.04', 'Realizar reuniones (semanal-lunes)', '1.01'),
('1.01.05', 'Elaborar informes estado proyecto (mensual)', '1.01'),
('1.01.06', 'Realizar análisis de riesgos (plan)', '1.01'),
('1.01.07', 'Fin proyecto', '1.01'),
('1.01.08', 'Inicio proyecto - cantera', '1.01'),
('1.01.09', 'Elaborar ppta de evaluacion conceptual - Cantera', '1.01'),
('1.01.10', 'Realizar presentacion evaluacion conceptual a Directorio - Cantera', '1.01'),
('1.01.11', 'Elaborar presentacion de evaluacion de detalle - Cantera', '1.01'),
('1.01.12', 'Realizar presentacion detalle y obtener aprobacion por Directorio - Cantera', '1.01'),
('1.01.13', 'Aprobacion de evaluacion de detalle - Cantera', '1.01'),
('1.01.14', 'Realizar cierre', '1.01'),
('1.02.01', 'Realizar Levantamiento de Stakeholders', '1.02'),
('1.02.02', 'Desarrollar Plan Comunicacional', '1.02'),
('1.02.03', 'Plan Comunicación Iniciado', '1.02'),
('1.02.04', 'Elaborar página web', '1.02'),
('1.02.05', 'Recibir autorizacion preliminar hermanos Recart - Cantera', '1.02'),
('1.03.01', 'Gestionar propiedad minera (mensual)', '1.03'),
('1.03.02', 'Levantar derechos de aguas', '1.03'),
('1.03.03', 'Realizar negociaciones con dueños superficiales', '1.03'),
('1.03.04', 'Elaborar propiedad intelectual y tecnológica', '1.03'),
('1.03.05', 'Elaborar titularidad, impuesto y regalías', '1.03'),
('1.03.06', 'Elaborar marco legal (Desarrollar Alcance)', '1.03'),
('1.03.07', 'Gestionar y elaborar permisos PdC', '1.03'),
('1.03.08', 'nueva sub area legal 3', '1.03'),
('1.04.01', 'Elaborar Línea base ambiental', '1.04'),
('1.04.02', 'Elaborar Evaluación de pertinencia ambiental', '1.04'),
('1.04.03', 'Elaborar Plan de gestión ambiental-Condiciones precedentes', '1.04'),
('1.04.04', 'Fase ejecucion - Medio Ambiente', '1.04'),
('1.04.05', 'Fase operación - Medio Ambiente', '1.04'),
('1.04.06', 'Fase cierre - Medio Ambiente', '1.04'),
('1.05.01', 'Elaborar mapa de superficie, litología y estructura', '1.05'),
('1.05.02', 'Realizar levantamiento geo-quimico de superficie XRF', '1.05'),
('1.05.03', 'Realizar muestreo de sonda sonica ICP', '1.05'),
('1.05.04', 'Realizar loggeo sondaje sónico y barreno', '1.05'),
('1.05.08', 'Determinar blanco exploratorio', '1.05'),
('1.05.09', 'Elaborar programa de sondaje sonico regional', '1.05'),
('1.05.10', 'Implementar programa sondaje sónico regional', '1.05'),
('1.05.11', 'Elaborar modelo geológico', '1.05'),
('1.05.12', 'Elaborar mapa geofísico', '1.05'),
('1.05.13', 'Elaborar modelo de recursos', '1.05'),
('1.05.14', 'Realizar estimación de recursos', '1.05'),
('1.06.01', 'Elaborar pozos de monitoreo-agua', '1.06'),
('1.06.02', 'Habilitar pozos de monitoreo', '1.06'),
('1.06.03', 'Tomar y analizar muestras- hidrogeología', '1.06'),
('1.06.04', 'Realizar preparación de probetas', '1.06'),
('1.06.05', 'Realizar pruebas de capacidad de campo', '1.06'),
('1.06.06', 'Elaborar modelo hidrogeologico', '1.06'),
('1.06.07', 'Elaborar línea base calidad agua (superficial y subterranea)', '1.06'),
('1.06.08', 'Realizar monitoreo hidrogelogico operación PdC', '1.06'),
('1.07.01', 'Diseñar métodos de extracción', '1.07'),
('1.07.02', 'Estimar Reserva', '1.07'),
('1.07.03', 'Reserva estimada', '1.07'),
('1.07.04', 'Determinar parametros geotécnicos - Cantera', '1.07'),
('1.07.05', 'Elaborar diseño de mina y programa de producción - Cantera', '1.07'),
('1.07.06', 'Determinar OPEX y CAPEX mina - Cantera', '1.07'),
('1.08.01', 'Metalurgia (under ground/ above ground)', '1.08'),
('1.08.02', 'Procesamiento Mineral - Cantera', '1.08'),
('1.08.03', 'Realizar configuración del diseño PdC in-situ', '1.08'),
('1.08.04', 'Desarrolar la Ingeniería', '1.08'),
('1.08.05', 'Diseñar plan de cierre PdC', '1.08'),
('1.08.06', 'Elaborar plan de control y monitoreo de emisiones PdC', '1.08'),
('1.08.07', 'Elaborar plan de secuencia y programación de producción PdC', '1.08'),
('1.08.08', 'Infraestructura Off-site - PdC', '1.08'),
('1.08.09', 'Infraestructura On-site - PdC ****', '1.08'),
('1.08.10', 'Contratar e implementar servicios - Cantera', '1.08'),
('1.08.11', 'Construir planta - Cantera', '1.08'),
('1.08.12', 'Infraestructura Underground - PdC', '1.08'),
('1.08.13', 'Infraestructura Above ground', '1.08'),
('1.08.14', 'Planta PdC', '1.08'),
('1.08.15', 'Definir la organización- PdC', '1.08'),
('1.08.16', 'Operación PdC in-situ', '1.08'),
('1.08.17', 'Operación faena cantera', '1.08'),
('1.08.18', 'Ejecutar plan de cierre PdC', '1.08'),
('1.08.19', 'Gestionar HSEC- PdC', '1.08'),
('1.08.20', 'Gestionar Calidad- PdC', '1.08'),
('1.08.21', 'Determinar OPEX y CAPEX- PdC', '1.08'),
('1.09.01', 'Estimar costos de inversión', '1.09'),
('1.09.02', 'Estimar costos de operación', '1.09'),
('1.10.01', 'Contactar joint venture', '1.10'),
('1.10.02', 'Desarrollar la Ingenieria Conceptual proyecto comercial', '1.10'),
('1.10.03', 'Ingenieria Conceptual proyecto comercial iniciado', '1.10'),
('1.10.04', 'Elaborar informe de marketing', '1.10'),
('1.10.05', 'Realizar la evaluación económica del proyecto', '1.10'),
('1.10.06', 'Elaborar caso negocio', '1.10'),
('1.10.07', 'Presentar y recibir la aprobación del Caso Negocio', '1.10'),
('1.10.08', 'Caso de negocio aprobado', '1.10'),
('1.10.09', 'Desarrollar evaluación economica conceptual - Cantera', '1.10'),
('1.10.10', 'Determinar eventuales Clientes y acordar termino de comercialización', '1.10'),
('1.10.11', 'Realizar la evaluación económica de detalle del proyecto - Cantera', '1.10'),
('1.11.01', 'Implementar sistema control documental', '1.11'),
('1.11.02', 'Elaborar listado Documentos técnicos', '1.11'),
('1.11.03', 'Elaborar listado Planos', '1.11'),
('1.11.04', 'Elaborar listado Documentos especiales', '1.11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposdocumento`
--

CREATE TABLE IF NOT EXISTS `tiposdocumento` (
  `codTipoDocumento` varchar(3) NOT NULL DEFAULT '',
  `nombreTipoDocumento` varchar(100) DEFAULT NULL,
  `codGrupoTipoDocumento` varchar(3) DEFAULT NULL
) TYPE=InnoDB;

--
-- Volcado de datos para la tabla `tiposdocumento`
--

INSERT INTO `tiposdocumento` (`codTipoDocumento`, `nombreTipoDocumento`, `codGrupoTipoDocumento`) VALUES
('AA', 'Ingeniería / Requisiciones técnicas', 'A'),
('AB', 'Solicitud de orden de cambio', 'A'),
('AC', 'Requerimiento de información', 'A'),
('AD', 'Orden de trabajo', 'A'),
('AE', 'Orden de compra', 'A'),
('BA', 'Planos de proceso', 'B'),
('BB', 'Planos de distribución / ubicación', 'B'),
('BC', 'Plano topográfico', 'B'),
('BD', 'Mapa/Secciones', 'B'),
('BE', 'Planos de fabricación / construcción', 'B'),
('BF', 'Esquema preliminar', 'B'),
('CA', 'Especificaciones de Construcción', 'C'),
('CB', 'Especificaciones de instalación', 'C'),
('CC', 'Especificaciones de Materiales/Equipos', 'C'),
('CD', 'Especificaciones estándar', 'C'),
('CE', 'Especificaciones técnicas', 'C'),
('DA', 'Parametros de diseño', 'D'),
('DB', 'Cálculos de diseño', 'D'),
('DC', 'Criterios de diseño', 'D'),
('EA', 'Especificacion oferta administrativa', 'E'),
('EB', 'Especificacion oferta general', 'E'),
('EC', 'Especificacion oferta técnica', 'E'),
('ED', 'Evaluacion economica de la oferta', 'E'),
('EE', 'Documento Maestro del Alcance', 'E'),
('EF', 'Evaluacion técnica de la oferta', 'E'),
('FA', 'Carta adjudicacion', 'F'),
('FB', 'Contrato', 'F'),
('FC', 'Estado de pago', 'F'),
('FD', 'Finquito contrato', 'F'),
('GA', 'Audio', 'G'),
('GB', 'Correo Electrónico', 'G'),
('GC', 'Carta', 'G'),
('GD', 'Respaldo de correspondencia', 'G'),
('GE', 'Memorándum', 'G'),
('GF', 'Minutas', 'G'),
('GG', 'Fotos', 'G'),
('GH', 'Presentaciones', 'G'),
('GI', 'Videos', 'G'),
('HA', 'Formulario', 'F'),
('HB', 'Instructivo', 'F'),
('HC', 'Manuales', 'F'),
('HD', 'Procedimientos', 'F'),
('HE', 'Registros', 'F'),
('IA', 'Informe Flash de Accidentes', 'I'),
('IB', 'Informe de Accidente / Informe de Incidente', 'I'),
('IC', 'Informe administrativo', 'I'),
('ID', 'Lista de chequeo', 'I'),
('IE', 'Informe de control', 'I'),
('IF', 'Informe económico', 'I'),
('IG', 'Lista', 'I'),
('IH', 'Informe de avance', 'I'),
('II', 'Estudio', 'I'),
('IJ', 'Programa', 'I'),
('IK', 'Informe técnico', 'I'),
('IL', 'Data Sheet', 'I'),
('JA', 'Boleta', 'J'),
('JB', 'Factura', 'J'),
('JC', 'Reembolso', 'J');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`codUsuario` tinyint(4) NOT NULL,
  `nombreUsuario` varchar(30) NOT NULL DEFAULT '',
  `nombrePersona` varchar(25) DEFAULT NULL,
  `apellidoPersona` varchar(25) DEFAULT NULL,
  `mailPersona` varchar(50) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `rolAdministrador` tinyint(1) NOT NULL DEFAULT '0',
  `permisoAgregarDoc` tinyint(1) DEFAULT NULL,
  `permisoBuscarVerDoc` tinyint(1) DEFAULT NULL,
  `permisoEditarDoc` tinyint(1) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) TYPE=InnoDB  AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codUsuario`, `nombreUsuario`, `nombrePersona`, `apellidoPersona`, `mailPersona`, `clave`, `rolAdministrador`, `permisoAgregarDoc`, `permisoBuscarVerDoc`, `permisoEditarDoc`, `estado`) VALUES
(1, 'admin', NULL, NULL, NULL, '123', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosaprobarondocumentos`
--

CREATE TABLE IF NOT EXISTS `usuariosaprobarondocumentos` (
  `codDocumento` varchar(30) NOT NULL,
  `codUsuario` tinyint(4) NOT NULL DEFAULT '0'
) TYPE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosdisciplina`
--

CREATE TABLE IF NOT EXISTS `usuariosdisciplina` (
  `codUsuario` tinyint(4) DEFAULT NULL,
  `codDisciplina` varchar(4) DEFAULT NULL
) TYPE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosrevisandocumentos`
--

CREATE TABLE IF NOT EXISTS `usuariosrevisandocumentos` (
  `codDocumento` varchar(30) NOT NULL DEFAULT '',
  `codUsuario` tinyint(4) NOT NULL DEFAULT '0',
  `codUsuarioEmisor` tinyint(4) NOT NULL DEFAULT '0'
) TYPE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `versiones`
--

CREATE TABLE IF NOT EXISTS `versiones` (
  `codVersion` varchar(3) NOT NULL DEFAULT '',
  `nombreVersion` varchar(50) DEFAULT NULL
) TYPE=InnoDB;

--
-- Volcado de datos para la tabla `versiones`
--

INSERT INTO `versiones` (`codVersion`, `nombreVersion`) VALUES
('V00', 'Versión aprobada'),
('V0B', 'Cliente / Revisor'),
('V0C', 'Cliente / Revisor'),
('V0D', 'Cliente / Revisor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
 ADD PRIMARY KEY (`EDTArea`);

--
-- Indices de la tabla `correlativodisciplina`
--
ALTER TABLE `correlativodisciplina`
 ADD PRIMARY KEY (`correlativo`,`codDisciplina`), ADD KEY `codDisciplina` (`codDisciplina`);

--
-- Indices de la tabla `disciplinas`
--
ALTER TABLE `disciplinas`
 ADD PRIMARY KEY (`codDisciplina`), ADD KEY `codGrupoDisciplina` (`codGrupoDisciplina`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
 ADD PRIMARY KEY (`codDocumento`), ADD KEY `EDTSubArea` (`EDTSubArea`), ADD KEY `codDisciplina` (`codDisciplina`), ADD KEY `codTipoDocumento` (`codTipoDocumento`);

--
-- Indices de la tabla `gruposdisciplina`
--
ALTER TABLE `gruposdisciplina`
 ADD PRIMARY KEY (`codGrupoDisciplina`);

--
-- Indices de la tabla `grupostipodocumento`
--
ALTER TABLE `grupostipodocumento`
 ADD PRIMARY KEY (`codGrupoTipoDocumento`);

--
-- Indices de la tabla `gruposusuario`
--
ALTER TABLE `gruposusuario`
 ADD PRIMARY KEY (`codGrupoUsuario`);

--
-- Indices de la tabla `grupousuariousuario`
--
ALTER TABLE `grupousuariousuario`
 ADD PRIMARY KEY (`codGrupoUsuario`,`codUsuario`), ADD KEY `codUsuario` (`codUsuario`);

--
-- Indices de la tabla `logsusuarios`
--
ALTER TABLE `logsusuarios`
 ADD PRIMARY KEY (`codLog`), ADD KEY `codUsuario` (`codUsuario`);

--
-- Indices de la tabla `sesionesusuariosporid`
--
ALTER TABLE `sesionesusuariosporid`
 ADD PRIMARY KEY (`codAcceso`), ADD KEY `codUsuario` (`codUsuario`);

--
-- Indices de la tabla `subareas`
--
ALTER TABLE `subareas`
 ADD PRIMARY KEY (`EDTSubArea`), ADD KEY `EDTArea` (`EDTArea`);

--
-- Indices de la tabla `tiposdocumento`
--
ALTER TABLE `tiposdocumento`
 ADD PRIMARY KEY (`codTipoDocumento`), ADD KEY `codGrupoTipoDocumento` (`codGrupoTipoDocumento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`codUsuario`,`nombreUsuario`), ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`);

--
-- Indices de la tabla `usuariosaprobarondocumentos`
--
ALTER TABLE `usuariosaprobarondocumentos`
 ADD PRIMARY KEY (`codDocumento`,`codUsuario`);

--
-- Indices de la tabla `usuariosrevisandocumentos`
--
ALTER TABLE `usuariosrevisandocumentos`
 ADD PRIMARY KEY (`codDocumento`,`codUsuario`), ADD KEY `codUsuario` (`codUsuario`);

--
-- Indices de la tabla `versiones`
--
ALTER TABLE `versiones`
 ADD PRIMARY KEY (`codVersion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gruposusuario`
--
ALTER TABLE `gruposusuario`
MODIFY `codGrupoUsuario` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `grupousuariousuario`
--
ALTER TABLE `grupousuariousuario`
MODIFY `codGrupoUsuario` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `logsusuarios`
--
ALTER TABLE `logsusuarios`
MODIFY `codLog` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sesionesusuariosporid`
--
ALTER TABLE `sesionesusuariosporid`
MODIFY `codAcceso` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `codUsuario` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `correlativodisciplina`
--
ALTER TABLE `correlativodisciplina`
ADD CONSTRAINT `correlativodisciplina_ibfk_1` FOREIGN KEY (`codDisciplina`) REFERENCES `disciplinas` (`codDisciplina`) ON DELETE CASCADE;

--
-- Filtros para la tabla `disciplinas`
--
ALTER TABLE `disciplinas`
ADD CONSTRAINT `disciplinas_ibfk_1` FOREIGN KEY (`codGrupoDisciplina`) REFERENCES `gruposdisciplina` (`codGrupoDisciplina`) ON DELETE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`EDTSubArea`) REFERENCES `subareas` (`EDTSubArea`) ON DELETE CASCADE,
ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`codDisciplina`) REFERENCES `disciplinas` (`codDisciplina`) ON DELETE CASCADE,
ADD CONSTRAINT `documentos_ibfk_3` FOREIGN KEY (`codTipoDocumento`) REFERENCES `tiposdocumento` (`codTipoDocumento`) ON DELETE CASCADE;

--
-- Filtros para la tabla `grupousuariousuario`
--
ALTER TABLE `grupousuariousuario`
ADD CONSTRAINT `grupousuariousuario_ibfk_1` FOREIGN KEY (`codGrupoUsuario`) REFERENCES `gruposusuario` (`codGrupoUsuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `subareas`
--
ALTER TABLE `subareas`
ADD CONSTRAINT `subareas_ibfk_1` FOREIGN KEY (`EDTArea`) REFERENCES `areas` (`EDTArea`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tiposdocumento`
--
ALTER TABLE `tiposdocumento`
ADD CONSTRAINT `tiposdocumento_ibfk_1` FOREIGN KEY (`codGrupoTipoDocumento`) REFERENCES `grupostipodocumento` (`codGrupoTipoDocumento`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuariosrevisandocumentos`
--
ALTER TABLE `usuariosrevisandocumentos`
ADD CONSTRAINT `usuariosrevisandocumentos_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `usuarios` (`codUsuario`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
