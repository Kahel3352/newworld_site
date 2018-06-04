    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

    <!-- Bootstrap dropdown -->
    <script type="text/javascript" src="js/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
<header class="white-text">
    <nav class="navbar navbar-expand-lg #4caf50 green fixed-top scrolling-navbar">
        <div class="container">
            <a class="navbar-brand white-text" href="modules/c_main.php?page=reset">New World</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link white-text" href="modules/c_main.php?page=pages/acheter.php">Acheter <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link white-text" href="modules/c_main.php?page=pages/produire.php">Produire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link white-text" href="modules/c_main.php?page=pages/distribuer.php">Distribuer</a>
                    </li>
                    <li class="nav-item btn-group">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown 
                            </a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
                <!-- <a href="modules/c_main.php?page=login.php">Se connecter</a> -->
                <?php 
                session_start();
                    if(!isset($_SESSION['user'])) 
                        echo ' <button type="button" class="btn green" data-toggle="modal" data-target="#loginModal">
                    Se connecter
                </button>';
                    else
                        echo ' <a class="btn green" href="./scripts/login.php?out">
                    Se déconnecter
                </a>';
                ?>

            </div>
        </div>
    </nav>
</header>