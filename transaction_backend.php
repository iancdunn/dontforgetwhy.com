<?php
session_start();
include('db.php');

if (isset($_POST['transSubmit'])) {
    $username = $_SESSION['user'];
    $needsPrcnt = $_SESSION['needsPercent'];
    $savingsPrcnt = $_SESSION['savingsPercent'];
    $investPrcnt = $_SESSION['investPercent'];
    $wantsPrcnt = $_SESSION['wantsPercent'];
    $totalBal = $_SESSION['totalBal'];
    $needsBal = $_SESSION['needsBal'];
    $savingsBal = $_SESSION['savingsBal'];
    $investBal = $_SESSION['investBal'];
    $wantsBal = $_SESSION['wantsBal'];
    $recent = $_SESSION['recent'];
    $secondRecent = $_SESSION['secondRecent'];
    $transAmt = $_POST['transAmt'];

    if($_POST['transAmt'] <= 0){
        header("Location: transaction.php?error=Please enter a positive transaction amount");
        exit();
    }

    //Checks if the user has updated their budget allocation values
    if($_SESSION['needsPercent'] == 0.0 && $_SESSION['savingsPercent'] == 0.0 && 
    $_SESSION['investPercent'] == 0.0 && $_SESSION['wantsPercent'] == 0.0){
        header("Location: transaction.php?error=Please set your budget allocation before making any transactions");
        exit();
    }
    else{
        if($_POST['transType'] == "withdraw"){
            if(($transAmt > $needsBal && $_POST['withdrawType'] == "needs") || ($transAmt > $savingsBal && 
            $_POST['withdrawType'] == "savings") || ($transAmt > $investBal && $_POST['withdrawType'] == 
            "invest") || ($transAmt > $wantsBal && $_POST['withdrawType'] == "wants")){
                header("Location: transaction.php?error=You do not have enough money budgeted to make this withdrawal");
                exit();
            }
            else{
                $transAmt = $transAmt * -1;
                $totalBal = $totalBal + $transAmt;
                if($_POST['withdrawType'] == "needs"){
                    $needsBal = $needsBal + $transAmt;
                }
                else if($_POST['withdrawType'] == "savings"){
                    $savingsBal = $savingsBal + $transAmt;
                }
                else if($_POST['withdrawType'] == "invest"){
                    $investBal = $investBal + $transAmt;
                }
                else{
                    $wantsBal = $wantsBal + $transAmt;
                }
            }
        }
        else{
            $addedNeeds = $transAmt * $needsPrcnt / 100;
            $addedSavings = $transAmt * $savingsPrcnt / 100;
            $addedInvest = $transAmt * $investPrcnt / 100;
            $addedWants = $transAmt * $wantsPrcnt / 100;
            $totalBal = $totalBal + $transAmt;
            $needsBal = round($needsBal + $addedNeeds, 2);
            $savingsBal = round($savingsBal + $addedSavings, 2);
            $investBal = round($investBal + $addedInvest, 2);
            $wantsBal = round($wantsBal + $addedWants, 2);
        }

        //Adjusts wants balance if rounding causes the total to be slightly off
        while($totalBal != ($needsBal + $savingsBal + $investBal + $wantsBal)){
            if($totalBal > ($needsBal + $savingsBal + $investBal + $wantsBal)){
                $wantsBal = $wantsBal + ($totalBal - ($needsBal + $savingsBal + $investBal + $wantsBal));
            }
            else if($totalBal < ($needsBal + $savingsBal + $investBal + $wantsBal)){
                $wantsBal = $wantsBal - (($needsBal + $savingsBal + $investBal + $wantsBal) - $totalBal);
            }
        }

        $stmt = $pdo->prepare("UPDATE users SET 
            totalBal = :totalBal, 
            needsBal = :needsBal, 
            savingsBal = :savingsBal, 
            investBal = :investBal, 
            wantsBal = :wantsBal, 
            thirdRecent = :thirdRecent, 
            secondRecent = :secondRecent, 
            recent = :recent 
        WHERE user = :username");

        $stmt->bindParam(':totalBal', $totalBal);
        $stmt->bindParam(':needsBal', $needsBal);
        $stmt->bindParam(':savingsBal', $savingsBal);
        $stmt->bindParam(':investBal', $investBal);
        $stmt->bindParam(':wantsBal', $wantsBal);
        $stmt->bindParam(':thirdRecent', $secondRecent);
        $stmt->bindParam(':secondRecent', $recent);
        $stmt->bindParam(':recent', $transAmt);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $_SESSION['totalBal'] = $totalBal;
        $_SESSION['needsBal'] = $needsBal;
        $_SESSION['savingsBal'] = $savingsBal;
        $_SESSION['investBal'] = $investBal;
        $_SESSION['wantsBal'] = $wantsBal;
        $_SESSION['thirdRecent'] = $_SESSION['secondRecent'];
        $_SESSION['secondRecent'] = $_SESSION['recent'];
        $_SESSION['recent'] = $transAmt;

        header("Location: transaction.php?success=Transaction successfully added");
        exit();
    }
}
else{
    header("Location: transaction.php");
    exit();
}
