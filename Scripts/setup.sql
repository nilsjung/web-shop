drop database if exists webshop;
create database webshop;

create table webshop.User
(
    user_id          varchar(36),
    first_name       varchar(25)                    null,
    last_name        varchar(25)                    null,
    email_address    varchar(50)                    not null,
    password         varchar(60)                    not null,
    payment_method   enum ('paypal', 'credit_card') not null,
    shopping_cart_id int,

    PRIMARY KEY (user_id)
);

insert into webshop.User (user_id, first_name, last_name, email_address, password, payment_method)
values ('343807fc-9938-4dec-ab9a-5a683a0e2e58',
        'Max',
        'Musterman',
        'test@user.com',
        'test', 'paypal'),
       ('630ea65b-8111-46fd-ad54-8a8d5a3a7e04',
        'Larry',
        'Murray',
        'larry.murray@kamille.ca',
        '$2y$10$auPIaqVaD2YgXXejurZkWOE//ALG3m4I3XvKPFYUByf1/GXp.l/Ly', 'credit_card'),
       ('22cb9b80-29be-40d0-bbc2-5fd181b8747b',
        'Cecile',
        'Williamson',
        'cecile.williamson@katheryn.co.uk',
        '$2y$10$auPIaqVaD2YgXXejurZkWOE//ALG3m4I3XvKPFYUByf1/GXp.l/Ly', 'paypal');

create table webshop.Article
(
    article_id   varchar(36),
    article_name varchar(36) not null,
    stock        int         not null,
    price        float       not null,
    description  text,
    image_path   varchar(100),

    PRIMARY KEY (article_id)
);

insert into webshop.Article (article_id, article_name, stock, price, description, image_path)
VALUES ('0b5e61f3-2f66-43a1-aa7a-e1c2575c90a6',
        'Banana',
        3,
        1.30,
        'A sweet and yellow banana.',
        '/Public/Images/Articles/banana.jpg'),
       ('cb949e93-432b-4aa1-bcbf-b75f3e06a784',
        'Burger',
        0,
        5.49,
        'our best and cheesy burger',
        '/Public/Images/Articles/burger.jpg'),
       ('4629d912-423d-44be-9792-95a54a8d37ed',
        'Strawberries',
        10,
        2.00,
        'Yummy yummy strawberries, just delivered from the field',
        '/Public/Images/Articles/strawberries.jpg'),
       ('e94c5592-8f98-44cb-b62e-ccc3ff71ce30',
        'Pi',
        5,
        42.39,
        'A Rasperry Pi supply thing',
        '/Public/Images/Articles/pi.jpg'),
       ('86e033a3-a1dd-4f04-8bc4-a04fe2aa504b',
        'Storm trooper',
        12,
        1003.13,
        'A storm trooper costume. Lightweight and nice to wear.',
        '/Public/Images/Articles/storm-trooper.jpg'),
       ('57adbf2b-0c58-4397-8f8b-d25c488a4e0b',
        'Yacht',
        1,
        10130.10,
        'A beautiful yacht for sailing away',
        '/Public/Images/Articles/yacht.jpg'),
       ('e379de19-baeb-407f-98f6-03e0f393d83b',
        'Bird',
        5,
        84.30,
        'A beautiful bird, chirping loudly songs',
        '/Public/Images/Articles/bird.jpg'),
       ('c424cbbf-8bfc-420a-87c0-ddf85f6f568a',
        'Pencil',
        10,
        12.99,
        'Some nice pencils in every color you can imagine',
        '/Public/Images/Articles/pencil.jpg');

create table webshop.ShoppingCart
(
    shopping_cart_id varchar(36),

    PRIMARY KEY (shopping_cart_id)
);

create table webshop.articles_in_cart
(
    shopping_cart_id varchar(36),
    article_id       varchar(36),
    count            int not null default (1),

    primary key (shopping_cart_id, article_id),
    FOREIGN KEY (shopping_cart_id) references webshop.ShoppingCart (shopping_cart_id),
    FOREIGN KEY (article_id) references webshop.Article (article_id)
);

create table webshop.Order
(
    order_id varchar(36),
    user_id varchar(36),
    order_total varchar(10),

    primary key (order_id) ,
    foreign key (user_id) references webshop.User (user_id)
);