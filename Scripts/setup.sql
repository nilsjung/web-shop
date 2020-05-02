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


create table webshop.Article
(
    article_id   varchar(36) primary key,
    article_name varchar(36) not null,
    stock        int         not null,
    description  text,
    image_path   varchar(100)
);

insert into webshop.Article (article_id, article_name, stock, description, image_path)
VALUES
(
    '0b5e61f3-2f66-43a1-aa7a-e1c2575c90a6',
    'banana',
    3,
    'a sweet and yellow banana',
    '/Public/Images/Articles/banana.jpg'
), (
    'cb949e93-432b-4aa1-bcbf-b75f3e06a784',
    'burger',
    0,
    'our best and cheesy burger',
    '/Public/Images/Articles/burger.jpg'
), (
    '4629d912-423d-44be-9792-95a54a8d37ed',
    'strawberries',
    10,
    'yummy yummy strawberries, just delivered from the field',
    '/Public/Images/Articles/strawberries.jpg'
)