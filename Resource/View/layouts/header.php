<?php
if(session()->email) {
?>

<div class="container-full bg-dark text-light">
    <div class="p-1">
        <a href="/dashboard" class="link link-light m-0">Dashboard</a>
        <a href="/settings" class="link link-light m-0">Settings</a>
        <a href="/" class="link link-light m-0">Website</a>
        <a href="/logout" class="link link-light m-0">Logout</a>
    </div>
</div>

<?php
}
?>