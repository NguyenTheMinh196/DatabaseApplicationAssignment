<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bidme - Online Bidding Platform</title>
        <link rel="stylesheet" href="../css/bid.module.css">
        
    </head>
    
    <body>
        <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="/Users/ADMIN/Desktop/picture/-1591253249203679369585.jpg" width="105px">
                </div>
                <nav>
                    <ul>
                        <li><a href="">HOME</a></li>
                        <li><a href="">PRODUCTS</a></li>
                        <li><a href="">ABOUT</a></li>
                        <li><a href="">CONTACT</a></li>
                        <li><a href="">ACCOUNT</a></li>

                    </ul>
                </nav>
                <img src="/Users/ADMIN/Desktop/picture/pngtree-shopping-basket-line-icon-vector-png-image_1744039.jpg" width="30px" height="30px">
            </div>
        </div>
    </div>
    <!-- sell the product part -->
    <div>
        <form action="sell.php" method="post">
            <h1 style = "text-align: center"> Sell product</h1>
            <label for = "product_name">Product Name:</label>
            <input type = "text" name = "product_name" value = "Name" id = "product_name"> <br>
            <label for = "opening_price">Opening price:</label>
            <input type = "number" name = "opening_price" value = "0" id = "opening_price"><br>
            <label for = "closing_date">Closing date:</label>
            <input type = "Date" name="closing_date" value="2021-07-26" id = "closing_date"><br>
            <label for = "closing_hour">Closing hour:</label>
            <input type = "number" name = "closing_hour" value = "0" min = "0" max = "24"  id = "closing_hour"><br>
            <input type = "submit" value = "Sell">
        </form>
    </div>
    </body>
</html>