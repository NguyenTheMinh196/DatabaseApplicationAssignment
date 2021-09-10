
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

<<<<<<< HEAD
DELIMITER $$
        CREATE PROCEDURE refund (IN transactionID INT)
        BEGIN
        DECLARE productbuyerid INT;
        DECLARE productsellerid INT;
        DECLARE productprice INT;
        START TRANSACTION;
        SELECT sellerid INTO productsellerid, buyerid INTO productbuyerid, price INTO productprice FROM transaction WHERE id = transactionID;
        IF transaction.status="sold" THEN
        UPDATE users SET balance  = balance + productprice WHERE ID=productbuyerid;
        UPDATE users SET balance  = balance - productprice WHERE ID=productsellerid;
        COMMIT;
        ELSEIF transaction.status="not sold" THEN
        UPDATE users SET balance  = balance + productprice WHERE ID=productbuyerid;
        COMMIT;
        END IF;
                
        END $$
        DELIMITER ;
=======
CREATE PROCEDURE trade (IN productID INT)
BEGIN
	DECLARE currentbuyerid INT;
    DECLARE productprice INT;
	DECLARE currentsellerid INT;

	START TRANSACTION;
        SELECT buyerid, price, sellerid INTO currentbuyerid, productprice, currentsellerid FROM transaction WHERE id = productID;
		IF  currentbuyerid <> NULL THEN
			UPDATE users SET balance = balance - productprice WHERE ID = currentbuyerid;
			UPDATE users SET balance = balance + productprice WHERE ID = currentsellerid;
			UPDATE product SET status = "sold" WHERE id = productID;
            COMMIT;
		ELSEIF (currentbuyerid = NULL) THEN
			UPDATE product SET status = "canceled" WHERE id = productID;
            COMMIT;
        END IF;
END
>>>>>>> c787497b86ddaf6326146a3b5b7d53b9d712cdc1
