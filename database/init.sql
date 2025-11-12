-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS proyectobdd;
USE proyectobdd;

-- Eliminar tablas si existen (en orden por claves foráneas)
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS user_roles;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS categorias;

-- Crear tabla categorias
CREATE TABLE `categorias` (
    `id` CHAR(36) NOT NULL,
    `nombre` VARCHAR(255) NOT NULL,
    `is_deleted` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (`nombre`),
    PRIMARY KEY (`id`)
);

-- Insertar datos en categorias
INSERT INTO `categorias` (`id`, `nombre`, `is_deleted`, `created_at`, `updated_at`)
VALUES
('d69cf3db-b77d-4181-b3cd-5ca8107fb6a9', 'DEPORTES', 0, NOW(), NOW()),
('6dbcbf5e-8e1c-47cc-8578-7b0a33ebc154', 'COMIDA', 0, NOW(), NOW()),
('9def16db-362b-44c4-9fc9-77117758b5b0', 'BEBIDA', 0, NOW(), NOW()),
('8c5c06ba-49d6-46b6-85cc-8246c0f362bc', 'COMPLEMENTOS', 0, NOW(), NOW()),
('bb51d00d-13fb-4b09-acc9-948185636f79', 'OTROS', 0, NOW(), NOW());


-- Crear tabla productos
CREATE TABLE `productos` (
    `id` BIGINT AUTO_INCREMENT NOT NULL,
    `uuid` CHAR(36) NOT NULL,
    `precio` DOUBLE DEFAULT 0,
    `stock` INT DEFAULT 0,
    `descripcion` VARCHAR(255),
    `imagen` TEXT DEFAULT 'https://via.placeholder.com/150',
    `marca` VARCHAR(255),
    `modelo` VARCHAR(255),
    `is_deleted` TINYINT(1) DEFAULT 0,
    `categoria_id` CHAR(36),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (`uuid`),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`categoria_id`) REFERENCES `categorias`(`id`)
);

-- Insertar datos en productos
INSERT INTO `productos` (`id`, `uuid`, `precio`, `stock`, `descripcion`, `imagen`, `marca`, `modelo`, `categoria_id`, `is_deleted`, `created_at`, `updated_at`)
VALUES
(1, '19135792-b778-441f-871e-d6e6096e0ddc', 10.99, 5, 'Descripción1', 'https://via.placeholder.com/150', 'Nike', 'Modelo1', 'd69cf3db-b77d-4181-b3cd-5ca8107fb6a9', 0, NOW(), NOW()),
(2, '662ed342-de99-45c6-8463-446989aab9c8', 19.99, 10, 'Descripción2', 'https://via.placeholder.com/150', 'Adidas', 'Modelo2', '6dbcbf5e-8e1c-47cc-8578-7b0a33ebc154', 0, NOW(), NOW()),
(3, 'b79182ad-91c3-46e8-90b9-268164596a72', 15.99, 2, 'Descripción3', 'https://via.placeholder.com/150', 'Nike', 'Modelo3', 'd69cf3db-b77d-4181-b3cd-5ca8107fb6a9', 0, NOW(), NOW()),
(4, '4fa72b3f-dca2-4fd8-b803-dffacf148c10', 25.99, 8, 'Descripción4', 'https://via.placeholder.com/150', 'Nike', 'Modelo4', '6dbcbf5e-8e1c-47cc-8578-7b0a33ebc154', 0, NOW(), NOW()),
(5, '1e2584d8-db52-45da-b2d6-4203637ea78e', 12.99, 3, 'Descripción5', 'https://via.placeholder.com/150', 'Adidas', 'Modelo5', '6dbcbf5e-8e1c-47cc-8578-7b0a33ebc154', 0, NOW(), NOW());


-- Crear tabla usuarios
CREATE TABLE `usuarios` (
    `id` BIGINT AUTO_INCREMENT NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `nombre` VARCHAR(255) NOT NULL,
    `apellidos` VARCHAR(255) NOT NULL,
    `is_deleted` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (`email`),
    UNIQUE (`username`),
    PRIMARY KEY (`id`)
);

-- Insertar usuarios (con hashes tal cual)
INSERT INTO `usuarios` (`id`, `username`, `password`, `email`, `nombre`, `apellidos`, `is_deleted`, `created_at`, `updated_at`)
VALUES
(1, 'admin', '$2a$10$vPaqZvZkz6jhb7U7k/V/v.5vprfNdOnh4sxi/qpPRkYTzPmFlI9p2', 'admin@prueba.net', 'Admin', 'Admin Admin', 0, NOW(), NOW()),
(2, 'user', '$2a$12$RUq2ScW1Kiizu5K4gKoK4OTz80.DWaruhdyfi2lZCB.KeuXTBh0S.', 'user@prueba.net', 'User', 'User User', 0, NOW(), NOW()),
(3, 'test', '$2a$10$Pd1yyq2NowcsDf4Cpf/ZXObYFkcycswqHAqBndE1wWJvYwRxlb.Pu', 'test@prueba.net', 'Test', 'Test Test', 0, NOW(), NOW()),
(4, 'otro', '$2a$12$3Q4.UZbvBMBEvIwwjGEjae/zrIr6S50NusUlBcCNmBd2382eyU0bS', 'otro@prueba.net', 'Otro', 'Otro Otro', 0, NOW(), NOW());


-- Crear tabla user_roles
CREATE TABLE `user_roles` (
    `user_id` BIGINT NOT NULL,
    `roles` VARCHAR(255),
    FOREIGN KEY (`user_id`) REFERENCES `usuarios`(`id`)
);

-- Insert roles
INSERT INTO `user_roles` (`user_id`, `roles`)
VALUES
(1, 'USER'),
(1, 'ADMIN'),
(2, 'USER'),
(3, 'USER'),
(4, 'USER');