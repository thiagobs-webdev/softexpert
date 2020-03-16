drop table users;
-- create table users
CREATE TABLE if exists users(
	id serial PRIMARY KEY,	
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	passwd VARCHAR(255) NOT NULL,
	facebook_id VARCHAR(30),
	google_id VARCHAR(30),
	photo VARCHAR(255),
	forget VARCHAR(255),
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP
	);

-- inserction 
begin
INSERT INTO users (first_name, last_name, email, passwd, created_at) VALUES ('Thiago','Bomfim', 'thiagobs.webdev@gmail.com', '$2y$10$p/0C8Ct4W71SfrVSqUZQXOZzYbPALi3eul6t.Y/yZFZYTKD2dz2gi', NOW());
commit


drop table if exists product_type_taxes;
-- create table product_type_taxes
CREATE TABLE product_type_taxes(
	id serial PRIMARY KEY,	
	name VARCHAR(255) UNIQUE NOT NULL,
	percentage DECIMAL(10,2) NOT NULL,
	registered_by_id INTEGER NOT NULL REFERENCES users(id),	
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP
);

-- inserction 
begin
INSERT INTO product_type_taxes (name, percentage, registered_by_id, created_at) VALUES ('ICMS', 6.50, 1, NOW());
INSERT INTO product_type_taxes (name, percentage, registered_by_id, created_at) VALUES ('Cofins', 3.60, 1, NOW());
INSERT INTO product_type_taxes (name, percentage, registered_by_id, created_at) VALUES ('Cide', 2.35, 1, NOW());
INSERT INTO product_type_taxes (name, percentage, registered_by_id, created_at) VALUES ('ITR', 5.25, 1, NOW());
commit

drop table if exists product_types;
-- create table product_types
CREATE TABLE product_types(
	id serial PRIMARY KEY,	
	name VARCHAR(255) UNIQUE NOT NULL,
	product_type_taxes_id INTEGER NOT NULL REFERENCES product_type_taxes(id),	
	registered_by_id INTEGER NOT NULL REFERENCES users(id),	
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP
);

-- inserction 
begin
INSERT INTO product_types (name, product_type_taxes_id, registered_by_id, created_at) VALUES ('Informática', 1, 1, NOW());
INSERT INTO product_types (name, product_type_taxes_id, registered_by_id, created_at) VALUES ('Cozinha', 2, 1, NOW());
INSERT INTO product_types (name, product_type_taxes_id, registered_by_id, created_at) VALUES ('Eletrodomésticos', 3, 1, NOW());
INSERT INTO product_types (name, product_type_taxes_id, registered_by_id, created_at) VALUES ('Esportes', 4, 1, NOW());
commit

-- inserction 
drop table if exists products;
-- create table products
CREATE TABLE products(
	id serial PRIMARY KEY,	
	name VARCHAR(255) NOT NULL,
	price DECIMAL(10,2) NOT NULL,
	product_type_id INTEGER NOT NULL REFERENCES product_types(id),	
	registered_by_id INTEGER NOT NULL REFERENCES users(id),	
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP
);

-- inserction 
begin
INSERT INTO products (name, price, product_type_id, registered_by_id, created_at) VALUES ('Geladeira', 1500, 2, 1, NOW());
INSERT INTO products (name, price, product_type_id, registered_by_id, created_at) VALUES ('Mouse', 55.60, 1, 1, NOW());
INSERT INTO products (name, price, product_type_id, registered_by_id, created_at) VALUES ('Fogão', 540, 3, 1, NOW());
INSERT INTO products (name, price, product_type_id, registered_by_id, created_at) VALUES ('Prancha', 1100, 4, 1, NOW());
commit

drop table if exists sales;
-- create table products
CREATE TABLE sales(
	id serial PRIMARY KEY,
	product_id INTEGER NOT NULL REFERENCES products(id),		
	amount INTEGER NOT NULL,	
	registered_by_id INTEGER NOT NULL REFERENCES users(id),	
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP
);

-- inserction 
begin
INSERT INTO sales (product_id, amount, registered_by_id, created_at) VALUES (4, 2, 1, NOW());
INSERT INTO sales (product_id, amount, registered_by_id, created_at) VALUES (1, 2, 1, NOW());
INSERT INTO sales (product_id, amount, registered_by_id, created_at) VALUES (3, 4, 1, NOW());
INSERT INTO sales (product_id, amount, registered_by_id, created_at) VALUES (2, 22, 1, NOW());
commit


