<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/vue.global.prod.js"></script>
    <script src="/js/app.bundle.js" defer></script>
    
<title>Settings</title>

</head>
<body>
<div id="app">

<?php
include '../Resource/View/layouts/header.php';
?>



<h1 class="text-center m-12">Settings</h1>

<Settings :settings='<?php parseInterpolation($settings) ?>' :fields='<?php parseInterpolation($fields) ?>'></Settings>



</div>
</body>
</html>