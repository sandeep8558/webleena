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
                    <a class="nav-link <?php echo $p == '/admin/dashboard' ? 'active' : '' ?>" href="/admin/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/admin/settings' ? 'active' : '' ?>" href="/admin/settings">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/admin/user' ? 'active' : '' ?>" href="/admin/user">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/admin/pages' ? 'active' : '' ?>" href="/admin/pages">Pages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/admin/navigation' ? 'active' : '' ?>" href="/admin/navigation">Navigation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/admin/layout' ? 'active' : '' ?>" href="/admin/layout">Layout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $p == '/admin/elements' ? 'active' : '' ?>" href="/admin/elements">Elements</a>
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