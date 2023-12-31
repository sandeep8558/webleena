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
    <link rel="icon" type="image/x-icon" href="<?php echo $settings['favicon']; ?>">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.bundle.js" defer></script>
    <title><?php echo $page['title']; ?></title>
    <meta name="keywords" content="<?php echo $page['keywords']; ?>" />
    <meta name="description" content="<?php echo $page['description']; ?>" />
</head>
<body>
<div id="app">

<div>
<?php
if(isset($session->email)){
    include '../Resource/View/layouts/admin.header.php';
}
?>
</div>

<div>
<?php
include '../Resource/View/layouts/header.php';
?>
</div>

<div>
<?php
include '../Resource/View/layouts/content.php';
?>
</div>

<div>
<?php
include '../Resource/View/layouts/footer.php';
?>
</div>



</div>
</body>
</html>