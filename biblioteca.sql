-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2024 a las 07:46:25
-- Versión del servidor: 10.4.25-MariaDB-log
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarAdministrativo` (IN `p_NoCuenta` INT, IN `p_Nombre` VARCHAR(255), IN `p_area` VARCHAR(255), IN `p_Contrasena` VARCHAR(255), IN `p_Cargo` VARCHAR(255))   BEGIN
    UPDATE USER
    SET Nombre = p_Nombre, area = p_area, Contrasena = p_Contrasena
    WHERE NoCuenta = p_NoCuenta;

    UPDATE ADMINISTRATIVO
    SET cargo = p_Cargo
    WHERE NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarAlumno` (IN `p_NoCuenta` VARCHAR(255), IN `p_Nombre` VARCHAR(255), IN `p_area` VARCHAR(255), IN `p_Contrasena` VARCHAR(255), IN `p_Semestre` VARCHAR(255), IN `p_Grupo` VARCHAR(255))   BEGIN
    UPDATE USER
    SET Nombre = p_Nombre, area = p_area, Contrasena = p_Contrasena
    WHERE NoCuenta = p_NoCuenta;

    UPDATE ALUMNO
    SET semestre = p_Semestre, grupo = p_Grupo
    WHERE NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarInvitado` (IN `p_NoCuenta` INT, IN `p_Nombre` VARCHAR(255), IN `p_area` VARCHAR(255), IN `p_Contrasena` VARCHAR(255), IN `p_Dependencia` VARCHAR(255))   BEGIN
    UPDATE USER
    SET Nombre = p_Nombre, area = p_area, Contrasena = p_Contrasena
    WHERE NoCuenta = p_NoCuenta;

    UPDATE INVITADO
    SET dependencia = p_Dependencia
    WHERE NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarProfesor` (IN `p_NoCuenta` INT, IN `p_Nombre` VARCHAR(255), IN `p_area` VARCHAR(255), IN `p_Contrasena` VARCHAR(255), IN `p_Cargo` VARCHAR(255))   BEGIN
    UPDATE USER
    SET Nombre = p_Nombre,area = p_area, Contrasena = p_Contrasena
    WHERE NoCuenta = p_NoCuenta;

    UPDATE PROFESOR
    SET cargo = p_Cargo
    WHERE NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarRecord` (IN `p_NoCuenta` VARCHAR(255))   BEGIN
    UPDATE record SET Salida = UNIX_TIMESTAMP(NOW()) WHERE Salida = '' AND NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarRegistros` ()   BEGIN
    DECLARE currentHour INT;

    -- Obtener la hora actual en formato UNIX
    SELECT UNIX_TIMESTAMP(NOW()) INTO currentHour;

    -- Verificar si la hora actual es 22 (10 pm)
    IF EXTRACT(HOUR FROM NOW()) = 22 THEN
        -- Actualizar registros en 'record' con 'Salida' nula
        UPDATE record SET Salida = UNIX_TIMESTAMP(NOW()) WHERE Salida = '';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Bloquear` (IN `p_NoCuenta` INT, IN `p_Motivo` VARCHAR(255), IN `p_FechaBloqueo` DATE, IN `p_FechaDesbloqueo` DATE)   BEGIN
    INSERT INTO blocked_user (NoCuenta, Motivo, FechaBloqueo, FechaDesbloqueo)
    VALUES (p_NoCuenta, p_Motivo, p_FechaBloqueo, p_FechaDesbloqueo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarTodosLosProfesores` ()   BEGIN
    -- Consulta para obtener datos de todos los profesores
    SELECT
        u.NoCuenta, u.Nombre, u.Apellido_P, u.Apellido_M, u.area, p.cargo
    FROM
        User u
    JOIN
        Profesor p ON u.NoCuenta = p.NoCuenta;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarUsuario` (IN `p_IdAdmin` INT, IN `p_Nombre` VARCHAR(255), IN `p_Contrasena` VARCHAR(255))   BEGIN
    SELECT *
    FROM USER
    WHERE is_admin = p_IdAdmin
      AND Nombre = p_Nombre
      AND Contrasena = p_Contrasena;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Desbloquear` (IN `p_NoCuenta` INT)   BEGIN
    DELETE FROM blocked_user WHERE NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarAdministrativo` (IN `p_NoCuenta` VARCHAR(255))   BEGIN
    DELETE FROM ADMINISTRATIVO WHERE NoCuenta = p_NoCuenta;
    DELETE FROM USER WHERE NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarAlumno` (IN `p_NoCuenta` VARCHAR(255))   BEGIN
    DELETE FROM ALUMNO WHERE NoCuenta = p_NoCuenta;
    DELETE FROM USER WHERE NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarInvitado` (IN `p_NoCuenta` INT)   BEGIN
    DELETE FROM INVITADO WHERE NoCuenta = p_NoCuenta;
    DELETE FROM USER WHERE NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarProfesor` (IN `p_NoCuenta` INT)   BEGIN
    DELETE FROM PROFESOR WHERE NoCuenta = p_NoCuenta;
    DELETE FROM USER WHERE NoCuenta = p_NoCuenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarAdministrativo` (IN `p_NoCuenta` INT, IN `p_Nombre` VARCHAR(255), IN `p_area` VARCHAR(255), IN `p_Contrasena` VARCHAR(255), IN `p_Cargo` VARCHAR(255))   BEGIN
    INSERT INTO USER (NoCuenta, Nombre, area, Contrasena, is_admin)
    VALUES (p_NoCuenta, p_Nombre, p_area, p_Contrasena, 0);

    INSERT INTO ADMINISTRATIVO (NoCuenta, cargo)
    VALUES (p_NoCuenta, p_Cargo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarAlumno` (IN `p_NoCuenta` VARCHAR(255), IN `p_Nombre` VARCHAR(255), IN `p_area` VARCHAR(255), IN `p_Contrasena` VARCHAR(255), IN `p_Semestre` VARCHAR(255), IN `p_Grupo` VARCHAR(255))   BEGIN
    INSERT INTO USER (NoCuenta, Nombre, area, Contrasena, is_admin)
    VALUES (p_NoCuenta, p_Nombre, p_area, p_Contrasena, 0);

    INSERT INTO ALUMNO (NoCuenta, semestre, grupo)
    VALUES (p_NoCuenta, p_Semestre, p_Grupo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarInvitado` (IN `p_NoCuenta` INT, IN `p_Nombre` VARCHAR(255), IN `p_area` VARCHAR(255), IN `p_Contrasena` VARCHAR(255), IN `p_Dependencia` VARCHAR(255))   BEGIN
    INSERT INTO USER (NoCuenta, Nombre, area, Contrasena, is_admin)
    VALUES (p_NoCuenta, p_Nombre, p_area, p_Contrasena, 0);

    INSERT INTO INVITADO (NoCuenta, dependencia)
    VALUES (p_NoCuenta, p_Dependencia);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarProfesor` (IN `p_NoCuenta` INT, IN `p_Nombre` VARCHAR(255), IN `p_area` VARCHAR(255), IN `p_Contrasena` VARCHAR(255), IN `p_Cargo` VARCHAR(255))   BEGIN
    INSERT INTO USER (NoCuenta, Nombre, area, Contrasena, is_admin)
    VALUES (p_NoCuenta, p_Nombre,p_area, p_Contrasena, 0);

    INSERT INTO PROFESOR (NoCuenta, cargo)
    VALUES (p_NoCuenta, p_Cargo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarRecord` (IN `p_NoCuenta` VARCHAR(255), IN `p_Asiento` VARCHAR(255))   BEGIN
    DECLARE userBlockedCount INT;

    -- Verificar si el usuario está bloqueado
    SELECT COUNT(*) INTO userBlockedCount
    FROM blocked_user
    WHERE NoCuenta = p_NoCuenta;

    -- Si el usuario está bloqueado, regresar false
    IF userBlockedCount > 0 THEN
        SELECT FALSE AS Resultado;
    ELSE
        -- Si el usuario no está bloqueado, insertar en la tabla 'record'
        INSERT INTO record (NoCuenta, Asiento, Entrada, Salida)
        VALUES (p_NoCuenta, p_Asiento, UNIX_TIMESTAMP(NOW()), '');

        -- Regresar true o algún mensaje de éxito
        SELECT TRUE AS Resultado;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrativo`
--

CREATE TABLE `administrativo` (
  `NoCuenta` varchar(255) NOT NULL,
  `cargo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrativo`
--

INSERT INTO `administrativo` (`NoCuenta`, `cargo`) VALUES
('18480', 'auxiliar-mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `NoCuenta` varchar(255) NOT NULL,
  `semestre` varchar(255) DEFAULT NULL,
  `grupo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`NoCuenta`, `semestre`, `grupo`) VALUES
('0314150001', '515', ''),
('0314150002', '415', ''),
('PR1423A001', '', '114A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientos`
--

CREATE TABLE `asientos` (
  `NoCuenta` varchar(255) DEFAULT NULL,
  `Asiento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asientos`
--

INSERT INTO `asientos` (`NoCuenta`, `Asiento`) VALUES
('PR1423A001', 'A1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blocked_user`
--

CREATE TABLE `blocked_user` (
  `idBlocked` int(11) NOT NULL,
  `NoCuenta` int(11) DEFAULT NULL,
  `Motivo` varchar(255) DEFAULT NULL,
  `FechaBloqueo` varchar(255) DEFAULT NULL,
  `FechaDesbloqueo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitado`
--

CREATE TABLE `invitado` (
  `NoCuenta` varchar(255) NOT NULL,
  `dependencia` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `invitado`
--

INSERT INTO `invitado` (`NoCuenta`, `dependencia`) VALUES
('266756', 'sesfesf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `NoCuenta` varchar(255) NOT NULL,
  `cargo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`NoCuenta`, `cargo`) VALUES
('2112', 'Jefe de Carrera'),
('2147483647', 'Profesor-Investigador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `record`
--

CREATE TABLE `record` (
  `idRecord` int(11) NOT NULL,
  `NoCuenta` varchar(255) DEFAULT NULL,
  `Asiento` varchar(255) DEFAULT NULL,
  `Entrada` varchar(255) DEFAULT NULL,
  `Salida` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `record`
--

INSERT INTO `record` (`idRecord`, `NoCuenta`, `Asiento`, `Entrada`, `Salida`) VALUES
(4, 'PR1423A001', 'A1', '1706759807', '1706759882'),
(5, '0314150001', 'A5', '1706759842', '1706759860'),
(6, 'PR1423A001', 'A9', '1706759924', '1706759961'),
(7, '0314150001', 'A13', '1706759934', '1706759979'),
(8, 'PR1423A001', 'A1', '1706766157', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `NoCuenta` varchar(255) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `Contrasena` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`NoCuenta`, `Nombre`, `area`, `Contrasena`, `is_admin`) VALUES
('0314150001', 'juan diego', 'Nutricion', '1asdadw', 0),
('0314150002', 'Juan ramos zacarias', 'Nutricion', 'SQQSqss', 0),
('1', 'admin', 'ADMINISTRADOR', '1234', 1),
('18480', 'Miranda Cruz', 'intendencia', '12e123', 0),
('2112', 'josue veslazquez lopez', 'Idiomas', '1234567', 0),
('2147483647', 'Juan Diego ', 'Licenciatura en Nutricion', '2121122112', 0),
('266756', 'Miranda Cruz', 'Conserge', 'unistmo / ixtepec', 0),
('PR1423A001', 'MARIA GUTIERREZ GU', 'Propedeutico', 'undefined', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrativo`
--
ALTER TABLE `administrativo`
  ADD PRIMARY KEY (`NoCuenta`);

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`NoCuenta`);

--
-- Indices de la tabla `blocked_user`
--
ALTER TABLE `blocked_user`
  ADD PRIMARY KEY (`idBlocked`);

--
-- Indices de la tabla `invitado`
--
ALTER TABLE `invitado`
  ADD PRIMARY KEY (`NoCuenta`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`NoCuenta`);

--
-- Indices de la tabla `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`idRecord`),
  ADD KEY `NoCuenta` (`NoCuenta`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`NoCuenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blocked_user`
--
ALTER TABLE `blocked_user`
  MODIFY `idBlocked` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `record`
--
ALTER TABLE `record`
  MODIFY `idRecord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrativo`
--
ALTER TABLE `administrativo`
  ADD CONSTRAINT `administrativo_ibfk_1` FOREIGN KEY (`NoCuenta`) REFERENCES `user` (`NoCuenta`);

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`NoCuenta`) REFERENCES `user` (`NoCuenta`),
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`NoCuenta`) REFERENCES `user` (`NoCuenta`);

--
-- Filtros para la tabla `invitado`
--
ALTER TABLE `invitado`
  ADD CONSTRAINT `invitado_ibfk_1` FOREIGN KEY (`NoCuenta`) REFERENCES `user` (`NoCuenta`),
  ADD CONSTRAINT `invitado_ibfk_2` FOREIGN KEY (`NoCuenta`) REFERENCES `user` (`NoCuenta`);

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`NoCuenta`) REFERENCES `user` (`NoCuenta`),
  ADD CONSTRAINT `profesor_ibfk_2` FOREIGN KEY (`NoCuenta`) REFERENCES `user` (`NoCuenta`);

--
-- Filtros para la tabla `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`NoCuenta`) REFERENCES `user` (`NoCuenta`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `ActualizarRegistrosEvent` ON SCHEDULE EVERY 1 DAY STARTS '2023-11-14 22:00:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL ActualizarRegistros()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
