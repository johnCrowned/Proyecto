

CREATE TABLE `evaluadores` (
  `id_evaluadores` int(5) NOT NULL,
  `nombresev` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `documentoev` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `contrasenaev` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluadores`
--

INSERT INTO `evaluadores` (`id_evaluadores`, `nombresev`, `documentoev`, `contrasenaev`) VALUES
(1, 'PEPITO PEREZ', '111', '111'),
(2, 'LEONARDO PINEDA', '123', '123'),
(3, 'CLAUDIA ROZO', '456', '456'),
(4, 'PEDRO', '12345', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermedia`
--

CREATE TABLE `intermedia` (
  `id_inter` int(5) NOT NULL,
  `fk_rol` int(5) NOT NULL,
  `fk_doc` int(5) NOT NULL,
  `estado` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `intermedia`
--

INSERT INTO `intermedia` (`id_inter`, `fk_rol`, `fk_doc`, `estado`) VALUES
(1, 1, 123, 1),
(2, 2, 123, 1),
(3, 1, 456, 1),
(4, 2, 111, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(5) NOT NULL,
  `rol` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Instructor'),
(2, 'Jurado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evaluadores`
--
ALTER TABLE `evaluadores`
  ADD PRIMARY KEY (`id_evaluadores`);

--
-- Indices de la tabla `intermedia`
--
ALTER TABLE `intermedia`
  ADD PRIMARY KEY (`id_inter`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evaluadores`
--
ALTER TABLE `evaluadores`
  MODIFY `id_evaluadores` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de la tabla `intermedia`
--
ALTER TABLE `intermedia`
  MODIFY `id_inter` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

