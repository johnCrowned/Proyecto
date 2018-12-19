-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2018 a las 07:00:28
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_sosp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apprentice`
--

CREATE TABLE `apprentice` (
  `statusId` varchar(45) NOT NULL,
  `documentNumber` varchar(50) NOT NULL,
  `documentName` varchar(50) NOT NULL,
  `fichaNumber` varchar(20) NOT NULL,
  `groupCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `apprentice`
--

INSERT INTO `apprentice` (`statusId`, `documentNumber`, `documentName`, `fichaNumber`, `groupCode`) VALUES
('Activo', '1013677903', 'CC', '1262154', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checklist`
--

CREATE TABLE `checklist` (
  `listId` varchar(45) NOT NULL,
  `statusCL` tinyint(1) NOT NULL,
  `programCode_version` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `checklist`
--

INSERT INTO `checklist` (`listId`, `statusCL`, `programCode_version`) VALUES
('1', 1, '228004'),
('2', 1, '228005'),
('3', 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competence`
--

CREATE TABLE `competence` (
  `codeC` varchar(40) NOT NULL,
  `denomination` tinytext NOT NULL,
  `programCode_version` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `competence`
--

INSERT INTO `competence` (`codeC`, `denomination`, `programCode_version`) VALUES
('220501006', 'ESPECIFICAR LOS REQUISITOS NECESARIOS PARA DESARROLLAR EL SISTEMA DE INFORMACIÓN DE ACUERDO CON LAS NECESIDADES DEL CLIENTE', '228004'),
('220501007', 'CONSTRUIR EL SISTEMA QUE CUMPLA CON LOS REQUISITOS DE LA SOLUCIÓN INFORMÁTICA', '228004'),
('220501009', 'PARTICIPAR EN EL PROCESO DE NEGOCIACIÓN DE TECNOLOGÍA INFORMÁTICA PARA PERMITIR LA IMPLEMENTACIÓN DEL SISTEMA DE INFORMACIÓN', '228004'),
('220501032', 'PARTICIPAR EN EL PROCESO DE NEGOCIACIÓN DE TECNOLOGÍA INFORMÁTICA PARA PERMITIR LA IMPLEMENTACIÓN DEL SISTEMA DE INFORMACIÓN', '228004'),
('220501033', 'DISEÑAR EL SISTEMA DE ACUERDO CON LOS REQUISITOS DEL CLIENTE', '228004'),
('220501034', 'IMPLANTAR LA SOLUCIÓN QUE CUMPLA CON LOS REQUISITOS PARA SU OPERACIÓN', '228004'),
('220501035', 'APLICAR BUENAS PRÁCTICAS DE CALIDAD EN EL PROCESO DE DESARROLLO DE SOFTWARE, DE ACUERDO CON EL REFERENTE ADOPTADO EN LA EMPRES', '228004'),
('240201500', 'PROMOVER LA INTERACCIÓN IDÓNEA CONSIGO MISMO, CON LOS DEMÁS Y CON LA NATURALEZA EN LOS CONTEXTOS LABORAL Y SOCIAL', '228004'),
('240201501', 'COMPRENDER TEXTOS EN INGLÉS EN FORMA ESCRITA Y AUDITIVA', '228004'),
('240201502', 'PRODUCIR TEXTOS EN INGLÉS EN FORMA ESCRITA Y ORAL', '228004'),
('264861785', 'ANALISTAS DE SISTEMAS INFORMÁTICOS', '228004'),
('569423654', 'APLICAR EN LA RESOLUCIÓN DE PROBLEMAS REALES DEL SECTOR PRODUCTIVO, LOS CONOCIMIENTOS, HABILIDADES Y DESTREZAS PERTINENTES A LAS COMPETENCIAS', '228004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `documentNumber` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `secondName` varchar(50) DEFAULT NULL,
  `firstLastName` varchar(50) NOT NULL,
  `secondLastName` varchar(50) DEFAULT NULL,
  `documentName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`documentNumber`, `firstName`, `secondName`, `firstLastName`, `secondLastName`, `documentName`) VALUES
('1013677903', 'ivan', 'felipe ', 'torres', 'gomez', 'CC'),
('1018511671', 'brandon', 'daniel', 'martinez', 'diaz', 'CC'),
('1022997832', 'Juan', 'Pablo', 'Coronado', 'Ramirez', 'CC'),
('1023922643', 'julian', 'david', 'lasso', 'aguilar', 'CC'),
('9626587412', 'jhon', 'carlos', 'sierra', 'morena', 'CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer_has_role`
--

CREATE TABLE `customer_has_role` (
  `statusCustomerRole` tinyint(1) NOT NULL,
  `terminationDate` date NOT NULL,
  `documentNumber` varchar(50) NOT NULL,
  `documentName` varchar(50) NOT NULL,
  `roleId` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `customer_has_role`
--

INSERT INTO `customer_has_role` (`statusCustomerRole`, `terminationDate`, `documentNumber`, `documentName`, `roleId`) VALUES
(1, '2018-09-26', '1018511671', 'CC', '4'),
(1, '2018-02-12', '1022997832', 'CC', '1'),
(1, '2018-03-12', '1022997832', 'CC', '2'),
(1, '2018-03-12', '1022997832', 'CC', '3'),
(1, '2018-03-12', '1022997832', 'CC', '4'),
(1, '2018-09-26', '1023922643', 'CC', '3'),
(0, '2018-09-26', '9626587412', 'CC', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documenttype`
--

CREATE TABLE `documenttype` (
  `documentName` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `statusDocType` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documenttype`
--

INSERT INTO `documenttype` (`documentName`, `description`, `statusDocType`) VALUES
('CC', 'Cédula de Ciudadania', 1),
('CE', 'Cédula de Extranjería', 1),
('DNI', 'Documento Nacional de Identificacion', 1),
('NIT', 'Numero de Identificación Tributaria', 1),
('PAS', 'Pasaporte', 1),
('TT', 'Tarjeta de Identidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `fichaNumber` varchar(20) NOT NULL,
  `statusf` tinyint(1) NOT NULL,
  `programCode_version` varchar(15) NOT NULL,
  `workingDayName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`fichaNumber`, `statusf`, `programCode_version`, `workingDayName`) VALUES
('1111', 1, '1', 'Noche'),
('1262154', 1, '1', 'Diurno'),
('1262155', 1, '228005', 'Diurno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichahaschecklist`
--

CREATE TABLE `fichahaschecklist` (
  `fichaNumber` varchar(20) NOT NULL,
  `listId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fichahaschecklist`
--

INSERT INTO `fichahaschecklist` (`fichaNumber`, `listId`) VALUES
('1262154', '1'),
('1262155', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichainstructor`
--

CREATE TABLE `fichainstructor` (
  `documentNumber` varchar(50) NOT NULL,
  `documentName` varchar(50) NOT NULL,
  `fichaNumber` varchar(20) NOT NULL,
  `trimesterId` varchar(20) NOT NULL,
  `workingDayName` varchar(40) NOT NULL,
  `idLevelTraining` varchar(40) NOT NULL,
  `insTypeId` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fichainstructor`
--

INSERT INTO `fichainstructor` (`documentNumber`, `documentName`, `fichaNumber`, `trimesterId`, `workingDayName`, `idLevelTraining`, `insTypeId`) VALUES
('1022997832', 'CC', '1262154', '1', 'mañana', '1', 'precensial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formationstatus`
--

CREATE TABLE `formationstatus` (
  `statusId` varchar(45) NOT NULL,
  `statusF` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `formationstatus`
--

INSERT INTO `formationstatus` (`statusId`, `statusF`) VALUES
('Activo', 1),
('Inactivo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generalobservation`
--

CREATE TABLE `generalobservation` (
  `observationId` int(11) NOT NULL,
  `observation` text NOT NULL,
  `jury` text,
  `dateGO` datetime NOT NULL,
  `userGO` varchar(150) NOT NULL,
  `fichaNumber` varchar(20) NOT NULL,
  `groupCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groupanswer`
--

CREATE TABLE `groupanswer` (
  `dateG` datetime DEFAULT NULL,
  `fichaNumber` varchar(20) NOT NULL,
  `groupCode` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `listId` varchar(45) NOT NULL,
  `valueV` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructortype`
--

CREATE TABLE `instructortype` (
  `insTypeId` varchar(30) NOT NULL,
  `statusI` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `instructortype`
--

INSERT INTO `instructortype` (`insTypeId`, `statusI`) VALUES
('Fines de Semana', 1),
('precensial', 1),
('Virtual', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `learningresult`
--

CREATE TABLE `learningresult` (
  `codeL` varchar(40) NOT NULL,
  `denomination` tinytext NOT NULL,
  `codeC` varchar(15) NOT NULL,
  `programCode_version` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `learningresult`
--

INSERT INTO `learningresult` (`codeL`, `denomination`, `codeC`, `programCode_version`) VALUES
('220501006', 'Capacitar a los usuarios del sistema, sobre la estructuración y el manejo del aplicativo,  de acuerdo con el plan establecido, el perfil de los usuarios, según políticas de la organización', '220501006', '228004'),
('220501006', 'Elaborar informes técnicos relacionados con la solución informática implantada, de acuerdo con las propuestas de alternativas aplicadas, teniendo en cuenta las técnicas de comunicación y según normas y protocolos establecidos', '220501007', '228004'),
('220501006', 'Interpretar el diagnóstico de necesidades informáticas, para determinar las tecnológicas requeridas en el manejo de la información, de acuerdo con las normas y protocolos establecidos por la empresa', '220501009', '228004'),
('220501032', 'Definir estrategias para la elaboración de términos de referencia y procesos de evaluación de proveedores, en la adquisición de tecnología, según protocolos establecidos', '220501032', '228004'),
('220501032', 'Participar en los perfeccionamientos de contratos informáticos, estableciendo cláusulas técnicas, que respondan a las necesidades de los actores de la negociación, de acuerdo con la ley de contratación', '220501033', '228004'),
('220501032', 'Elaborar el informe sobre el cumplimiento de los términos de referencia previstos en la negociación, de acuerdo con la participación de cada uno de los actores en relación con la satisfacción de los bienes informáticos contratados y recibidos, según norma', '220501035', '228004'),
('220501032', 'Comunicarse en tareas sencillas y habituales que requieren un intercambio simple y directo de información cotidiana y técnica', '240201500', '228004'),
('220501032', 'Buscar de manera sistemática información específica y detallada en escritos en inglés, mas estructurados y con mayor contenido técnico', '240201501', '228004'),
('220501033', 'Elementos técnicos del proyecto (análisis de objetos)-elementos comerciales del proyecto (marketing)-elementos financieros del proyecto (ingresos, costos y gastos)', '264861785', '228004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `learningresulthastrimester`
--

CREATE TABLE `learningresulthastrimester` (
  `codeL` varchar(40) NOT NULL,
  `codeC` varchar(15) NOT NULL,
  `programCode_version` varchar(15) NOT NULL,
  `trimesterId` varchar(20) NOT NULL,
  `workingDayName` varchar(40) NOT NULL,
  `idLevelTraining` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leveltraining`
--

CREATE TABLE `leveltraining` (
  `idLevelTraining` varchar(40) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `leveltraining`
--

INSERT INTO `leveltraining` (`idLevelTraining`, `descripcion`, `state`) VALUES
('1', 'tecnologo', 1),
('2', 'Tecnico', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listitem`
--

CREATE TABLE `listitem` (
  `itemId` int(11) NOT NULL,
  `itemQuestion` varchar(100) NOT NULL,
  `codeL` varchar(40) NOT NULL,
  `codeC` varchar(15) NOT NULL,
  `programCode_version` varchar(15) NOT NULL,
  `listId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `listitem`
--

INSERT INTO `listitem` (`itemId`, `itemQuestion`, `codeL`, `codeC`, `programCode_version`, `listId`) VALUES
(1, 'Rae1', '220501006', '220501006', '228004', '1'),
(2, 'Rae2', '220501006', '220501007', '228004', '1'),
(3, 'Rae3', '220501006', '220501009', '228004', '1'),
(4, 'Rae4', '220501032', '220501032', '228004', '1'),
(5, 'Rae5', '220501032', '220501033', '228004', '1'),
(6, 'Rae6', '220501032', '220501035', '228004', '1'),
(7, 'Rae7', '220501032', '240201500', '228004', '1'),
(8, 'Rae8', '220501032', '240201501', '228004', '1'),
(9, 'Rae9', '220501033', '264861785', '228004', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mailserver`
--

CREATE TABLE `mailserver` (
  `mailUser` varchar(100) NOT NULL,
  `passwordMS` varchar(64) NOT NULL,
  `smtpPort` int(11) NOT NULL,
  `smtpSslTrust` varchar(50) NOT NULL,
  `smtpStarttlsEnable` tinyint(1) NOT NULL,
  `smtpAuoth` tinyint(1) NOT NULL,
  `issueRecuperation` varchar(50) NOT NULL,
  `recuperationMessage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observationitem`
--

CREATE TABLE `observationitem` (
  `observationId` int(11) NOT NULL,
  `observation` text NOT NULL,
  `jury` text,
  `dateOI` datetime NOT NULL,
  `userOI` varchar(150) NOT NULL,
  `fichaNumber` varchar(20) NOT NULL,
  `groupCode` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `listId` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `program`
--

CREATE TABLE `program` (
  `programCode_version` varchar(15) NOT NULL,
  `programName` varchar(100) NOT NULL,
  `programStatusID` varchar(40) NOT NULL,
  `idLevelTraining` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `program`
--

INSERT INTO `program` (`programCode_version`, `programName`, `programStatusID`, `idLevelTraining`) VALUES
('1', 'Programacion', 'Activo', '1'),
('228004', 'ADSI', 'Activo', '2'),
('228005', 'DIM', 'Activo', '2'),
('228006', 'MEI', 'Activo', '2'),
('228007', 'CMI', 'Activo', '1'),
('228008', 'TPS', 'Activo', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programstatus`
--

CREATE TABLE `programstatus` (
  `programStatusID` varchar(40) NOT NULL,
  `idStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programstatus`
--

INSERT INTO `programstatus` (`programStatusID`, `idStatus`) VALUES
('Activo', 1),
('Inactivo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projectgroup`
--

CREATE TABLE `projectgroup` (
  `statusP` tinyint(1) NOT NULL,
  `proyectName` varchar(100) NOT NULL,
  `fichaNumber` varchar(20) NOT NULL,
  `groupCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `projectgroup`
--

INSERT INTO `projectgroup` (`statusP`, `proyectName`, `fichaNumber`, `groupCode`) VALUES
(1, 'SOSP', '1262154', 1),
(1, 'PROYECTO2', '1262154', 2),
(1, 'WPT', '1262154', 3),
(1, 'PSI', '1262154', 4),
(1, 'PSSP', '1262154', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `roleId` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL,
  `statusRole` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`roleId`, `description`, `statusRole`) VALUES
('1', 'Administrador', 1),
('2', 'Instructor', 1),
('3', 'Jurado', 1),
('4', 'Aprendiz', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trimester`
--

CREATE TABLE `trimester` (
  `trimesterId` varchar(20) NOT NULL,
  `workingDayName` varchar(40) NOT NULL,
  `idLevelTraining` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trimester`
--

INSERT INTO `trimester` (`trimesterId`, `workingDayName`, `idLevelTraining`) VALUES
('1', 'Fin de Semana', '1'),
('1', 'Fin de Semana', '2'),
('1', 'mañana', '1'),
('2', 'mañana', '1'),
('3', 'mañana', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `mail` varchar(100) NOT NULL,
  `passwordUser` varchar(64) NOT NULL,
  `photo` longblob,
  `documentName` varchar(50) NOT NULL,
  `documentNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`mail`, `passwordUser`, `photo`, `documentName`, `documentNumber`) VALUES
('iftorres30@misena.edu.co', '123', 0x313631363137506570655f4772696c6c6f2e706e67, 'CC', '1013677903'),
('bdmartinez62@misena.edu.co', '123', 0x313631363338646f6e6e69652e6a7067, 'CC', '1018511671'),
('jpcoronado23@misena.edu.co', '123', 0x30303033332d2d2d36613739623635663535636262663038636431336666383737396666313936392e6a7067, 'CC', '1022997832'),
('jdlasso-aguilar@misena.edu.co', '123', 0x313631363230, 'CC', '1023922643'),
('jhoncar@misena.edu.co', '123', 0x313631363434616e73656c6d6f2e6a666966, 'CC', '9626587412');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoration`
--

CREATE TABLE `valoration` (
  `valueV` varchar(30) NOT NULL,
  `statusV` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valoration`
--

INSERT INTO `valoration` (`valueV`, `statusV`) VALUES
('Cumple', 1),
('Cumple Con Requisitos', 1),
('No cumple', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workingday`
--

CREATE TABLE `workingday` (
  `workingDayName` varchar(40) NOT NULL,
  `statusW` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `workingday`
--

INSERT INTO `workingday` (`workingDayName`, `statusW`, `description`) VALUES
('Diurno', '1', '6Am A 6pM'),
('Fin de Semana', '1', 'Sabados y domingos'),
('mañana', '1', '6Am A 6pM'),
('Noche', '1', '6Pm - 10Pm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apprentice`
--
ALTER TABLE `apprentice`
  ADD PRIMARY KEY (`documentNumber`,`documentName`,`fichaNumber`,`groupCode`),
  ADD KEY `formationStatus_apprentice` (`statusId`),
  ADD KEY `customer_apprentice` (`documentName`,`documentNumber`),
  ADD KEY `projectGroup_apprentice` (`fichaNumber`,`groupCode`);

--
-- Indices de la tabla `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`listId`,`programCode_version`),
  ADD KEY `program_checkList` (`programCode_version`);

--
-- Indices de la tabla `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`codeC`,`programCode_version`),
  ADD KEY `program_competence` (`programCode_version`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`documentNumber`,`documentName`),
  ADD KEY `documentType_customer` (`documentName`);

--
-- Indices de la tabla `customer_has_role`
--
ALTER TABLE `customer_has_role`
  ADD PRIMARY KEY (`documentNumber`,`documentName`,`roleId`),
  ADD KEY `customer_customer_has_role` (`documentName`,`documentNumber`),
  ADD KEY `role_customer_has_role` (`roleId`);

--
-- Indices de la tabla `documenttype`
--
ALTER TABLE `documenttype`
  ADD PRIMARY KEY (`documentName`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`fichaNumber`),
  ADD KEY `program_ficha` (`programCode_version`),
  ADD KEY `workingDay_projectGroup` (`workingDayName`);

--
-- Indices de la tabla `fichahaschecklist`
--
ALTER TABLE `fichahaschecklist`
  ADD PRIMARY KEY (`fichaNumber`,`listId`),
  ADD KEY `checkList_fichaHasCheckList` (`listId`);

--
-- Indices de la tabla `fichainstructor`
--
ALTER TABLE `fichainstructor`
  ADD PRIMARY KEY (`documentNumber`,`documentName`,`fichaNumber`,`trimesterId`,`workingDayName`,`insTypeId`,`idLevelTraining`),
  ADD KEY `ficha_fichaInstructor` (`fichaNumber`),
  ADD KEY `trimester_fichaInstructor` (`trimesterId`,`workingDayName`,`idLevelTraining`),
  ADD KEY `instructorType_fichaInstructor` (`insTypeId`);

--
-- Indices de la tabla `formationstatus`
--
ALTER TABLE `formationstatus`
  ADD PRIMARY KEY (`statusId`);

--
-- Indices de la tabla `generalobservation`
--
ALTER TABLE `generalobservation`
  ADD PRIMARY KEY (`observationId`,`fichaNumber`,`groupCode`),
  ADD KEY `projectGroup_generalObservation` (`fichaNumber`,`groupCode`);

--
-- Indices de la tabla `groupanswer`
--
ALTER TABLE `groupanswer`
  ADD PRIMARY KEY (`fichaNumber`,`groupCode`,`itemId`,`listId`),
  ADD KEY `listItem_groupAnswer` (`itemId`,`listId`),
  ADD KEY `valoration_groupAnswer` (`valueV`);

--
-- Indices de la tabla `instructortype`
--
ALTER TABLE `instructortype`
  ADD PRIMARY KEY (`insTypeId`);

--
-- Indices de la tabla `learningresult`
--
ALTER TABLE `learningresult`
  ADD PRIMARY KEY (`codeL`,`codeC`,`programCode_version`),
  ADD KEY `competence_learningResult` (`codeC`,`programCode_version`);

--
-- Indices de la tabla `learningresulthastrimester`
--
ALTER TABLE `learningresulthastrimester`
  ADD PRIMARY KEY (`codeL`,`codeC`,`programCode_version`,`trimesterId`,`workingDayName`,`idLevelTraining`),
  ADD KEY `trimester_learningResultHasTrimester` (`trimesterId`,`workingDayName`,`idLevelTraining`);

--
-- Indices de la tabla `leveltraining`
--
ALTER TABLE `leveltraining`
  ADD PRIMARY KEY (`idLevelTraining`);

--
-- Indices de la tabla `listitem`
--
ALTER TABLE `listitem`
  ADD PRIMARY KEY (`itemId`,`listId`),
  ADD KEY `learningResult_listItem` (`codeL`,`codeC`,`programCode_version`),
  ADD KEY `checkList_listItem` (`listId`);

--
-- Indices de la tabla `mailserver`
--
ALTER TABLE `mailserver`
  ADD PRIMARY KEY (`mailUser`);

--
-- Indices de la tabla `observationitem`
--
ALTER TABLE `observationitem`
  ADD PRIMARY KEY (`observationId`,`itemId`,`listId`,`fichaNumber`,`groupCode`),
  ADD KEY `groupAnswer_observationItem` (`itemId`,`listId`,`fichaNumber`,`groupCode`);

--
-- Indices de la tabla `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`programCode_version`),
  ADD KEY `programStatus_program` (`programStatusID`),
  ADD KEY `LevelTraining_program` (`idLevelTraining`);

--
-- Indices de la tabla `programstatus`
--
ALTER TABLE `programstatus`
  ADD PRIMARY KEY (`programStatusID`);

--
-- Indices de la tabla `projectgroup`
--
ALTER TABLE `projectgroup`
  ADD PRIMARY KEY (`groupCode`,`fichaNumber`),
  ADD KEY `ficha_projectGroup` (`fichaNumber`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleId`);

--
-- Indices de la tabla `trimester`
--
ALTER TABLE `trimester`
  ADD PRIMARY KEY (`trimesterId`,`workingDayName`,`idLevelTraining`),
  ADD KEY `workingday_trimester` (`workingDayName`),
  ADD KEY `LevelTraining_trimester` (`idLevelTraining`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`documentName`,`documentNumber`);

--
-- Indices de la tabla `valoration`
--
ALTER TABLE `valoration`
  ADD PRIMARY KEY (`valueV`);

--
-- Indices de la tabla `workingday`
--
ALTER TABLE `workingday`
  ADD PRIMARY KEY (`workingDayName`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apprentice`
--
ALTER TABLE `apprentice`
  ADD CONSTRAINT `customer_apprentice` FOREIGN KEY (`documentName`,`documentNumber`) REFERENCES `customer` (`documentName`, `documentNumber`),
  ADD CONSTRAINT `formationStatus_apprentice` FOREIGN KEY (`statusId`) REFERENCES `formationstatus` (`statusId`),
  ADD CONSTRAINT `projectGroup_apprentice` FOREIGN KEY (`fichaNumber`,`groupCode`) REFERENCES `projectgroup` (`fichaNumber`, `groupCode`);

--
-- Filtros para la tabla `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `program_checkList` FOREIGN KEY (`programCode_version`) REFERENCES `program` (`programCode_version`);

--
-- Filtros para la tabla `competence`
--
ALTER TABLE `competence`
  ADD CONSTRAINT `program_competence` FOREIGN KEY (`programCode_version`) REFERENCES `program` (`programCode_version`);

--
-- Filtros para la tabla `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `documentType_customer` FOREIGN KEY (`documentName`) REFERENCES `documenttype` (`documentName`);

--
-- Filtros para la tabla `customer_has_role`
--
ALTER TABLE `customer_has_role`
  ADD CONSTRAINT `customer_customer_has_role` FOREIGN KEY (`documentName`,`documentNumber`) REFERENCES `customer` (`documentName`, `documentNumber`),
  ADD CONSTRAINT `role_customer_has_role` FOREIGN KEY (`roleId`) REFERENCES `role` (`roleId`);

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `program_ficha` FOREIGN KEY (`programCode_version`) REFERENCES `program` (`programCode_version`),
  ADD CONSTRAINT `workingDay_projectGroup` FOREIGN KEY (`workingDayName`) REFERENCES `workingday` (`workingDayName`);

--
-- Filtros para la tabla `fichahaschecklist`
--
ALTER TABLE `fichahaschecklist`
  ADD CONSTRAINT `checkList_fichaHasCheckList` FOREIGN KEY (`listId`) REFERENCES `checklist` (`listId`),
  ADD CONSTRAINT `ficha_fichaHasCheckList` FOREIGN KEY (`fichaNumber`) REFERENCES `ficha` (`fichaNumber`);

--
-- Filtros para la tabla `fichainstructor`
--
ALTER TABLE `fichainstructor`
  ADD CONSTRAINT `customer_fichaInstructor` FOREIGN KEY (`documentNumber`,`documentName`) REFERENCES `customer` (`documentNumber`, `documentName`),
  ADD CONSTRAINT `ficha_fichaInstructor` FOREIGN KEY (`fichaNumber`) REFERENCES `ficha` (`fichaNumber`),
  ADD CONSTRAINT `instructorType_fichaInstructor` FOREIGN KEY (`insTypeId`) REFERENCES `instructortype` (`insTypeId`),
  ADD CONSTRAINT `trimester_fichaInstructor` FOREIGN KEY (`trimesterId`,`workingDayName`,`idLevelTraining`) REFERENCES `trimester` (`trimesterId`, `workingDayName`, `idLevelTraining`);

--
-- Filtros para la tabla `generalobservation`
--
ALTER TABLE `generalobservation`
  ADD CONSTRAINT `projectGroup_generalObservation` FOREIGN KEY (`fichaNumber`,`groupCode`) REFERENCES `projectgroup` (`fichaNumber`, `groupCode`);

--
-- Filtros para la tabla `groupanswer`
--
ALTER TABLE `groupanswer`
  ADD CONSTRAINT `listItem_groupAnswer` FOREIGN KEY (`itemId`,`listId`) REFERENCES `listitem` (`itemId`, `listId`),
  ADD CONSTRAINT `projectGroup_groupAnswer` FOREIGN KEY (`fichaNumber`,`groupCode`) REFERENCES `projectgroup` (`fichaNumber`, `groupCode`),
  ADD CONSTRAINT `valoration_groupAnswer` FOREIGN KEY (`valueV`) REFERENCES `valoration` (`valueV`);

--
-- Filtros para la tabla `learningresult`
--
ALTER TABLE `learningresult`
  ADD CONSTRAINT `competence_learningResult` FOREIGN KEY (`codeC`,`programCode_version`) REFERENCES `competence` (`codeC`, `programCode_version`);

--
-- Filtros para la tabla `learningresulthastrimester`
--
ALTER TABLE `learningresulthastrimester`
  ADD CONSTRAINT `learningResult_learningResultHasTrimester` FOREIGN KEY (`codeL`,`codeC`,`programCode_version`) REFERENCES `learningresult` (`codeL`, `codeC`, `programCode_version`),
  ADD CONSTRAINT `trimester_learningResultHasTrimester` FOREIGN KEY (`trimesterId`,`workingDayName`,`idLevelTraining`) REFERENCES `trimester` (`trimesterId`, `workingDayName`, `idLevelTraining`);

--
-- Filtros para la tabla `listitem`
--
ALTER TABLE `listitem`
  ADD CONSTRAINT `checkList_listItem` FOREIGN KEY (`listId`) REFERENCES `checklist` (`listId`),
  ADD CONSTRAINT `learningResult_listItem` FOREIGN KEY (`codeL`,`codeC`,`programCode_version`) REFERENCES `learningresult` (`codeL`, `codeC`, `programCode_version`);

--
-- Filtros para la tabla `observationitem`
--
ALTER TABLE `observationitem`
  ADD CONSTRAINT `groupAnswer_observationItem` FOREIGN KEY (`itemId`,`listId`,`fichaNumber`,`groupCode`) REFERENCES `groupanswer` (`itemId`, `listId`, `fichaNumber`, `groupCode`);

--
-- Filtros para la tabla `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `LevelTraining_program` FOREIGN KEY (`idLevelTraining`) REFERENCES `leveltraining` (`idLevelTraining`),
  ADD CONSTRAINT `programStatus_program` FOREIGN KEY (`programStatusID`) REFERENCES `programstatus` (`programStatusID`);

--
-- Filtros para la tabla `projectgroup`
--
ALTER TABLE `projectgroup`
  ADD CONSTRAINT `ficha_projectGroup` FOREIGN KEY (`fichaNumber`) REFERENCES `ficha` (`fichaNumber`);

--
-- Filtros para la tabla `trimester`
--
ALTER TABLE `trimester`
  ADD CONSTRAINT `LevelTraining_trimester` FOREIGN KEY (`idLevelTraining`) REFERENCES `leveltraining` (`idLevelTraining`),
  ADD CONSTRAINT `workingday_trimester` FOREIGN KEY (`workingDayName`) REFERENCES `workingday` (`workingDayName`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `customer_users` FOREIGN KEY (`documentName`,`documentNumber`) REFERENCES `customer` (`documentName`, `documentNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
