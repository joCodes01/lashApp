<?php
session_start();
$_SESSION['clientName'];


if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //if the form submitted is the client form then do these checks
    if(isset($_POST['formID'])){

        if($_POST['formID'] == 'clientItemForm') {
            //set the session client ID
            $_SESSION['clientID'] = $_POST['clientID'];

             if($_POST['action'] == 'View client record') {
                header( "Location: clientrecord.php " );
                //exit;
            }
            if($_POST['action'] == 'View appointments') {

                include 'dbconnect.php';
                $result = $conn->query("SELECT * FROM clients WHERE clientID ='" . $_SESSION['clientID'] . "'ORDER BY firstName ASC");

                $row = $result->fetch_assoc();

                $_SESSION['clientName'] = $row['firstName'] . " " . $row['lastName'];
               
            }
        }
        if($_POST['formID'] == 'showAllApps') {
            $_SESSION['clientID'] = 'allClients';
            $_SESSION['clientName'] = "All clients";
        }
    }
}


//Add a button to "Show all client appointments.




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body>

<div class="client-record-container">

    <section class="form-container">
        <h2>Clients</h2>

    <!-- for each loop through the clients n the database and list them here -->
    <?php
    include 'dbconnect.php';

                $result = $conn->query("SELECT * FROM clients ORDER BY firstName ASC");

                echo "<br><br> the client id is set to: " . $_SESSION['clientID'] . "<br>";


                if($result->num_rows > 0) {
                    
                    $row = $result->fetch_all(MYSQLI_ASSOC);
               
                    foreach($row as $clientItem): ?>

                    <!-- insert html here-->

                        <div class="client-listitem-container">
                            <form method="post" action="">
                                <input type="hidden" name="formID" id="clientItemForm" value="clientItemForm">
                        
                                <h3> <?=$clientItem['firstName'] . " " . $clientItem['lastName'] ?> </h3>
                                <label hidden for="clientID">Client ID</label>
                                <input hidden type="text" name="clientID" value="<?= $clientItem['clientID']?>">
                                <input type="submit" name="action" value="View appointments">
                                <input type="submit" name="action" value="View client record">

                            </form>
                        
    
                    <?php endforeach; 
                    } else{
                        $conn->close();
                    } 
                    ?>


    </section>

    <section class="form-container">
        <h2>Appointments</h2>
        <form method="POST" action="">
            <input type="hidden" name="formID" value="showAllApps">
            <input type="submit" name="action" value="Show all appointments">
        </form>
        <h3><?=$_SESSION['clientName']?></h3>

    <!-- for each loop through the appointmentss n the database and list them here based on client selected-->

    <!-- check the $_SESSION['clientID'] -->

    <?php
                if($_SESSION['clientID'] == 'allClients') {
                    
                    // echo "its working";
                     include 'dbconnect.php';

                $result = $conn->query("SELECT * FROM appointments ORDER BY appDate ASC");

                //echo "<br><br> the client id is set to: " . $_SESSION['clientID'] . "<br>";
                echo "<br><br> the client name is set to: " . $_SESSION['clientName'] . "<br>";

                    //TO DO - display the client name here

                   

                if($result->num_rows > 0) {
                    
                    // echo "appointment found";
                    $row = $result->fetch_all(MYSQLI_ASSOC);
                    
            
                    foreach($row as $appItem): ?>
                        <div class="app-listitem-container">
                            <h3> <?=$appItem['appDate'] . " " . $appItem['appType'] ?> </h3>
                    
                    <?php endforeach; 
                    } else{
                        $conn->close();
                    } 

                }else {



                    include 'dbconnect.php';

                    $result = $conn->query("SELECT * FROM appointments WHERE clientID = '" . $_SESSION['clientID'] . "' ORDER BY appDate ASC");

                    // echo "<br><br> the client id is set to: " . $_SESSION['clientID'] . "<br>";
                    // echo "<br><br> the client name is set to: " . $_SESSION['clientName'] . "<br>";

                        //TO DO - display the client name here

                    

                    if($result->num_rows > 0) {
                        
                        // echo "appointment found";
                        $row = $result->fetch_all(MYSQLI_ASSOC);
                        
                
                        foreach($row as $appItem): ?>
                            <div class="app-listitem-container">
                                <h3> <?=$appItem['appDate'] . " " . $appItem['appType'] ?> </h3>
                        
                        <?php endforeach; 
                        } else{
                            $conn->close();
                        } 
                }
                    ?>

    </section>
</div>
    
</body>
</html>