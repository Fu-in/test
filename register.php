<?php
require_once 'core/init.php';

if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'username' => [
            'required' => true,
            'min' => 3,
            'max' => 20,
            'unique' => 'users',
        ],
        'password' => [
            'required' => true,
            'min' => 6,
        ],
        'password_again' => [
            'required' => true,
            'matches' => 'password',
        ],
        'name' => [
            'required' => true,
            'min' => 3,
            'max' => 20,
        ],
    ]);

    if ($validation->passed()) {
        echo 'Passed';
        $_POST['username'] = '';
        $_POST['name'] = '';
    } else {
        dnd($validation->errors());
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
        <link rel="stylesheet" href="css/custom.css">
    </head>

    <body>
        <div class="container">
            <h2 align="center">Register</h2>
            <form method="post" action="" class="form-horizontal">
                <input type="password" style="display:none">
                <input type="text" id="username" style="display:none">

                <div class="form-group">
                    <label class="control-label col-sm-2" for="username">Username:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                            autocomplete="false" value="<?=@Input::get('username');?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password:</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password_repeat">Password repeat:</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control" name="password_again" id="password_again"
                            placeholder="Password repeat">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Name:</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                            value="<?=@Input::get('name');?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-3">
                        <button type="submit" class="btn btn-sm btn-block btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </body>

</html>