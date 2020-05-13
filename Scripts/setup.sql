drop database if exists webshop;
create database webshop;

create table webshop.User
(
    user_id          varchar(36),
    first_name       varchar(25) null,
    last_name        varchar(25) null,
    email_address    varchar(50) not null,
    password         varchar(25) not null,
    shopping_cart_id int,

    PRIMARY KEY (user_id)
);

insert into webshop.User (user_id, first_name, last_name, email_address, password)
values ('343807fc-9938-4dec-ab9a-5a683a0e2e58',
        'Max',
        'Musterman',
        'test@user.com',
        'password'),
       ('630ea65b-8111-46fd-ad54-8a8d5a3a7e04',
        'Larry',
        'Murray',
        'larry.murray@kamille.ca',
        'test'),
       ('22cb9b80-29be-40d0-bbc2-5fd181b8747b',
        'Cecile',
        'Williamson',
        'cecile.williamson@katheryn.co.uk',
        '12345678');

create table webshop.Article
(
    article_id   varchar(36),
    article_name varchar(36) not null,
    stock        int         not null,
    description  text,
    image_path   varchar(100),

    PRIMARY KEY (article_id)
);

insert into webshop.Article (article_id, article_name, stock, description, image_path)
VALUES ('0b5e61f3-2f66-43a1-aa7a-e1c2575c90a6',
        'Banana',
        3,
        'A sweet and yellow banana.',
        '/Public/Images/Articles/banana.jpg'),
       ('cb949e93-432b-4aa1-bcbf-b75f3e06a784',
        'Burger',
        0,
        'our best and cheesy burger',
        '/Public/Images/Articles/burger.jpg'),
       ('4629d912-423d-44be-9792-95a54a8d37ed',
        'Strawberries',
        10,
        'Yummy yummy strawberries, just delivered from the field',
        '/Public/Images/Articles/strawberries.jpg'),
       ('e94c5592-8f98-44cb-b62e-ccc3ff71ce30',
        'Pi',
        5,
        'A Rasperry Pi supply thing',
        '/Public/Images/Articles/pi.jpg'),
       ('86e033a3-a1dd-4f04-8bc4-a04fe2aa504b',
        'Storm trooper',
        12,
        'A storm trooper costume. Lightweight and nice to wear.',
        '/Public/Images/Articles/storm-trooper.jpg');

create table webshop.ShoppingCart
(
    shopping_cart_id varchar(36),

    PRIMARY KEY (shopping_cart_id)
);

insert into webshop.ShoppingCart (shopping_cart_id)
values ('67711d82-1c04-4edc-b0f6-050c3db818cf');

create table webshop.articles_in_cart
(
    shopping_cart_id varchar(36),
    article_id       varchar(36),
    count int,

    FOREIGN KEY (shopping_cart_id) references ShoppingCart (shopping_cart_id),
    FOREIGN KEY (article_id) references Article (article_id)
);

insert into webshop.articles_in_cart (shopping_cart_id, article_id, count)
values ('67711d82-1c04-4edc-b0f6-050c3db818cf', '0b5e61f3-2f66-43a1-aa7a-e1c2575c90a6', 1),
       ('67711d82-1c04-4edc-b0f6-050c3db818cf', '0b5e61f3-2f66-43a1-aa7a-e1c2575c90a6', 3);