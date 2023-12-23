<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <script src="/js/app.js"></script>
    
<title>Login</title>

</head>
<body>

<?php
include '../Resource/View/layouts/header.php';
?>



<div class="container-full vh-100 flex justify-center align-center p-10">
    <div class="w-100 w-80-sm w-60-md w-50-lg w-40-xl w-30-xxl">

        <div class="rounded-10 shadow-4">

            <div class="container text-center uppercase bg-primary text-light p-10 rounded-top-10">
                <h1 class="font-size-12">Sign in</h1>
            </div>

            <form action="/authenticate" method="post" class="p-15">

                <div class="mb-12">
                    <label for="email" class="d-block mb-3">Email</label>
                    <input type="text" name="email" id="email" class="font-size-11 d-block w-100 p-6">
                </div>

                <div class="mb-12">
                    <label for="password" class="d-block mb-3">Password</label>
                    <input type="password" name="password" id="password" class="font-size-11 d-block w-100 p-6">
                </div>

                <div>
                    <input type="submit" value="Sign In" class="btn btn-primary border-none">
                    <a href="/forgot" class="float-right font-size-10 link">Forgot Password</a>
                </div>

            </form>

        </div>

        <div class="p-10 text-center opacity-75">Powered by <b>WEBLEENA</b></div>

    </div>
</div>



</body>
</html>