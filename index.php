 <?php
require_once 'core/init.php';

$db = DB::getInstance()->insert('users', [
    'username' => 'teo',
    'password' => 'teopass',
    'salt' => 'salt',
]);

if ($_POST['submit']) {
    $username = $_POST['username'];

}

?>

 <form action="index.php" method="post">
     <div align="center">
         <input type="text" name="username">
         <input type="submit" name="submit">
     </div>
 </form>