<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img src="image/logo.jpg" alt="logo" height="80px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    خانه
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php">خانه<span class="sr-only">(current)</span></a>
                    <?php if(!isset($_SESSION['login'])){ ?>
                        <a class="dropdown-item" href="login.php">ورود</a>
                        <a class="dropdown-item" href="register.php">ثبت نام</a>
                    <?php }else{ ?>
                        <a class="dropdown-item" href="logout.php">خروج</a>

                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 2): ?>
                            <a class="dropdown-item" href="admin/index.php">ادمین</a>
                        <?php endif; ?>

                    <?php } ?>

                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="category/literature.php">ادبیات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="category/cinema.php">سینما</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="category/art.php">هنر</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="category/history.php">تاریخ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="category/philosophy.php">فلسفه</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="category/recipe.php">آشپزی</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="weatherapp/weather.php">آب و هوا</a>
            </li>
        </ul>
    </div>
</nav>
