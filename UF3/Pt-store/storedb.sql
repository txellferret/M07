CREATE USER 'storeusr'@'localhost' IDENTIFIED BY 'storepass';

CREATE DATABASE storedb
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  
USE storedb;

GRANT SELECT, INSERT, UPDATE, DELETE ON storedb.* TO 'storeusr'@'localhost';

CREATE TABLE users (
    id INTEGER auto_increment,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(40) NOT NULL,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    role VARCHAR(10) NOT NULL DEFAULT 'registered',
    UNIQUE (firstname, lastname),
    PRIMARY KEY (id)
) ENGINE InnoDb;

INSERT INTO users VALUES (0, "user01", "pass01", "fname01", "lname01", "admin");
INSERT INTO users VALUES (0, "user02", "pass02", "fname02", "lname02", "admin");
INSERT INTO users VALUES (0, "user03", "pass03", "fname03", "lname03", "admin");
INSERT INTO users VALUES (0, "user04", "pass04", "fname04", "lname04", "registered");
INSERT INTO users VALUES (0, "user05", "pass05", "fname05", "lname05", "registered");
INSERT INTO users VALUES (0, "user06", "pass06", "fname06", "lname06", "registered");

CREATE TABLE products (
    id INTEGER auto_increment,
    code VARCHAR(20) NOT NULL UNIQUE,
    description VARCHAR(100) NOT NULL,
    price DOUBLE DEFAULT 0.0,
    stock DOUBLE DEFAULT 0.0,
    category_id INTEGER NOT NULL,
    PRIMARY KEY (id)
) ENGINE InnoDb;

CREATE TABLE categories (
    id INTEGER auto_increment,
    code VARCHAR(20) NOT NULL UNIQUE,
    description VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE InnoDb;

ALTER TABLE products ADD FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE RESTRICT;

INSERT INTO categories VALUES 
  (0, "catcode01", "catdesc01"),
  (0, "catcode02", "catdesc02"),
  (0, "catcode03", "catdesc03"),
  (0, "catcode04", "catdesc04"),
  (0, "catcode05", "catdesc05");

 INSERT INTO products VALUES 
  (0, "prodcode01", "proddesc01", 101.0, 11.0, 1),
  (0, "prodcode02", "proddesc02", 102.0, 12.0, 1),
  (0, "prodcode03", "proddesc03", 103.0, 13.0, 2),
  (0, "prodcode04", "proddesc04", 104.0, 14.0, 2),
  (0, "prodcode05", "proddesc05", 105.0, 15.0, 3),
  (0, "prodcode06", "proddesc06", 106.0, 16.0, 4); 