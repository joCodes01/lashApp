<?php
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //if the form submitted is the client form then do these checks
    if(isset($_POST['formID'])){

        if ($_POST['formID'] == 'clientItemForm') {
            $test = $_POST['action'];
            echo $test;
            if($_POST['action'] == 'View appointments') {

                //use the client ID 
                $_SESSION['clientID'] = $_POST['clientID'];
                $test2 = $_SESSION['clientID'];
                echo "<br>I have just set the client ID to " . $test2;

            }
        }

        

    }
}

echo "checking the session clientID: " . $_SESSION['clientID'];

//Notes
//If "view appointments" is clicked- set the $_SESSION_['clientID] to the selected client clientID show THIS clients appoinements in "Appointments" card 
//If "view client record" is clicked- set the $_SESSION_['clientID] to the selected client and go to "Client Record" page with pre-filled client details
    //and an empty new appointment but with client ID filled for the DB isertion.
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
                    
                    echo "client found";

                    $row = $result->fetch_all(MYSQLI_ASSOC);

                    // echo "<pre>";
                    // var_dump($row);
                    // echo "</pre>";

                    // if($client != "New client")


                
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

    <!-- for each loop through the appointmentss n the database and list them here based on client selected-->

    <!-- check the $_SESSION['clientID'] -->

    <?php
    include 'dbconnect.php';

                $result = $conn->query("SELECT * FROM appointments ORDER BY appDate ASC");

                echo "<br><br> the client id is set to: " . $_SESSION['clientID'] . "<br>";



                if($result->num_rows > 0) {
                    
                    echo "appointment found";

                    $row = $result->fetch_all(MYSQLI_ASSOC);

                    // echo "<pre>";
                    // var_dump($row);
                    // echo "</pre>";

                    // if($client != "New client")


                
                    foreach($row as $appItem): ?>

                    <!-- insert html here-->

                        <div class="app-listitem-container">
                        
                            <h3> <?=$appItem['appDate'] . " " . $appItem['appType'] ?> </h3>
                        
    
                    <?php endforeach; 
                    } else{
                        $conn->close();
                    } 
                    ?>



    </section>
</div>
    
</body>
</html>