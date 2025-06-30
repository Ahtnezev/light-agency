DROP DATABASE IF EXISTS light_agency_db;
CREATE DATABASE light_agency_db;
use light_agency_db;

-- SET FOREIGN_KEY_CHECKS = 0; //! dev mode
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS models;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS brands;
-- SET FOREIGN_KEY_CHECKS = 1; //! dev mode


-- INTERMEDIO/AVANZADO
CREATE TABLE brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    country VARCHAR(100),
    website VARCHAR(255),
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);

-- INTERMEDIO/AVANZADO
CREATE TABLE models (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    year YEAR,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,

    FOREIGN KEY (brand_id) REFERENCES brands(id),
    INDEX (brand_id)
);


CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    parent_id INT DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,

    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE SET NULL,
    INDEX (parent_id)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    model_id INT NOT NULL,

    specs TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    category_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    
    FOREIGN KEY (model_id) REFERENCES models(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT,
    INDEX (model_id),
    INDEX (category_id)
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,

    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    INDEX (product_id)
);

-- INTERMEDIO/AVANZADO
ALTER TABLE products ADD views INT DEFAULT 0 AFTER price;
-- featured products
ALTER TABLE products ADD COLUMN is_featured BOOLEAN DEFAULT 0;

-- We can create to more control a cart_details table
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    qty INT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    paid BOOLEAN DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,

    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    INDEX(product_id)
);

-- INTERMEDIO/AVANZADO
INSERT INTO brands (name, country, website) VALUES
('HP', 'USA', 'https://www.hp.com'),
('Dell', 'USA', 'https://www.dell.com'),
('Lenovo', 'China', 'https://www.lenovo.com'),
('Asus', 'Taiwan', 'https://www.asus.com'),
('Acer', 'Taiwan', 'https://www.acer.com'),
('Apple', 'USA', 'https://www.apple.com'),
('Samsung', 'South Korea', 'https://www.samsung.com'),
('MSI', 'Taiwan', 'https://www.msi.com'),
('Gigabyte', 'Taiwan', 'https://www.gigabyte.com'),
('Razer', 'USA', 'https://www.razer.com');

-- INTERMEDIO/AVANZADO
INSERT INTO models (brand_id, name, year) VALUES
(1, 'HP 240 G8', 2023),
(2, 'Dell Inspiron 15', 2022),
(3, 'ThinkCentre M70s', 2021),
(4, 'MSI Katana GF66', 2023),
(5, 'LG UltraFine 24"', 2022),
(6, 'Logitech K380', 2020),
(7, 'Samsung Tab A8', 2023),
(6, 'iPhone 13', 2022),
(4, 'Asus ROG Strix', 2023),
(3, 'IdeaPad 3', 2021);

INSERT INTO categories (id, name, parent_id) VALUES
(1, 'Tecnología', NULL),
(2, 'Computadoras', 1),
(3, 'Laptops', 2),
(4, 'PCs de Escritorio', 2),
(5, 'Componentes', 1),
(6, 'Monitores', 5),
(7, 'Teclados', 5),
(8, 'Gadgets', 1),
(9, 'Smartphones', 8),
(10, 'Tablets', 8);

INSERT INTO products (model_id, specs, price, views, image_url, category_id, is_featured) VALUES
(1, 'Intel i5, 8GB RAM, 256GB SSD, Windows 11', 10500.00, (FLOOR(RAND() * 999) + 1), 'compac-pc.png', 3, FLOOR(RAND() * 2)),
(2, 'Ryzen 5, 16GB RAM, 512GB SSD', 13500.00, (FLOOR(RAND() * 999) + 1), 'dell-pc.png', 3, FLOOR(RAND() * 2)),
(3, 'Intel i3, 4GB RAM, 1TB HDD', 7800.00, (FLOOR(RAND() * 999) + 1), 'marca1-pc.png', 4, FLOOR(RAND() * 2)),
(4, 'Intel i7, RTX 3050, 16GB RAM', 22500.00, (FLOOR(RAND() * 999) + 1), 'hp-pc.png', 3, FLOOR(RAND() * 2)),
(5, 'Full HD, 75Hz, IPS', 2900.00, (FLOOR(RAND() * 999) + 1), 'dell4-pc.png', 6, FLOOR(RAND() * 2)),
(6, 'Bluetooth, compacto, multiplataforma', 800.00, (FLOOR(RAND() * 999) + 1), 'marca2-pc.png', 7, FLOOR(RAND() * 2)),
(7, '10.5", 4GB RAM, 64GB, Android 13', 6500.00, (FLOOR(RAND() * 999) + 1), 'marca3-pc.jpeg', 10, FLOOR(RAND() * 2)),
(8, '128GB, cámara dual, iOS', 18999.00, (FLOOR(RAND() * 999) + 1), 'msi-pc.png', 9, FLOOR(RAND() * 2)),
(9, 'Ryzen 9, 32GB RAM, RTX 4070', 39500.00, (FLOOR(RAND() * 999) + 1), 'surface-pc.png', 3, FLOOR(RAND() * 2)),
(10, 'Ryzen 5, 12GB RAM, SSD 512GB', 9200.00, (FLOOR(RAND() * 999) + 1), 'msi-pc.png', 3, FLOOR(RAND() * 2));

INSERT INTO comments (product_id, name, content, rating) VALUES
(1, 'Luis Pérez', 'Excelente rendimiento por su price.', 5),
(1, 'Ana López', 'Perfecta para home office.', 4),
(2, 'Carlos García', 'Muy buena calidad de construcción.', 4),
(3, 'Marta Díaz', 'Un poco lenta, pero cumple.', 3),
(4, 'Raúl Torres', 'Ideal para juegos modernos.', 5),
(5, 'Sofía Ríos', 'Buena imagen, pero faltan altavoces.', 4),
(6, 'Andrés Juárez', 'Muy cómodo para escribir.', 5),
(7, 'Daniela Flores', 'Súper útil para la escuela.', 4),
(8, 'Ernesto Zúñiga', 'Demasiado caro para lo que ofrece.', 3),
(9, 'Ivonne Morales', 'Una bestia en gaming y productividad.', 5),
(10, 'Jesús Silva', 'Muy buen desempeño general.', 4);

-- 
INSERT INTO cart (product_id, qty, subtotal, total, paid) VALUES
(1, 2, 485.22, 562.85, 0),
(2, 1, 150.00, 174.00, 0);