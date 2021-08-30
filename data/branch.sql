CREATE TABLE `branch` (
  `branchname` varchar(30) NOT NULL,
  `branchcode` int(100) NOT NULL,
  `address` varchar(60) NOT NULL,
  `hotlinenumber` varchar(10) NOT NULL,
  PRIMARY KEY(branchcode)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `branch` (`branchname`, `branchcode`, `address`, `hotlinenumber`) VALUES
("Ha noi branch 1", 01, "Ha noi", "09121212121"),
("Ho Chi Minh branch 1", 02, "Ho Chi Minh", "09212121212");
