<?php
$session = Core\Session::getInstance();
$settings = new Core\Data('settings');
$settings = $settings->all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.bundle.js" defer></script>
    
<title>Login</title>

</head>
<body>
<div id="app">

<?php
if(isset($session->email)){
    include '../Resource/View/layouts/header.php';
}
?>



<div class="container">
    <div class="row justify-content-center align-items-center m-0 vh-100">

        <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 p-0 h-auto">

            <div class="shadow rounded-4">

                <h3 class="text-center bg-primary text-light p-4 mb-0 rounded-top-4">Sign In</h3>

                <form action="/authenticate" method="post" class="rounded-bottom-4 p-4">
                    
                    <div class="form-floating mb-4">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="form-floating">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                        <a class="d-inline-block btn btn-link" href="/forgot">Forgot Password</a>
                    </div>
                    
                </form>
                
            </div>

            <div class="p-3 text-center">Powered By <strong>WebLeena</strong></div>

        </div>

    </div>
</div>



</div>
</body>
</html>