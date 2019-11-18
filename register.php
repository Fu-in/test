<?php
require_once 'core/init.php';
if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'username' => [
            'required' => true,
            'min' => 3,
            'max' => 20,
            'unique_username' => 'users',
        ],
        'email' => [
            'required' => true,
            'valid_email' => true,
            'unique_email' => 'users',
        ],
        'password' => [
            'required' => true,
            'min' => 6,
        ],
        'passwordConfirm' => [
            'required' => true,
            'matches' => 'password',
        ],
    ]);

    if ($validation->passed()) {
        $user = new User();
        $salt = Hash::salt(6);
        try {
            $user->create([
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'password' => Hash::make(Input::get('password'), $salt),
                'salt' => $salt,
                'joined' => date('Y-m-d H:i:s'),
            ]);
        } catch (Exception $th) {
            die($th->getMessage());
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


            <form action="register.php" method="post" class="form-horizontal" autocomplete="off">
                <h3 class="text-center">Register</h3>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="text" readonly onfocus="this.removeAttribute('readonly');"
                            class="form-control input" placeholder="Username" name="username"
                            value="<?=Input::get('username');?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="email" readonly onfocus="this.removeAttribute('readonly');"
                            class="form-control input" placeholder="Email" name="email"
                            value="<?=Input::get('email');?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="password" readonly onfocus="this.removeAttribute('readonly');"
                            class="form-control input" placeholder="Password" autocomplete="new-password"
                            name="password" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <input type="password" readonly onfocus="this.removeAttribute('readonly');"
                            class="form-control input" placeholder="Password confirm" name="passwordConfirm" />
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-4">
                        <!-- <input type="text" name="" name="token" value="<?=Token::generate();?>"> -->
                        <input type="submit" class="btn btn-block btn-primary btn-sm" value="Submit">
                    </div>
                </div>

            </form>
        </div>


    </body>

</html>