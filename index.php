<?php
require_once 'core/init.php';
if (Sessions::exists('home')) {
    echo '<p>' . Sessions::flash('home') . '</p>';
}
$user = new User();
if ($user->isLoggedIn()) {
    echo 'Logged In';
}
?>
<a href="register.php">Register</a>
<a href="login.php">Login</a>