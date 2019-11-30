 <?php
require_once 'core/init.php';
$db = DB::getInstance();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];

}

?>

 <!DOCTYPE html>
 <html lang="en">

     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <title>Document</title>
     </head>

     <body>
         <form action="index.php" method="post">
             <div align="center">
                 <a href="register.php">Register</a>
                 <input type="text" name="username">
                 <input type="submit" name="submit">
             </div>
         </form>
     </body>

 </html>