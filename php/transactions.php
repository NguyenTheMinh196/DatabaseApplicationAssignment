<!DOCTYPE html>
<html lang="en">
  <head>
    <!--addition js-->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!--font links-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap"
      rel="stylesheet"
    />
    <!--font links-->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/transaction.module.css" />
    <title>Account page</title>
  </head>
  <div id="nav-placeholder"></div>
  <body>
    <div class="transaction_container">
      <h1>Transactions</h1>
      <table>
        <tr>
          <th>Name</th>
          <th>transaction</th>
          <th>time</th>
        </tr>
        <tr>
          <td>john</td>
          <td>01</td>
          <td>11/7/2021</td>
        </tr>
        <tr>
          <td>john</td>
          <td>01</td>
          <td>11/7/2021</td>
        </tr>
      </table>
    </div>
  </body>
</html>
<script>
  $(function () {
    $("#nav-placeholder").load("index.html");
  });
</script>
