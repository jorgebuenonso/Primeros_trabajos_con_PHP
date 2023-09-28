-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2018 a las 16:33:12
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pufosa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `CLIENTE_ID` decimal(6,0) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `Direccion` varchar(40) DEFAULT NULL,
  `Ciudad` varchar(30) DEFAULT NULL,
  `Estado` varchar(2) DEFAULT NULL,
  `CodigoPostal` varchar(9) DEFAULT NULL,
  `CodigoDeArea` decimal(3,0) DEFAULT NULL,
  `Telefono` decimal(7,0) DEFAULT NULL,
  `Vendedor_ID` decimal(4,0) DEFAULT NULL,
  `Limite_De_Credito` decimal(9,2) DEFAULT NULL,
  `Comentarios` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`CLIENTE_ID`, `nombre`, `Direccion`, `Ciudad`, `Estado`, `CodigoPostal`, `CodigoDeArea`, `Telefono`, `Vendedor_ID`, `Limite_De_Credito`, `Comentarios`) VALUES
('100', 'JOCKSPORTS', '345 VIEWRIDGE', 'BELMONT', 'CA', '96711', '415', '5986609', '7844', '5000.00', 'Very friendly people to work with -- sales rep likes to be called Mike.'),
('101', 'TKB SPORT SHOP', '490 BOLI RD.', 'REDWOOD Ciudad', 'CA', '94061', '415', '3681223', '7521', '10000.00', 'Rep called 5/8 about change in order - contact shipping.'),
('102', 'VOLLYRITE', '9722 HAMILTON', 'BURLINGAME', 'CA', '95133', '415', '6443341', '7654', '7000.00', 'Company doing heavy promotion beginning 10/89. Prepare for large orders during winter.'),
('103', 'JUST TENNIS', 'HILLVIEW MALL', 'BURLINGAME', 'CA', '97544', '415', '6779312', '7521', '3000.00', 'Contact rep about new line of tennis rackets.'),
('104', 'EVERY MOUNTAIN', '574 SURRY RD.', 'CUPERTINO', 'CA', '93301', '408', '9962323', '7499', '10000.00', 'CLIENTE with high market share (23%) due to aggressive advertising.'),
('105', 'K + T SPORTS', '3476 EL PASEO', 'SANTA CLARA', 'CA', '91003', '408', '3769966', '7844', '5000.00', 'Tends to order large amounts of merchandise at once. Accounting is considering raising their credit limit. Usually pays on time.'),
('106', 'SHAPE UP', '908 SEQUOIA', 'PALO ALTO', 'CA', '94301', '415', '3649777', '7521', '6000.00', 'Support intensive. Orders small amounts (< 800) of merchandise at a time.'),
('107', 'WOMENS SPORTS', 'VALCO VILLAGE', 'SUNNYVALE', 'CA', '93301', '408', '9674398', '7499', '10000.00', 'First sporting goods store geared exclusively towards women. Unusual promotional style and very willing to take chances towards new Productos!'),
('108', 'NORTH WOODS HEALTH AND FITNESS SUPPLY CENTER', '98 LONE PINE WAY', 'HIBBING', 'MN', '55649', '612', '5669123', '7844', '8000.00', ''),
('201', 'STADIUM SPORTS', '47 IRVING PL.', 'NEW YORK', 'NY', '10003', '212', '5555335', '7557', '10000.00', 'Large general-purpose sports store with an affluent CLIENTE base.'),
('202', 'HOOPS', '2345 ADAMS AVE.', 'LEICESTER', 'MA', '01524', '508', '5557542', '7820', '5000.00', 'Specializes in basketball equipment.'),
('203', 'REBOUND SPORTS', '2 E. 14TH ST.', 'NEW YORK', 'NY', '10009', '212', '5555989', '7557', '10000.00', 'Follow up on the promotion proposal.'),
('204', 'THE POWER FORWARD', '1 KNOTS LANDING', 'DALLAS', 'TX', '75248', '214', '5550505', '7560', '12000.00', 'Large floorspace.  Prefers maintaining large amounts of inventory on hand.'),
('205', 'POINT GUARD', '20 THURSTON ST.', 'YONKERS', 'NY', '10956', '914', '5554766', '7557', '3000.00', 'Tremendous potential for an exclusive agreement.'),
('206', 'THE COLISEUM', '5678 WILBUR PL.', 'SCARSDALE', 'NY', '10583', '914', '5550217', '7557', '6000.00', 'Contact rep. about new Producto lines.'),
('207', 'FAST BREAK', '1000 HERBERT LN.', 'CONCORD', 'MA', '01742', '508', '5551298', '7820', '7000.00', 'CLIENTE requires written price quotes before making purchase requisitions.'),
('208', 'AL AND BOB\'S SPORTS', '260 YORKTOWN CT.', 'AUSTIN', 'TX', '78731', '512', '5557631', '7560', '4000.00', 'Very personal purchasing agents -- Sharon and Scott.'),
('211', 'AT BAT', '234 BEACHEM ST.', 'BROOKLINE', 'MA', '02146', '617', '5557385', '7820', '8000.00', 'Have an open purchase order for $3000.  Ship immediately on request.'),
('212', 'ALL SPORT', '1000 38TH ST.', 'BROOKLYN', 'NY', '11210', '718', '5551739', '7600', '6000.00', 'Pursue a contract -- possible candidate for volume purchasing agreements.'),
('213', 'GOOD SPORT', '400 46TH ST.', 'SUNNYSIDE', 'NY', '11104', '718', '5553771', '7600', '5000.00', 'May be moving to a larger Ubicacion.'),
('214', 'AL\'S PRO SHOP', '45 SPRUCE ST.', 'SPRING', 'TX', '77388', '713', '5555172', '7564', '8000.00', 'Target market is serious athletes.'),
('215', 'BOB\'S FAMILY SPORTS', '400 E. 23RD', 'HOUSTON', 'TX', '77026', '713', '5558015', '7654', '8000.00', 'Target market is casual and weekend athletes.  Offers a large selection.'),
('216', 'THE ALL AMERICAN', '547 PRENTICE RD.', 'CHELSEA', 'MA', '02150', '617', '5553047', '7820', '5000.00', 'CLIENTE prefers to be called between 10 and 12.'),
('217', 'HIT, THROW, AND RUN', '333 WOOD COURT', 'GRAPEVINE', 'TX', '76051', '817', '5552352', '7564', '6000.00', 'General purpose sports store.'),
('218', 'THE OUTFIELD', '346 GARDEN BLVD.', 'FLUSHING', 'NY', '11355', '718', '5552131', '7820', '4000.00', 'Store does not open until 11am and does not have an answering service.'),
('221', 'WHEELS AND DEALS', '2 MEMORIAL DRIVE', 'HOUSTON', 'TX', '77007', '713', '5554139', '7789', '10000.00', 'Discount bicycle and sporting good store.'),
('222', 'JUST BIKES', '4000 PARKRIDGE BLVD.', 'DALLAS', 'TX', '75205', '214', '5558735', '7789', '4000.00', 'Exclusive bicycle dealer.'),
('223', 'VELO SPORTS', '23 WHITE ST.', 'MALDEN', 'MA', '02148', '617', '5554983', '7820', '5000.00', 'Clerk answers all phone lines.  Ask for Mike.'),
('224', 'JOE\'S BIKE SHOP', '4500 FOX COURT', 'GRAND PRARIE', 'TX', '75051', '214', '5559834', '7789', '6000.00', 'Call Joe to make sure last shipment was complete.'),
('225', 'BOB\'S SWIM, CYCLE, AND RUN', '300 HORSECREEK CIRCLE', 'IRVING', 'TX', '75039', '214', '5558388', '7789', '7000.00', 'Store catering to triathletes.'),
('226', 'CENTURY SHOP', '8 DAGMAR DR.', 'HUNTINGTON', 'NY', '11743', '516', '5553006', '7555', '4000.00', 'CLIENTE in the midst of a cost-cutting program.'),
('227', 'THE TOUR', '2500 GARDNER RD.', 'SOMERVILLE', 'MA', '02144', '617', '5556673', '7820', '5000.00', 'CLIENTE referred to us by The All American.'),
('228', 'FITNESS FIRST', '5000 85TH ST.', 'JACKSON HEIGHTS', 'NY', '11372', '718', '5558710', '7555', '4000.00', 'Recently acquired another sporting goods store.  Expect higher volume in the future.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `departamento_ID` decimal(2,0) NOT NULL,
  `Nombre` varchar(14) DEFAULT NULL,
  `Ubicacion_ID` decimal(3,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`departamento_ID`, `Nombre`, `Ubicacion_ID`) VALUES
('10', 'contabilidad', '122'),
('12', 'Investigacion', '122'),
('13', 'Ventas', '122'),
('14', 'Operaciones', '122'),
('20', 'Investigacion', '124'),
('23', 'Ventas', '124'),
('24', 'Operaciones', '124'),
('30', 'Ventas', '123'),
('34', 'Operaciones', '123'),
('40', 'Operaciones', '167'),
('43', 'ventas', '167');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `empleado_ID` decimal(4,0) NOT NULL,
  `Apellido` varchar(15) DEFAULT NULL,
  `Nombre` varchar(15) DEFAULT NULL,
  `Inicial_del_segundo_apellido` varchar(1) DEFAULT NULL,
  `Trabajo_ID` decimal(3,0) DEFAULT NULL,
  `Jefe_ID` decimal(4,0) DEFAULT NULL,
  `Fecha_contrato` date DEFAULT NULL,
  `Salario` decimal(7,2) DEFAULT NULL,
  `Comision` decimal(7,2) DEFAULT NULL,
  `Departamento_ID` decimal(2,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`empleado_ID`, `Apellido`, `Nombre`, `Inicial_del_segundo_apellido`, `Trabajo_ID`, `Jefe_ID`, `Fecha_contrato`, `Salario`, `Comision`, `Departamento_ID`) VALUES
('7369', 'SMITH', 'Juan', 'Q', '667', '7902', NULL, '800.00', NULL, '20'),
('7499', 'ALLEN', 'KEVIN', 'J', '670', '7698', NULL, '1600.00', '300.00', '30'),
('7505', 'DOYLE', 'JEAN', 'K', '671', '7839', NULL, '2850.00', NULL, '13'),
('7506', 'DENNIS', 'LYNN', 'S', '671', '7839', NULL, '2750.00', NULL, '23'),
('7507', 'BAKER', 'LESLIE', 'D', '671', '7839', NULL, '2200.00', NULL, '14'),
('7521', 'WARD', 'CYNTHIA', 'D', '670', '7698', NULL, '1250.00', '500.00', '30'),
('7555', 'PETERS', 'DANIEL', 'T', '670', '7505', NULL, '1250.00', '300.00', '13'),
('7557', 'SHAW', 'KAREN', 'P', '670', '7505', NULL, '1250.00', '1200.00', '13'),
('7560', 'DUNCAN', 'SARAH', 'S', '670', '7506', NULL, '1250.00', NULL, '23'),
('7564', 'LANGE', 'GREGORY', 'J', '670', '7506', NULL, '1250.00', '300.00', '23'),
('7566', 'JONES', 'TERRY', 'M', '671', '7839', NULL, '2975.00', NULL, '20'),
('7569', 'ALBERTS', 'CHRIS', 'L', '671', '7839', NULL, '3000.00', NULL, '12'),
('7600', 'PORTER', 'RAYMOND', 'Y', '670', '7505', NULL, '1250.00', '900.00', '13'),
('7609', 'LEWIS', 'RICHARD', 'M', '668', '7507', NULL, '1800.00', NULL, '24'),
('7654', 'MARTIN', 'KENNETH', 'J', '670', '7698', NULL, '1250.00', '1400.00', '30'),
('7676', 'SOMMERS', 'DENISE', 'D', '668', '7507', NULL, '1850.00', NULL, '34'),
('7698', 'BLAKE', 'MARION', 'S', '671', '7839', NULL, '2850.00', NULL, '30'),
('7782', 'CLARK', 'CAROL', 'F', '671', '7839', NULL, '2450.00', NULL, '10'),
('7788', 'SCOTT', 'DARIO', 'T', '669', '7566', NULL, '3000.00', NULL, '20'),
('7789', 'WEST', 'LIVIA', 'N', '670', '7506', NULL, '1500.00', '1000.00', '23'),
('7799', 'FISHER', 'MATTHEW', 'G', '669', '7569', NULL, '3000.00', NULL, '12'),
('7820', 'ROSS', 'PAUL', 'S', '670', '7505', NULL, '1300.00', '800.00', '43'),
('7839', 'KING', 'FRANCIS', 'A', '672', NULL, NULL, '5000.00', NULL, '10'),
('7844', 'TURNER', 'MARY', 'A', '670', '7698', NULL, '1500.00', '0.00', '30'),
('7876', 'ADAMS', 'DIANE', 'G', '667', '7788', NULL, '1100.00', NULL, '20'),
('7900', 'JAMES', 'FRED', 'S', '667', '7698', NULL, '950.00', NULL, '30'),
('7902', 'FORD', 'JENNIFER', 'D', '669', '7566', NULL, '3000.00', NULL, '20'),
('7916', 'ROBERTS', 'GRACE', 'M', '669', '7569', NULL, '2875.00', NULL, '12'),
('7919', 'DOUGLAS', 'MICHAEL', 'A', '667', '7799', NULL, '800.00', NULL, '12'),
('7934', 'MILLER', 'BARBARA', 'M', '667', '7782', NULL, '1300.00', NULL, '10'),
('7950', 'JENSEN', 'ALICE', 'B', '667', '7505', NULL, '750.00', NULL, '13'),
('7954', 'MURRAY', 'JAMES', 'T', '667', '7506', NULL, '750.00', NULL, '23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `Trabajo_ID` decimal(3,0) NOT NULL,
  `Funcion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajos`
--

INSERT INTO `trabajos` (`Trabajo_ID`, `Funcion`) VALUES
('667', 'SECRETARIO'),
('668', 'STAFF'),
('669', 'ANALYST'),
('670', 'VENDEDOR'),
('671', 'MANAGER'),
('672', 'PRESIDENT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `Ubicacion_ID` decimal(3,0) NOT NULL,
  `GrupoRegional` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`Ubicacion_ID`, `GrupoRegional`) VALUES
('122', 'NEW YORK'),
('123', 'CHICAGO'),
('124', 'DALLAS'),
('167', 'BOSTON');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CLIENTE_ID`),
  ADD KEY `FK_cliente_empleados` (`Vendedor_ID`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`departamento_ID`),
  ADD KEY `FK_departamento_ubicacion` (`Ubicacion_ID`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`empleado_ID`),
  ADD KEY `FK_empleados_departamento` (`Departamento_ID`),
  ADD KEY `FK_empleados_trabajos` (`Trabajo_ID`);

--
-- Indices de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD PRIMARY KEY (`Trabajo_ID`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`Ubicacion_ID`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FK_cliente_empleados` FOREIGN KEY (`Vendedor_ID`) REFERENCES `empleados` (`empleado_ID`);

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `FK_departamento_ubicacion` FOREIGN KEY (`Ubicacion_ID`) REFERENCES `ubicacion` (`Ubicacion_ID`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `FK_empleados_departamento` FOREIGN KEY (`Departamento_ID`) REFERENCES `departamento` (`departamento_ID`),
  ADD CONSTRAINT `FK_empleados_trabajos` FOREIGN KEY (`Trabajo_ID`) REFERENCES `trabajos` (`Trabajo_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
