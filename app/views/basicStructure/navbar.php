<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="description" content="Navbar - Part">
    <meta name="author" content="Ignacio Esaú Nevarez Zúñiga">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <script type="text/javascript"> 
        $(document).ready(function() {
            $(".navbar-nav a").filter(function() {
                return this.href==location.href
            }).parent().addClass('active').siblings().removeClass('active')
        });
    </script> 

    <title>Navbar</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <h2 class="navbar-brand font-weight-bold"><?php echo SITENAME?></h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link mt-2" href="<?php echo URLROOT; ?>/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-2" href="<?php echo URLROOT; ?>/share">Share</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/logIn">
                        <button type="button" class="btn btn-dark text-warning">Log Out</button>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>