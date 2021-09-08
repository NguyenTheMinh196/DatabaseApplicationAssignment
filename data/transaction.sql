
ALTER TABLE `product` ADD `status` BIT(1) NOT NULL AFTER `bidplaced`;
CREATE VIEW TRANSACTION AS
SELECT id, name, closingtime, minimumprice AS price, sellerid, buyerid, status FROM product P;
-- change all the product that considered past into number 1.
CREATE PROCEDURE bid (IN userID INT, IN productID INT, IN bidplaced INT)
BEGIN
	DECLARE currentproductbuyerid INT;
    DECLARE productprice INT;
	START TRANSACTION;

        SELECT buyerid, price INTO currentproductbuyerid, productprice FROM transaction WHERE id = productID;
		IF  currentproductbuyerid = userID THEN
			UPDATE users SET balance =(balance + productprice - bidprice) WHERE ID = userID;
            UPDATE product SET minimumprice = bidprice, buyerid = userID, bidplaced = bidplaced + 1 WHERE id = productID;
            
            COMMIT;
		ELSEIF (currentproductbuyerid = NULL) THEN
				UPDATE users SET balance = (balance - bidprice) WHERE ID = userID;
            	UPDATE product SET minimumprice = bidprice, buyerid = userID, bidplaced = bidplaced+1 WHERE id = productID;
                
            	COMMIT;

            ELSE
            	UPDATE users SET balance = (balance - bidprice) WHERE ID = userID;
            	UPDATE users SET balance = (balance + productprice) WHERE ID = currentproductbuyerid;
            	UPDATE product SET minimumprice = bidprice, buyerid = userID, bidplaced = bidplaced +1 WHERE id = productID;
           		
					COMMIT;
            END IF;
END