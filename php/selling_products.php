
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
                    <!-- <img src="/Users/ADMIN/Desktop/picture/-1591253249203679369585.jpg" width="105px"> -->
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
                <!-- <img src="/Users/ADMIN/Desktop/picture/pngtree-shopping-basket-line-icon-vector-png-image_1744039.jpg" width="30px" height="30px"> -->
            </div>
        </div>
    </div>
    <!-- sell the product part -->
    <div id = "boom">
        <form action="sell.php" method="post" class = "input" id = "form">
            <h1 style = "text-align: center"> Sell product</h1>
            <label for = "product_name">Product Name:</label>
            <input type = "text" name = "name"  id = "product_name"> <br>
            <label for = "opening_price">Opening price:</label>
            <input type = "number" name = "minimum_price" id = "minimum_price"><br>
            <label for = "closing_date">Closing day:</label>
            <input type = "Date" name="closing_date" value = "<?php echo date("Y-m-d") ?>"id = "closing_date"><br>
            <label for = "closing_hour">Closing Hour:</label>
            <input type = "number" name = "closing_hour" value = "0" min = "0" max = "24"  id = "closing_hour"><br>
            <label for = "closing_minute">Closing minute:</label>
            <input type = "number" name = "closing_minute" value = "0" min = "0" max = "60"  id = "closing_minute"><br>

            <button onclick = 'createDiv(0)' type = 'button' id = 'currentbutton_0'> + </button>
            <input type = "submit" value = "Sell" name ="sell">
        </form>

    </div>

    </body>
    <script type = "text/javascript">
        function createDiv(current_attribute)
    {
    var container = document.getElementById('form');
    var Key = document.createElement('div');
    var Value = document.createElement('div');
    var next_button = document.createElement("div");
    var current_button = document.getElementById('currentbutton_' + current_attribute);
    current_button.style.display = "none";
    Key.innerHTML = "<label for = 'key[" + current_attribute + "]'> Name of additional attribute</label><input type = 'text' name = 'key[" + current_attribute + "]' value = 'Name: '>";
    Value.innerHTML = "<label for = 'value[" + current_attribute + "]'>Content: </label><input type = 'text' name = 'value[" + current_attribute + "]' value = 'Description'>";
    next_button.innerHTML = "<button onclick = 'createDiv("+ (parseInt(current_attribute) + 1) + ")' type = 'button' id = 'currentbutton_"+ (parseInt(current_attribute) + 1) + "'> + </button>";
    container.appendChild(Key);
    container.appendChild(Value);
    container.appendChild(next_button);
    }
    </script>
</html>