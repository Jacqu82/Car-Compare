<div class="container">
    <div class="navbar-header">
        <div class="container text-center">
            <div class="navbar-header">
                <a class="navbar-brand" href="../web/index.php">
                    <img src="../public/content/logo/logo.png" alt="logo" width="200"/>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['admin'])): ?>
                        <li><a href="../admin/adminPanel.php">Strona główna Admina</a></li>
                        <li><a href="../admin/logout.php">Wyloguj</a></li>
                    <?php else: ?>
                        <li><a href="../web/carIndexPage.php">Autka</a></li>
                        <li><a href="../web/motorCycleIndexPage.php">Motorki</a></li>
                        <li><a href="../admin/adminLoginForm.php">Admin</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<hr/>