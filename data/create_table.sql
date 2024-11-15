CREATE TABLE IF NOT EXISTS `usersdw` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(45) NOT NULL,
    `password` VARCHAR(60) NOT NULL,    
    `status` TINYINT(1) DEFAULT 1,
    `email` VARCHAR(255) NULL,
    `telephone` VARCHAR(12) NOT NULL,
    `firstname` VARCHAR(45) NOT NULL,
    `lastname` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `username_usuario_UNIQUE` (`username` ASC),
    UNIQUE INDEX `telephone_usuario_UNIQUE` (`telephone` ASC),
    UNIQUE INDEX `email_usuario_UNIQUE` (`email` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;