<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.bundle.js" defer></script>
    
<title>User Manager</title>

</head>
<body>
<div id="app">

<?php
include '../Resource/View/layouts/header.php';
?>



<crud file="auth" title="User Manager" btn="Add User" color="warning"></crud>



</div>
</body>
</html>