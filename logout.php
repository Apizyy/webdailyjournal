<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-danger fw-bold"
       href="#" role="button" data-bs-toggle="dropdown">
        <?= $_SESSION['username']; ?>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="admin.php?page=profile">
                Profile
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item text-danger" href="logout.php">
                Logout
            </a>
        </li>
    </ul>
</li>

<?php
session_start();
session_destroy();
header("location:login.php"); 
?>
