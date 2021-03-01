<html>
    <?php
    include_once "connect.php";

    if (isset($_GET["error-text"])) {
        $error = $_GET["error-text"];
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["login-btn"])) {
            //Auth user here
            $login_username = $_POST["login-username"];
            $login_password = md5($_POST["login-password"]);

            $sql = "SELECT * FROM users WHERE username='" . $login_username . "'";
            $result = mysqli_query($db_connect, $sql);

            if (!$result) {
                echo "<script type='text/javascript'>alert('" . mysqli_error($db_connect) . "');</script>";
            } else {
                if (mysqli_num_rows($result) > 0) {
                    //Got user
                    $row = mysqli_fetch_assoc($result);
                    if ($login_password == $row["password"]) {
                        //Login success, redirect (Current is placeholder)
                        $error = "Successful login!";
                        setcookie("session_username", $login_username);
                        setcookie("session_password", $login_password);
                        header("Location: ./admin_view_all.php");
                    } else {
                        //Wrong password
                        $error = "<strong>Wrong passsword or username.</strong> Please try again";
                    }

                } else {
                    //User does not exist
                    $error = "<strong>Wrong passsword or username.</strong> Please try again";
                }
            }
        }
    }
    ?>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="./css/styles.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
        <script src="./js/animations.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Innovate Training - Login</title>
    </head>


    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container bg-light">
            <a class="navbar-brand" href="./index.php">Innovate Training</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="course_info.php">Courses</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container main">
        <?php
        if (isset($error)) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show mt-3 mb-0 slidein-right' role='alert'>
                ". $error . "
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            ";
        }
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="login-username"><b>Username</b></label>
                                <input type="text" id="login-username" name="login-username" class="custom-input full-field" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="login-password"><b>Password</b></label>
                                <input type="password" id="login-password" name="login-password" class="custom-input full-field" placeholder="Password" required>
                            </div>
                            <input type="submit" class="custom-btn full-btn mb-0" id="login-btn" name="login-btn" value="Login">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Admin Page - Restricted access</h5>
                        <p class="card-text">Please log-in to view the admin panel</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="my-5">
        <p data-toggle="modal" data-target="#secret-modal">Innovate Training - 2021</p>
    </footer>

    <!-- Secret stuff :) -->
    <div class="modal fade" tabindex="-1" role="dialog" id="secret-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Secret dialog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe width="470" height="315" src="https://www.youtube.com/embed/XeK_I0XQW6U" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="custom-btn" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    </body>
</html>