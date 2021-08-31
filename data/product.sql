CREATE TABLE `product` (
  `name` varchar(30) NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `minimumprice` int(20) NOT NULL,
  `closingtime` DATETIME NOT NULL,
  `sellerid` int(100) NOT NULL,
  `buyerid` int(100),
  `bidplaced` int(100),
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SET time_zone = '+07:00'
INSERT INTO `product` (`name`, `id`, `minimumprice`, `closingtime`, `sellerid`, `buyerid`, `bidplaced`) VALUES
("rolex", 1, 15000000, '2021-08-31', 12341245 , 2147483647, 1)
("drone", 2, 3000000, '2021-08-32', 2147483647, 12341245, 2)
("rolex", 3, 15000000, '2021-08-31', 12341245, 2147483647, 1)