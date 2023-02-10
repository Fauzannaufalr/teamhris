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
        <div class="title">Login</div>
        <form action="#">
            <div class="field">
                <input type="text" required>
                <label></label>
            </div>
            <div class="field">
                <input type="password" required>
                <label></label>
            </div>
            <div class="content">
                <div class="checkbox">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <div class="pass-link"><a href="#">Forgot password?</a></div>
            </div>
            <div class="field">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>

</html>