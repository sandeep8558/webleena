<?php
if(session()->email) {
?>

<?php $p = strtok($_SERVER['REQUEST_URI'], "?"); ?>

<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid px-5">

        <a class="navbar-brand" href="/"><i class="bi bi-globe-central-south-asia"></i></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/dashboard' ? 'active' : '' ?>" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/settings' ? 'active' : '' ?>" href="/settings">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/user' ? 'active' : '' ?>" href="/user">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/pages' ? 'active' : '' ?>" href="/pages">Pages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/navigation' ? 'active' : '' ?>" href="/navigation">Navigation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/layout' ? 'active' : '' ?>" href="/layout">Layout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/elements' ? 'active' : '' ?>" href="/elements">Elements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<?php
}
?>