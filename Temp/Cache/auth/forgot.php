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
    include '../Resource/View/layouts/admin.header.php';
}
?>



<div class="container">
    <div class="row justify-content-center align-items-center m-0 vh-100">

        <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 p-0 h-auto">

            <forgot-password></forgot-password>

            <div class="p-3 text-center">Powered By <strong>WebLeena</strong></div>

        </div>

    </div>
</div>



</div>
</body>
</html>