 <?php
require_once 'core/init.php';

if ($_POST['submit']) {
    $username = $_POST['username'];

    $db = DB::getInstance()->query("SELECT * FROM users WHERE username =?", [$username]);
    dnd($db);
}

?>

 <form action="index.php" method="post">
     <div align="center">
         <input type="text" name="username">
         <input type="submit" name="submit">
     </div>
 </form>