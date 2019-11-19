<?php
require_once 'core/init.php';
if (Sessions::exists('home')) {
    echo '<p>' . Sessions::flash('home') . '</p>';
}
?>
<a href="register.php">Register</a>
<a href="login.php">Login</a>