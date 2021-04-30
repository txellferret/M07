create user itemusr@localhost identified by 'itempsw';

CREATE DATABASE itemdb
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  
USE itemdb;

GRANT ALL PRIVILEGES ON itemdb.* TO 'itemusr'@'localhost';


CREATE TABLE notes (
    id INTEGER auto_increment,
    item_id INTEGER NOT NULL,
    content VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE InnoDb;

CREATE TABLE items (
    id INTEGER auto_increment,
    title VARCHAR(20) NOT NULL,
    content VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE InnoDb;

ALTER TABLE notes ADD FOREIGN KEY (item_id) REFERENCES items(id) ON UPDATE CASCADE ON DELETE RESTRICT;


INSERT INTO items VALUES (0,"title1", "content1");
INSERT INTO items VALUES (0,"title2", "content2");
INSERT INTO items VALUES (0,"title3", "content3");
INSERT INTO items VALUES (0,"title4", "content4");
INSERT INTO items VALUES (0,"title5", "content5");
INSERT INTO items VALUES (0,"title6", "content6");
INSERT INTO items VALUES (0,"title7", "content7");

INSERT INTO notes VALUES (0, 1, "contentNote1");
INSERT INTO notes VALUES (0, 1, "contentNote2");
INSERT INTO notes VALUES (0, 1, "contentNote3");
INSERT INTO notes VALUES (0, 2, "contentNote4");
INSERT INTO notes VALUES (0, 2, "contentNote5");
INSERT INTO notes VALUES (0, 3, "contentNote6");
INSERT INTO notes VALUES (0, 4, "contentNote7");
INSERT INTO notes VALUES (0, 5, "contentNote8");