 <?php
require_once 'core/init.php';
<<<<<<< Updated upstream

$db = DB::getInstance()->insert('users', [
    'username' => 'teo',
    'password' => 'teopass',
    'salt' => 'salt',
=======
$db = DB::getInstance()->update('users', 3, [
    'password' => 'parolateo',
    'salt' => 'salt1',
>>>>>>> Stashed changes
]);

if ($_POST['submit']) {
    $username = $_POST['username'];

}

?>
<<<<<<< Updated upstream
<a href="register.php">Register</a>
 <form action="index.php" method="post">
     <div align="center">
         <input type="text" name="username">
         <input type="submit" name="submit">
     </div>
 </form>
=======

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
>>>>>>> Stashed changes
