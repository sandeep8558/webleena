<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <script src="/js/app.js"></script>
    
<title>Settings</title>

</head>
<body>

<?php
include '../Resource/View/layouts/header.php';
?>



<h1 class="text-center m-12">Settings</h1>

<div class="container shadow-4 rounded-8 p-15 m-12">

<?php foreach($settings as $k=>$v): ?>

<div class="p-10">
    <span class="capitalize"><?php echo $k; ?></span> : <?php echo input($fields[$k], $k, $v); ?>
</div>

<?php endforeach; ?>

</div>



</body>
</html>