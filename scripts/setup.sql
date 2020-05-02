drop database if exists webshop;
create database webshop;

create table webshop.User
(
    user_id       varchar(36) primary key,
    first_name    varchar(25) null,
    last_name     varchar(25) null,
    email_address varchar(25) not null,
    password      varchar(25) not null
);

insert into webshop.User (user_id, first_name, last_name, email_address, password)
values ('343807fc-9938-4dec-ab9a-5a683a0e2e58',
        'Max',
        'Musterman',
        'max@musterman.de',
        'pass123');