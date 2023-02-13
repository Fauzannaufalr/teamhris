<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!----<title>Login Form Design | CodeLab</title>---->
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/styleadmin.css" type="text/css">
    <title>Login</title>
</head>

<body>
    <div class="pt" max-widt;>PT. SAHAWARE TEK <span>NOLOGI INDONESIA</span> </div>
    <div class="wrapper">
        <div class="title">Login Form</div>
        <form action="#">
            <div class="field">
                <input type="text" required>
                <label>Email Address</label>
            </div>
            <div class="field">
                <input type="password" required>
                <label>Password</label>
            </div>
            <div class="content">
                <div class="pass-link"><a href="#">Lupa Password?</a></div>
            </div>
            <div class="field">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>

</html>