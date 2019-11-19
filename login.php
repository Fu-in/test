<?php
require_once 'core/init.php';

if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'username' => ['required' => true],
        'password' => ['required' => true],
    ]);

    if ($validation->passed()) {
        $user = new User();
        $login = $user->login(Input::get('username'), Input::get('password'));

        if ($login) {
            echo 'Success';
        } else {
            echo 'Log in fail';
        }

    } else {
        foreach ($validation->errors() as $error) {
            echo $error . '<br>';
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="container">


            <form action="login.php" method="post" class="form-horizontal" autocomplete="off">
                <h3 class="text-center">Login</h3>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="text" readonly onfocus="this.removeAttribute('readonly');"
                            class="form-control input" placeholder="Username" name="username" value="" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="password" readonly onfocus="this.removeAttribute('readonly');"
                            class="form-control input" placeholder="Password" autocomplete="new-password"
                            name="password" />
                    </div>
                </div>


                <div class="col-sm-4">

                    <input type="submit" class="btn btn-block btn-primary btn-sm" value="Login">
                </div>
        </div>

        </form>
        </div>


    </body>

</html>