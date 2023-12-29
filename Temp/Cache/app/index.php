<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.bundle.js" defer></script>
    
<title>Demo Page</title>

</head>
<body>
<div id="app">

<?php
include '../Resource/View/layouts/header.php';
?>



<h1><?php parseInterpolation($settings['brand']) ?></h1>

<h1><?php parseInterpolation($settings['tag']) ?></h1>

<h1><?php parseInterpolation($settings['mobile']) ?></h1>



</div>
</body>
</html>