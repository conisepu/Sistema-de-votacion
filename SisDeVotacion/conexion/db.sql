CREATE SCHEMA  IF NOT EXISTS `votaciones_db` ;



CREATE TABLE IF NOT EXISTS `votaciones_db`.`votacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `votaciones_db`.`preguntas` (
  `id_pregunta` INT NOT NULL AUTO_INCREMENT,
  `id_votacion` INT NOT NULL,
  `pregunta` VARCHAR(255) NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_pregunta`),
  INDEX `id_idx` (`id_votacion` ASC) VISIBLE,
  CONSTRAINT `id`
    FOREIGN KEY (`id_votacion`)
    REFERENCES `votaciones_db`.`votacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE TABLE `votaciones_db`.`opciones` (
  `id_opcion` INT NOT NULL AUTO_INCREMENT,
  `idVotacion` INT NOT NULL,
  `idPregunta` INT NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_opcion`),
  INDEX `id_pregunta_idx` (`idVotacion` ASC, `idPregunta` ASC) VISIBLE,
  CONSTRAINT `id_votacion`
    FOREIGN KEY (`idVotacion` , `idPregunta`)
    REFERENCES `votaciones_db`.`preguntas` (`id_votacion` , `id_pregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_pregunta`
    FOREIGN KEY (`idVotacion` , `idPregunta`)
    REFERENCES `votaciones_db`.`preguntas` (`id_votacion` , `id_pregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE `votaciones_db`.`usuarios` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `mail` VARCHAR(45) NOT NULL,
  `pass` CHAR(70) NULL,
  PRIMARY KEY (`ID`));

  CREATE TABLE `votaciones_db`.`respuestas` (
  `id_respuesta` INT NOT NULL AUTO_INCREMENT,
  `id_votacion` INT NOT NULL,
  `id_pregunta` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `respuesta` TEXT NOT NULL,
  PRIMARY KEY (`id_respuesta`));

CREATE TABLE `votaciones_db`.`estados` (
  `id_votacion` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `estado` TINYINT NOT NULL,
  PRIMARY KEY (`id_votacion`, `id_usuario`));
