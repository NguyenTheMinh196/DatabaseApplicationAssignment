

<?php    
    $db_user = "root";
    $db_pass = "";  
    $db_name = "assignment";

    $sqldb = new PDO('mysql:host=localhost;dbname=' . $db_name .';charset=utf8',$db_user, $db_pass);
    $sqldb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $update = $sqldb->prepare('UPDATE users SET balance = ? WHERE ID = ?');
    $id = $_GET['user'];
    $getuser = $sqldb->query('SELECT U.firstname, U.username, U.phonenumber, U.email, U.ID, U.country, U.branch, U.balance FROM users U WHERE U.ID = '.$id);

   // get values form input text and number
   
   if(isset($_POST['update'])){
    $new_balance = $_POST['new_balance'];
    $status = $update->execute([$new_balance, $id]);
    $getuser = $sqldb->query('SELECT U.firstname, U.username, U.phonenumber, U.email, U.ID, U.country, U.branch, U.balance FROM users U WHERE U.ID = '.$id);
    echo('<div style = "position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border: 5px solid #FFFF00;
    padding: 10px;">
        You have updated the balance successfully
    </div>');
}

    
   // mysql query to Update data
//    $query = "UPDATE `users` SET `balance`='".$balance." WHERE `id` = $id";
   
//    $result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>

<html>

    <head>

        <title>  UPDATE BALANCE </title>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        <div>
            <h1>
                UPDATE BALANCE
            </h1>
        <?php
        $display = $getuser->fetch();
                    echo('<div>');
                    echo('Username:');
                    echo($display['username']);
                    echo('</div>');
                    echo('<div>');
                    echo("User's firstname:");
                    echo($display['firstname']);
                    echo('</div>');
                    echo('<div>');
                    echo('Phone number:');
                    echo($display['phonenumber']);
                    echo('</div>');
                    echo('<div>');
                    echo('Email:');
                    echo($display['email']);
                    echo('</div>');
                    echo('<div>');
                    echo('Country:');
                    echo($display['country']);
                    echo('</div>');
                    echo('<div>');
                    echo('Branch:');
                    echo($display['branch']);
                    echo('</div>');
                    echo('<div>');
                    echo('Current balance:');
                    echo($display['balance']);
                    echo('</div>');
                ?>
                <br>
                <br>
        <form method="post">
            Balance to Update:<input type="number" name="new_balance" min = "0" required><br><br>
            <input type="submit" name="update" value="Update balance"> 
        </form>

    </body>


</html>
 
					