<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <!----<title>Login Form Design | CodeLab</title>---->
    <link rel="stylesheet" href="<?= base_url('dist/css/styleadmin.css') ?>" />
</head>

<body>
    <div class="wrapper">
        <small>Silahkan</small>
        <div class="title" style="text-align: left;">Login</div>
        <form action="#">
            <div class="field">
                <input type="text" required>
                <label>username</label>
            </div>
            <div class="field">
                <input type="password" required>
                <label>Password</label>
            </div>
            <div class="field" style="text-align: right;">
                <div class="pass-link"><a href="#">Lupa Password?</a></div>
            </div>
            <div class="field">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>

</html>