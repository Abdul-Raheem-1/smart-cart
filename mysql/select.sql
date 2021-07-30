select * from `user`;

SELECT * FROM product;

SELECT * FROM cart;

SELECT * FROM cart_product;

UPDATE cart SET `weight` = 0 WHERE id = 1;
DELETE FROM cart_product where cart_id > 0;

SELECT * FROM stock;

SELECT * FROM discount;
INSERT INTO discount VALUES (null, 1, 0.2, '29-07-2021', '30-07-2021');

SELECT * FROM brand;

SELECT * from sale;

create view vw_product_details as 
select p.id, p.name as product_name, b.name as brand_name, c.name as category_name, s.quantity
from product as p
inner join brand as b
on p.brand_id = b.id
inner join category as c
on c.id = p.category_id
left join stock as s
on p.id = s.product_id;

select * from vw_product_details;

Select *, count(cp.product_id) as quantity, d.discount_percentage
from discount as d
right join cart_product as cp
on d.product_id = cp.product_id 
where cart_id = 1
group by cp.product_id;

select sum(p.`weight`) as total_weight
from cart_product as cp
inner join product as p
on p.id = cp.product_id
where cart_id = 1;

select `weight`
from cart
where id = 1;


select product.name, category.name as category_name, brand.name as brand_name, stock.quantity
from product
inner join category
on product.category_id = category.id
inner join brand
on product.brand_id = brand.id
left join stock
on product.id = stock.product_id;

SELECT * FROM stock;


select count(distinct cart_id) as total_active_carts
from cart_product;

select id from cart where `status` = "Active";

UPDATE cart SET `status` = "Active" WHERE id = 2;

select count(cart_id) as items_in_cart
from cart_product
where cart_id = 1;

select discount_percentage * 100, product.name, product.barcode 
from discount
inner join product
on product.id = discount.product_id
where product.barcode = '102030405060';

SELECT d.discount_percentage * 100 as disc_perc, s.quantity as quantity
from discount as d
inner join product as p
on p.id = d.product_id
inner join stock as s
on s.product_id = p.id
where p.barcode = '102030405062';

SELECT count(id) as `idle_carts`
from cart
where status = 'idle';

SELECT `name`, price, discount_percentage
FROM discount
right join cart_product
on discount.product_id = cart_product.product_id
inner join product
on product.id = cart_product.product_id
where cart_product.cart_id = 1;

select p.`id`, p.`name` as product_name, b.`name` as brand_name, times_sold
from product as p
inner join brand as b
on p.brand_id = b.id
ORDER BY price desc;

select p.id, p.price, coalesce(d.discount_percentage, 0),
    count(p.id) as quantity, p.price - (p.price * coalesce(d.discount_percentage, 0)) as discounted_price,
    (p.price - (p.price * coalesce(d.discount_percentage, 0))) * count(p.id) as total
from cart_product as cp
inner join product as p
on cp.product_id = p.id
left join discount as d
on d.product_id = p.id
where cp.cart_id = 1
group by p.id;


select 
sum(p.price - (p.price * coalesce(d.discount_percentage, 0))) * 
                                    ( select count(cart_product.product_id)
                                        from cart_product
                                        WHERE cart_id = 1 and product_id = p.id ) as total
from cart_product as cp
inner join product as p
on cp.product_id = p.id
left join discount as d
on d.product_id = p.id
where cp.cart_id = 1;