CREATE TABLE `lista_precio` (
	`id` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
	`material` VARCHAR(255) NULL DEFAULT NULL,
	`precio_kg` FLOAT(10,2) NULL DEFAULT NULL,
	`variacion_precio` FLOAT(10,2) NULL DEFAULT NULL,
	`variacion_porcentaje` FLOAT(10,2) NULL DEFAULT NULL,
	`slug` VARCHAR(255) NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	`tipo` VARCHAR(20) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB  DEFAULT CHARSET=latin1;

#########################################21/04/2016##############################

ALTER TABLE `mensaje`
	ADD COLUMN `id_producto` BIGINT(20) NULL DEFAULT NULL AFTER `revisadoporadmin`,
	ADD COLUMN `id_mensaje` BIGINT(20) NULL DEFAULT NULL AFTER `id_producto`;
	
ALTER TABLE `mensaje`
	ADD CONSTRAINT `mensaje_id_producto_producto_id` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);	
	
	
#########################################10/05/2016##############################
CREATE TABLE `usuario_intereses` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	id_usuario BIGINT(20) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB  DEFAULT CHARSET=latin1;

ALTER TABLE `usuario_intereses`
	ADD CONSTRAINT `usuario_intereses_id_usuario_usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);	
	
CREATE TABLE `rel_usuario_intereses_subcategoria` (
	`id_usuario_intereses` BIGINT(10) UNSIGNED NOT NULL DEFAULT '0',
	`id_subcategoria` BIGINT(20) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id_usuario_intereses`, `id_subcategoria`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

CREATE TABLE `rel_usuario_intereses_localidad` (
	`id_usuario_intereses` BIGINT(10) UNSIGNED NOT NULL DEFAULT '0',
	`id_localidad` BIGINT(20) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id_usuario_intereses`, `id_localidad`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;

ALTER TABLE `rel_usuario_intereses_subcategoria`
	ADD CONSTRAINT `FK_rel_usuario_intereses_subcategoria_subcategoria` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategoria` (`id`);
	
#########################################06/06/2017##############################
ALTER TABLE `producto`
	ADD COLUMN `publicar_mail` TINYINT(1) NOT NULL DEFAULT '0' AFTER `id_frecuencia`;
