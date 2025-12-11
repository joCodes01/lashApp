<?php
session_start();
$_SESSION['clientName'];
$_SESSION['addNewClient'] = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //if the form submitted is the client form then do these checks
    if(isset($_POST['formID'])){

        if($_POST['formID'] == 'viewApp') {
            $_SESSION['appID'] = $_POST['appID'];
            $_SESSION['clientID'] = $_POST['clientID'];
            header( 'Location: clientrecord.php');
        }

        if($_POST['formID'] == 'clientItemForm') {
            //set the session client ID
            $_SESSION['clientID'] = $_POST['clientID'];

            

            if($_POST['action'] == 'viewRecord') {
                header( "Location: clientrecord.php " );
                //exit;
            }
            if($_POST['action'] == 'viewApps') {

                include 'dbconnect.php';

                $stmt = $conn->prepare("SELECT * FROM clients WHERE clientID = ? ORDER BY firstName ASC");
                $stmt->bind_param('i', $_SESSION['clientID']);
                $stmt->execute();
                $result = $stmt->get_result();

                $row = $result->fetch_assoc();

                $_SESSION['clientName'] = $row['firstName'] . " " . $row['lastName'];
            }
        }
        if($_POST['formID'] == 'showAllApps') {
            $_SESSION['clientID'] = 'allClients';
            $_SESSION['clientName'] = "All clients";
        }
        if($_POST['formID'] == 'addNewClient') {
            $_SESSION['clientID'] = "";
            $_SESSION['appID'] = "";
            $_SESSION['addNewClient'] = "addNewClient";
            
            header( "Location: clientrecord.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <script src="handleAddNewClient.js" defer></script>
    <title>Dashboard</title>
</head>
<body>
     <header class="nav-container">
        <nav>
            <ul>
                <li></li>
            </ul>
        </nav>
        
        <h1>Dashboard</h1>
</header>
    <div class="dashboard-container">
        <section class="form-container">
            <div class="clients-heading-container">
                <h2>Clients</h2>
                <form method="POST" action="">
                    <input type="hidden" name="formID" value="addNewClient">
                    <button type="submit" id="addNewClient" name="action" value="Add new client"><img src="images/plus.png"><button>
                </form>
            </div>
            

            <!-- for each loop through the clients n the database and list them here -->
            <?php
            include 'dbconnect.php';

                // $result = $conn->query("SELECT * FROM clients ORDER BY firstName ASC");

                $stmt = $conn->prepare("SELECT * FROM clients ORDER BY firstName ASC");
                $stmt-> execute();
                $result = $stmt->get_result();



                // echo "<br><br> the client id is set to: " . $_SESSION['clientID'] . "<br>";


                if($result->num_rows > 0) {
                    
                    $row = $result->fetch_all(MYSQLI_ASSOC);
            
                    foreach($row as $clientItem): ?>

                    <!-- insert html here-->

                        <div class="client-listitem-container">
                            <form method="POST" action="">
                                <input type="hidden" name="formID" id="clientItemForm" value="clientItemForm">
                        
                                <!-- <h3> <?=htmlspecialchars($clientItem['firstName']) . " " . htmlspecialchars($clientItem['lastName']) ?> </h3> -->
                                <label hidden for="clientID">Client ID</label>
                                <input hidden type="text" name="clientID" value="<?= htmlspecialchars($clientItem['clientID'])?>">

                                <button class="client-name-btn" name="action" type="submit" value="viewApps"><?=htmlspecialchars($clientItem['firstName']) . " " . htmlspecialchars($clientItem['lastName']) ?></button>
                                <button class="client-record-btn" id="client-record-btn" name="action" type="submit" value="viewRecord">Client record</button> 
                            </form>
                        </div>
                        
    
                    <?php endforeach; 
                    } else{
                        $conn->close();
                    } 
                    ?>


        </section>
        <section class="form-container">
            <div class="appointments-heading-container">
                <h2>Appointments</h2>
                    <form method="POST" action="">
                        <input type="hidden" name="formID" value="showAllApps">
                        <input type="submit" name="action" value="Show all">
                    </form>
            </div>
            
          
            <h3 class="appointments-name"><?=htmlspecialchars($_SESSION['clientName'])?></h3>

        <!-- for each loop through the appointmentss n the database and list them here based on client selected-->

        <!-- check the $_SESSION['clientID'] -->

            <?php
                    include 'dbconnect.php';

                    if($_SESSION['clientID'] == 'allClients') {
                        
                        // echo "its working";
                        


                        $stmt = $conn->prepare("SELECT appointments.*, clients.firstName, clients.lastName 
                                                FROM appointments
                                                INNER JOIN clients ON appointments.clientID = clients.clientID
                                                ORDER BY appointments.appDate ASC
                                                ");
                        $stmt-> execute();
                        $result = $stmt->get_result();
            
                        if($result->num_rows > 0) {
                            
                            // echo "appointment found";
                            $row = $result->fetch_all(MYSQLI_ASSOC);
                            
                    
                            foreach($row as $appItem): ?>
                                <div class="app-listitem-container">
                                    <form method="POST" action="">
                                            <input type="hidden" name="formID" value="viewApp">
                                            <input type="hidden" name="appID" value="<?= htmlspecialchars($appItem['appID']) ?>">
                                            <input type="hidden" name="clientID" value="<?= $appItem['clientID'] ?>">
                                            
                                            <div class="app-date-container">
                                                <p><?= htmlspecialchars($appItem['appDate']) . " " . htmlspecialchars($appItem['appTime'])?></p>
                                                <button type="submit">Details</button>
                                            </div>
                                            
                                            <p id="appClientName"><?=htmlspecialchars($appItem['firstName']) . " " . htmlspecialchars($appItem['lastName']) ?></p>
                                            <p><?= htmlspecialchars($appItem['appType'])?></p>

                                            
                                        </form>
                                </div>
                            
                            <?php endforeach; 
                            }else{
                                $conn->close();
                            } 

                    }else {
                
                        // $result = $conn->query("SELECT * FROM appointments WHERE clientID = '" . $_SESSION['clientID'] . "' ORDER BY appDate ASC");

                        $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? ORDER BY appDate ASC"
                        );
                        $stmt->bind_param('i', $_SESSION['clientID']);
                        $stmt-> execute();
                        $result = $stmt->get_result();



                    

                        if($result->num_rows > 0) {
                            
                            // echo "appointment found";
                            $row = $result->fetch_all(MYSQLI_ASSOC);
                         echo '<div class="app-listitem-container-single">';   
                    
                            foreach($row as $appItem): ?>
                            <!-- <div class="app-listitem-container-single"> -->
                                
                                    <form method="POST" action="">
                                        <input type="hidden" name="formID" value="viewApp">
                                        <input type="hidden" name="appID" value="<?= htmlspecialchars($appItem['appID']) ?>">
                                        <input type="hidden" name="clientID" value="<?= htmlspecialchars($appItem['clientID']) ?>">
                                        <div class="app-date-container">
                                            <p><?= htmlspecialchars($appItem['appDate']) . " " . htmlspecialchars($appItem['appTime']) ?></p>
                                            <button type="submit">Details</button>
                                        </div>
                                        <!-- </div> -->
                                        <p><?= htmlspecialchars($appItem['appType']) ?></p>
                                        
                                        
                                    </form>
                          
                            
                            <?php endforeach; 
                        echo '</div>';
                            }else {
                                $conn->close();
                            } 
                    }
            ?>
        </section>
    </div>

    
      
  
</body>
</html> 

