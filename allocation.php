<?php
session_start();
include('db.php');
if(isset($_SESSION['user'])){ ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Allocation</title>
            <link rel="stylesheet" type="text/css" href="style.css">
            <nav class="navbar">
                <div class="navdiv">
                    <div class="logo"><a href="#">dfy</a></div>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="transaction.php">New transaction</a></li>
                        <li><a href="balances.php">Edit balances</a></li>
                        <li><a href="#">Edit allocation</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </head>
        <body>
            <form action="allocation_backend.php" method="post">
                <?php 
                if(isset($_GET['error'])){ ?>
                    <p class="error"> <?php echo $_GET['error']; ?></p>
                <?php }
                if(isset($_GET['success'])){ ?>
                <p class="success"> <?php echo $_GET['success']; ?></p>
                <?php } ?>
                <label for="needsPrcnt">Needs: <?php echo $_SESSION['needsPercent'] ?>%</label>
                <input type="number" step = "0.01" name="needsPrcnt" placeholder="Percentage towards needs"><br>
                <label for="savingsPrcnt">Savings: <?php echo $_SESSION['savingsPercent'] ?>%</label>
                <input type="number" step = "0.01" name="savingsPrcnt" placeholder="Percentage towards savings"><br>
                <label for="investPrcnt">Investments: <?php echo $_SESSION['investPercent'] ?>%</label>
                <input type="number" step = "0.01" name="investPrcnt" placeholder="Percentage towards investments"><br>
                <label for="wantsPrcnt">Wants: <?php echo $_SESSION['wantsPercent'] ?>%</label>
                <input type="number" step = "0.01" name="wantsPrcnt" placeholder="Percentage towards wants"><br>
                <button class="button-style" type="submit" name="allocationSubmit">Submit</button>
            </form>
        </body>
    </html>
    <?php
}
else{
    header("Location: index.php");
} ?>
