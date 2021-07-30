-- * Table Creation Queries
create table cart (
    id int primary key AUTO_INCREMENT,
    battery_percentage float,
    `status` varchar(32)
);

create table brand (
    id int primary key AUTO_INCREMENT,
    `name` varchar(64)
);

create table product (
    id int primary key AUTO_INCREMENT,
    barcode varchar(12),
    price float,
    `weight` float,
    brand_id int,
    category_id int,
    foreign key (brand_id) references brand(id) on delete cascade,
    foreign key (category_id) references category(id) on delete cascade
);

create table cart_product (
    id int primary key AUTO_INCREMENT,
    quantity int,
    cart_id int,
    product_id int,
    foreign key (cart_id) references cart(id) on delete cascade,
    foreign key (product_id) references product(id) on delete cascade
);

create table stock (
    product_id int,
    quantity int,
    foreign key (product_id) references product(id) on delete cascade
);

create table `user` (
    id int primary key AUTO_INCREMENT,
    `name` varchar(64),
    email varchar(128),
    `password` varchar(128),
    `role` varchar(16)
);

create table category (
    id int primary key AUTO_INCREMENT,
    `name` varchar(64)
);

create table sale(
    id int primary key AUTO_INCREMENT,
    payment_methood VARCHAR(32),
    bill float,    
    bill_date varchar(32)
);

create table discount (
    id int primary key AUTO_INCREMENT,
    product_id int, 
    discount_percentage float,
    foreign key (product_id) references product(id)
);


create table sale_return(
    
);


create table register(

);




-- * Table Alter Queries
-- ** Product Alter
alter table product
add unique (barcode);

alter table product
add column `times_sold` int;

alter table product
add column `name` varchar(256) after `id`;

-- ** cart product bridge
alter table cart_product
drop column `quantity`;

-- ** Cart Alter
alter table cart
add column `weight` float
default 0;

-- ** Sale Alter


-- ** User Alter
alter table `user`
add column `salary` float;

-- ** Discount Alter
alter table `discount`
add column `from` varchar(32);

alter table `discount`
add column `to` varchar(32);


-- * Table Update Queries
