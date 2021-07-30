
-- * User Triggers
-- ** if user tries to insert a super admin
create trigger tr_user_beforeInsert 
before insert 
on `user` for each row
BEGIN

if 
NEW.role = 'superadmin' then set NEW.role = NULL;
end if;

END;


-- ** if user tries to update role to super admin
create trigger tr_user_beforeUpdate 
before update 
on `user` for each row
BEGIN

if 
NEW.role = 'superadmin' then set NEW.role = OLD.role;
end if;

END;

-- * Cart Triggers
create trigger tr_cart_product_afterInsert
after insert
on `cart_product` for each row
BEGIN

--? Update cart's weight
--?? Var Declartion
declare product_weight float;
declare old_cart_weight float;
declare new_cart_weight float;
--?? Var Init
set old_cart_weight = (SELECT `weight` from cart where id = NEW.`cart_id`);
set product_weight = (SELECT `weight` from product where id = NEW.`product_id`);
set new_cart_weight = old_cart_weight + product_weight;
--?? Update Weight
update cart set `weight` = new_cart_weight where id = NEW.`cart_id`;

--? Update cart's status
if (select `status` from cart where id = NEW.`cart_id`) = 'Idle'
then
update cart set `status` = 'Active' where id = NEW.`cart_id`;
end if;

END;

drop trigger tr_cart_product_afterInsert;


create trigger tr_cart_product_afterDelete
after delete
on `cart_product` for each row
BEGIN

--? Update cart's weight
--?? Var Declartion
declare product_weight float;
declare old_cart_weight float;
declare new_cart_weight float;
--?? Var Init
set old_cart_weight = (SELECT `weight` from cart where id = OLD.cart_id);
set product_weight = (SELECT `weight` from product where id = OLD.product_id);nset new_cart_weight = old_cart_weight - product_weight;
--?? Update cart's weight
update cart set `weight` = new_cart_weight where id = OLD.cart_id;

--? Update cart's status
if ((select count(cart_id) as items_in_cart
from cart_product
where cart_id = OLD.`cart_id` ) = 0)
then
update cart set `status` = 'Idle' where id = OLD.cart_id;
end if;

END;

