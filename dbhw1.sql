CREATE TABLE users (
    id integer primary key auto_increment,
    nome varchar(16) not null,
    cognome varchar(255) not null,
    username varchar(255) not null unique,
    email VARCHAR(255) not null UNIQUE,
    password varchar(255) not null,
) Engine = InnoDB;

CREATE TABLE likes (
    userid INTEGER NOT NULL,
    img VARCHAR(255) NOT NULL, 
    title VARCHAR(255) NOT NULL,
    FOREIGN KEY(userid) REFERENCES users(id) on delete cascade on update cascade
) Engine = InnoDB;
