
ALTER TABLE `product` ADD `status` BIT(1) NOT NULL AFTER `bidplaced`;
CREATE VIEW TRANSACTION AS
SELECT id, name, closingtime, minimumprice AS price, sellerid, buyerid, status FROM product P;
-- change all the product that considered past into number 1.