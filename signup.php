<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signup</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <nav class="navbar">
            <div class="navdiv">
                <div class="logo"><a href="#">dfy</a></div>
                <ul>
                    <li><a href="index.php">Log In</a></li>
                </ul>
            </div>
        </nav>
    </head>
    <body>
        <form action="signup_backend.php" method="post">
            <h1>Welcome to dontforgetwhy! Please sign up.</h1>
            <?php if(isset($_GET['error'])){ ?>
                <p class="error"> <?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if(isset($_GET['success'])){ ?>
                <p class="success"> <?php echo $_GET['success']; ?></p>
            <?php } ?>
            <label>Username</label>
            <input type="text" name="username" placeholder="Username"><br>
            <label>Password</label>
            <input type="password" name="password" placeholder="Password"><br>
            <button class="button-style" type="submit" name="signup">Sign up</button>
        </form>
    </body>
</html>
