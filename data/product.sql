CREATE TABLE `product` (
  `name` varchar(30) NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `minimumprice` int(20) NOT NULL,
  `closingtime` DATETIME NOT NULL,
  `sellerid` int(100) NOT NULL,
  `buyerid` int(100),
  `bidplaced` int(100) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SET time_zone = '+07:00'
INSERT INTO `product` (`name`, `id`, `minimumprice`, `closingtime`, `sellerid`, `buyerid`, `bidplaced`) VALUES
("rolex", 1, 15000000, '2021-08-31', 12341245 , 2147483647, 1),
("drone", 2, 3000000, '2021-09-02', 2147483647, 12341245, 2),
("Honeypot", 3, 150000, '2021-08-31', 12341245, 2147483647, 1))
  UPDATE product set bidplaced = bidplaced + 1;

DELIMITER $$
CREATE TRIGGER minimumprice_update
BEFORE UPDATE ON product.minimumprice
AS
begin
  UPDATE product set bidplaced = bidplaced + 1 WHERE id = NEW.id;
  IF OLD.minimumprice >= NEW.minimumprice THEN
  SIGNAL SQLSTATE '45000' set message_text = "the new bid price must be higher than the minimum price";
  END IF;
  IF OLD.minimumprice < NEW.minimumprice THEN
  END IF;
  END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER minimumprice_update
BEFORE UPDATE ON product.minimumprice
AS BEGIN
  IF minimumprice >= NEW.minimumprice THEN
  SIGNAL SQLSTATE '45000' set message_text = "the new bid price must be higher than the minimum price";
  END IF;
  IF minimumprice < NEW.minimumprice THEN
  END IF;
END $$
DELIMITER ;

//
BID TRANSACTION: 
DELIMITER //
CREATE PROCEDURE bid (IN userID char(9), IN productID INT, IN bidprice INT)
BEGIN
	DECLARE productbuyerid INT;
    DECLARE productprice INT;
	START TRANSACTION;
  	INSERT INTO WORKS_ON VALUES (employeeID, projectNumber, numberHours);
        SELECT buyerid, price INTO productbuyerid, productprice FROM transaction WHERE id = productID;
		IF  productbuyerid = userID THEN
			UPDATE users SET balance = balance + productprice - bidprice WHERE ID = productbuyerid;
            UPDATE product SET minimumprice = bidprice WHERE id = productID;
		ELSE
        	IF productprice = NULL THEN
			UPDATE users SET balance = balance - bidprice WHERE ID = userID;
            UPDATE product SET minimumprice = bidprice WHERE id = productID;
            		COMMIT;

            ELSE
            UPDATE users SET balance = balance - bidprice WHERE ID = userID;
            UPDATE product SET minimumprice = bidprice WHERE id = productID;
            UPDATE users SET balance = balance + productprice WHERE ID = productbuyerid;
					COMMIT;
            END IF;
		END IF;
END //
DELIMITER ;