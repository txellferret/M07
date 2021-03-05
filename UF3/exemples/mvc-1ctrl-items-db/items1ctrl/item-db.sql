CREATE USER 'provenusr'@'localhost' IDENTIFIED BY 'provenpsw';
CREATE DATABASE itemsdb
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
GRANT SELECT, INSERT, UPDATE, DELETE ON itemsdb.* TO 'provenusr'@'localhost';
USE itemsdb;
CREATE TABLE items (
   id INTEGER PRIMARY KEY AUTO_INCREMENT,
   title VARCHAR(255),
   content VARCHAR(255)
) ENGINE=InnoDb;
INSERT INTO items (title, content) VALUES 
    ('item 1', 'content 1'),
    ('item 2', 'content 2'),
    ('item 3', 'content 3'),
    ('item 4', 'content 4'),
    ('item 5', 'content 5'),
    ('item 6', 'content 6'),
    ('item 7', 'content 7'),
    ('item 8', 'content 8'),
    ('item 9', 'content 9');


