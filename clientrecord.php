<?php 

session_start();
//set client ID in session variable
$_SESSION['clientID'];
$_SESSION['appID'];


if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //if the form submitted is the client form then do these checks
    if(isset($_POST['formID'])){

        if($_POST['formID'] == 'appList') {
          
                $_SESSION['appID'] = $_POST['appID'];
        }
        if($_POST['formID'] == 'clientForm') {
            

            $message = "client form submitted";
            echo "<script>alert(" .  json_encode($message) . ")</script>";

        

            if(isset($_POST['clientID'])){
                $clientID = $_POST['clientID'];
                
                //set the clientID to a session variable
                $_SESSION['clientID'] = $clientID;
            }
            if(isset($_POST['CRUDclient'])){
                $CRUDclient = $_POST['CRUDclient'];
            }
            if(isset($_POST['firstName'])){
                $firstName = $_POST['firstName'];
            }
            if(isset($_POST['lastName'])){
                $lastName = $_POST['lastName'];
            }
            if(isset($_POST['birthDate'])){
                $birthDate = $_POST['birthDate'];
            }
            if(isset($_POST['email'])){
                $email = $_POST['email'];
            }
            if(isset($_POST['phoneNumber'])){
                $phoneNumber = $_POST['phoneNumber'];
            }
            if(isset($_POST['address'])){
                $address = $_POST['address'];
            }
            if(isset($_POST['emergencyContactName'])){
                $emergencyContactName = $_POST['emergencyContactName'];
            }
            if(isset($_POST['emergencyContactPhone'])){
                $emergencyContactPhone = $_POST['emergencyContactPhone'];
            }
            if(isset($_POST['contactLenses'])){
                $contactLenses = $_POST['contactLenses'];
            }
            if(isset($_POST['medicalConditions'])){
                $medicalConditions = $_POST['medicalConditions'];
            }
            if(isset($_POST['allergies'])){
                $allergies = $_POST['allergies'];
            }
            if(isset($_POST['medication'])){
                $medication = $_POST['medication'];
            }
            if(isset($_POST['adhesivePatchTest'])){
                $adhesivePatchTest = $_POST['adhesivePatchTest'];
            }
            if(isset($_POST['removerPatchTest'])){
                $removerPatchTest = $_POST['removerPatchTest'];
            }
            if(isset($_POST['tintPatchTest'])){
                $tintPatchTest = $_POST['tintPatchTest'];
            }
            if(isset($_POST['liftPatchTest'])){
                $liftPatchTest = $_POST['liftPatchTest'];
            }
            if(isset($_POST['clientNotes'])){
                $clientNotes = $_POST['clientNotes'];

            }



            //if the form is set to CREATE then create a new record
            if($_POST['CRUDclient'] == 'CREATE') {

                //connect to the database
                include 'dbconnect.php';
                
                //check client does not exist before creating client again!

                $stmt = $conn->prepare("SELECT clientID FROM clients WHERE firstName = ? AND lastName = ? ;");
                $stmt->bind_param('ss', $firstName, $lastName);
                $stmt->execute();
                $result = $stmt->get_result();



                if($result->num_rows > 0){

                    $message = "Client already exists, record not created.";

                    echo "<script>alert(" .  json_encode($message) . ")</script>";


                //if client record does not already exist then create client record
                //do not add client ID as it will be auto incremented when the record is created.
                }else{
                    $stmt = $conn->prepare("INSERT INTO clients (
                        firstName, 
                        lastName, 
                        birthDate, 
                        email, 
                        phoneNumber, 
                        address, 
                        emergencyContactName, 
                        emergencyContactPhone, 
                        contactLenses, 
                        medicalConditions, 
                        allergies, 
                        medication,
                        adhesivePatchTest,
                        removerPatchTest,
                        tintPatchTest,
                        liftPatchTest,
                        clientNotes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                    $stmt->bind_param("sssssssssssssssss", 
                        $firstName, 
                        $lastName, 
                        $birthDate, 
                        $email, 
                        $phoneNumber, 
                        $address, 
                        $emergencyContactName, 
                        $emergencyContactPhone,
                        $contactLenses,
                        $medicalConditions,
                        $allergies,
                        $medication,
                        $adhesivePatchTest,
                        $removerPatchTest,
                        $tintPatchTest,
                        $liftPatchTest,
                        $clientNotes);
                    $stmt->execute();
 
                    $stmt->close();
                } 
            }
            //if the form is set to Update then update the existing record
            if($_POST['CRUDclient'] == 'UPDATE') {

                // echo "update the form";

                //connect to the database
                include 'dbconnect.php';
              
                $stmt = $conn->prepare("UPDATE clients SET 
                    firstName = ?, 
                    lastName = ?, 
                    birthDate = ?, 
                    email = ?, 
                    phoneNumber = ?,
                    address = ?,
                    emergencyContactName = ?, 
                    emergencyContactPhone = ?,
                    contactLenses = ?,
                    medicalConditions = ?,
                    allergies = ?, 
                    medication = ?,
                    adhesivePatchTest = ?,
                    removerPatchTest = ?,
                    tintPatchTest = ?,
                    liftPatchTest = ?,
                    clientNotes = ? WHERE clientID = ?;");

                $stmt->bind_param("sssssssssssssssssi", 
                    $firstName, 
                    $lastName,        
                    $birthDate, 
                    $email, 
                    $phoneNumber,  
                    $address, 
                    $emergencyContactName,  
                    $emergencyContactPhone,       
                    $contactLenses,
                    $medicalConditions,
                    $allergies,
                    $medication,
                    $adhesivePatchTest,
                    $removerPatchTest,
                    $tintPatchTest,
                    $liftPatchTest,
                    $clientNotes,
                    $clientID);
               

                    $stmt->execute();

                    $stmt->close();
            }
                //if client form is set to DELETE then delete the record based on clientID in the form.
               if($_POST['CRUDclient'] == 'DELETE') {

                // echo "Delete the record";

                //connect to the database
                include 'dbconnect.php';


                $stmt = $conn->prepare("DELETE FROM clients WHERE clientID = ?;");
                $stmt->bind_param("i", $clientID);
                $stmt->execute();
                $stmt->close();
               }

               header('Location: dashboard.php');
        }
//APPOINTMENT FORM

         //if the form submitted is the appointment form then do these checks
        if($_POST['formID'] == 'appForm') {


            $message = "appointment form submitted";
            echo "<script>alert(" .  json_encode($message) . ")</script>";



            if(isset($_POST['appClientID'])){
                $appClientID = $_POST['appClientID'];
            }
            if(isset($_POST['appID'])){
                $appID = $_POST['appID'];
            }
            if(isset($_POST['CRUDapp'])){
                $CRUDapp = $_POST['CRUDapp'];
            }
            if(isset($_POST['appType'])){
                $appType = $_POST['appType'];
            }
            if(isset($_POST['cost'])){
                $cost = $_POST['cost'];
            }
            if(isset($_POST['appDate'])){
                $appDate = $_POST['appDate'];
            }
            if(isset($_POST['appTime'])){
                $appTime = $_POST['appTime'];
            }
            if(isset($_POST['duration'])){
                $duration = $_POST['duration'];
            }
            if(isset($_POST['lashLength'])){
                $lashLength = $_POST['lashLength'];
            }
            if(isset($_POST['lashBrand'])){
                $lashBrand = $_POST['lashBrand'];
            }
            if(isset($_POST['lashWidth'])){
                $lashWidth = $_POST['lashWidth'];
            }
            if(isset($_POST['lashCurl'])){
                $lashCurl = $_POST['lashCurl'];
            }
            if(isset($_POST['adhesive'])){
                $adhesive = $_POST['adhesive'];
            }
            if(isset($_POST['remover'])){
                $remover = $_POST['remover'];
            }
            if(isset($_POST['tint'])){
                $tint = $_POST['tint'];
            }
            if(isset($_POST['lift'])){
                $lift = $_POST['lift'];
            }
            if(isset($_POST['appNotes'])){
                $appNotes = $_POST['appNotes'];
            }


            //image upload

            //make a date string to re-name uploaded images
            $date = new DateTime(); 
            $dateString = date_format($date, 'Y-m-d_H-i-s');
            
            //UPLOAD BEFORE PHOTO
            if(isset($_FILES['beforePhoto']) && $_FILES["beforePhoto"]["error"] === UPLOAD_ERR_OK) {


                
                // $message = "image is uploaded";
                // echo "<script>alert(" .  json_encode($message) . ")</script>";
                
                

                //upload image   
                $targetDir = "photos/";
                $targetFile = $targetDir . basename($_FILES["beforePhoto"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                
                //rename the uploaded file to a date string
                $targetFileRename = $targetDir . $dateString . "_before" . "." . $imageFileType;
                //set the image file name for upload to DB
                $beforePhoto = $dateString . "_before" . "." . $imageFileType;

                $uploadOk = TRUE;
               

                // echo "<br>" . "image file type is" . $imageFileType . "<br>";
                // echo $targetFileRename;
          
                //check if the file is an image
                $checkimage = getimagesize($_FILES["beforePhoto"]["tmp_name"]);

                if ($checkimage === false) {

                    $message = "Sorry this file is not an image.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    $uploadOk = FALSE;
                }

                //check file size does not exceed 5MB
                if ($_FILES["beforePhoto"]["size"] > 5000000) {
                    
                    $message = "File is too large. 5MB allowed.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    $uploadOk = FALSE;
                }

                //check file type is JPG, JPEG, PNG, or GIF
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

                    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    
                    $uploadOk = FALSE;
                }

                //ADD CLIENT ID TO THE FILE NAME

                if ($uploadOk) {
                    move_uploaded_file($_FILES["beforePhoto"]["tmp_name"], $targetFileRename);

                    //connect to the database
                    include "dbconnect.php";
                }
            
            } 
            else {
                //if no file is uploaded then default to placeholder.jpg
                $beforePhoto = "placeholder.jpg";
                //  if (!empty($approw['beforePhoto'])) {
                //     $beforePhoto = $approw['beforePhoto'];
                // } else {
                //     $beforePhoto = "placeholder.jpg";
                // }
            }


            //UPLOAD AFTER PHOTO
            if(isset($_FILES['afterPhoto']) && $_FILES["afterPhoto"]["error"] === UPLOAD_ERR_OK) {

                // $message = "image is uploaded.";
                // echo "<script>alert(" .  json_encode($message) . ")</script>";
                

                //upload image   
                $targetDir = "photos/";
                $targetFile = $targetDir . basename($_FILES["afterPhoto"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                //rename the uploaded file to a date string
                $targetFileRename = $targetDir . $dateString . "_after" . "." . $imageFileType;
                //set the image file name
                $afterPhoto = $dateString . "_after" . "." . $imageFileType;

                $uploadOk = TRUE;
               

                // echo "<br>" . "image file type is" . $imageFileType . "<br>";
                // echo $targetFileRename;
          
                //check if the file is an image
                $checkimage = getimagesize($_FILES["afterPhoto"]["tmp_name"]);

                if ($checkimage === false) {

                    $message = "Sorry this file is not an image.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";
                    $uploadOk = FALSE;
                }

                //check file size does not exceed 5MB
                if ($_FILES["afterPhoto"]["size"] > 5000000) {

                    $message = "File is too large. 5MB allowed.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    $uploadOk = FALSE;
                }

                //check file type is JPG, JPEG, PNG, or GIF
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

                    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    
                    $uploadOk = FALSE;
                }

                //ADD CLIENT ID TO THE FILE NAME

                if ($uploadOk) {
                    
                    move_uploaded_file($_FILES["afterPhoto"]["tmp_name"], $targetFileRename);
                    

                    //connect to the database
                    include "dbconnect.php";
                }
            }else {
                //if no file is uploaded then default to placeholder.jpg
                $afterPhoto = "placeholder.jpg";
                //    if (!empty($approw['afterPhoto'])) {
                //     $afterPhoto = $approw['afterPhoto'];
                // } else {
                //     $afterPhoto = "placeholder.jpg";
                // }
            }






            if($_POST['CRUDapp'] == 'CREATE') {


                //connect to the database
                include 'dbconnect.php';

                //check if a record exists with the client ID on this date
                // $result = $conn->query("SELECT clientID FROM appointments WHERE clientID = '$appClientID' AND appDate = '$appDate'");
                $stmt = $conn->prepare("SELECT clientID FROM appointments WHERE clientID = ? AND appDate = ?");
                $stmt->bind_param('is', $appClientID, $appDate );
                $stmt->execute();
                $result = $stmt->get_result();




                //if the record exists echo error message
                if($result->num_rows > 0){
            
                    $message = "sorry an appointment for this date already exists for client ID: " . htmlspecialchars($appClientID);
                    echo "<script>alert(" .  json_encode($message) . ")</script>";

                    
                }else {

                //Select all appointments with the clientID from the database
                //check if there is an appointment with this clientID on the same date?
                //if there is then echo sorry, appointment already exists for this client on this date
                
                
                    //else: create a new appointment.
                    $stmt = $conn->prepare("INSERT INTO appointments (
                        clientID,
                        appType, 
                        cost, 
                        appDate, 
                        appTime, 
                        duration, 
                        lashLength, 
                        lashBrand, 
                        lashWidth, 
                        lashCurl, 
                        adhesive, 
                        remover, 
                        tint, 
                        lift, 
                        appNotes,
                        beforePhoto,
                        afterPhoto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $stmt->bind_param("issssssssssssssss", 
                        $appClientID,
                        $appType,    
                        $cost, 
                        $appDate, 
                        $appTime, 
                        $duration, 
                        $lashLength, 
                        $lashBrand, 
                        $lashWidth, 
                        $lashCurl, 
                        $adhesive,
                        $remover,
                        $tint,
                        $lift,
                        $appNotes,
                        $beforePhoto,
                        $afterPhoto); 

                    $stmt->execute();

                    $stmt->close();
                }
            }
            if($_POST['CRUDapp'] == 'UPDATE') {

                include 'dbconnect.php';

                $stmt = $conn->prepare("UPDATE appointments SET 
                    appType = ?, 
                    cost = ?, 
                    appDate = ?, 
                    appTime = ?, 
                    duration = ?, 
                    lashLength = ?, 
                    lashBrand = ?, 
                    lashWidth = ?, 
                    lashCurl = ?, 
                    adhesive = ?, 
                    remover = ?, 
                    tint = ?, 
                    lift = ?, 
                    appNotes = ?, 
                    beforePhoto = ?, 
                    afterPhoto = ?
                WHERE appID = ?");

                $stmt->bind_param("ssssssssssssssssi",
                    $appType,
                    $cost,
                    $appDate,
                    $appTime,
                    $duration,
                    $lashLength,
                    $lashBrand,
                    $lashWidth,
                    $lashCurl,
                    $adhesive,
                    $remover,
                    $tint,
                    $lift,
                    $appNotes,
                    $beforePhoto,
                    $afterPhoto,
                    $appID   
                );

                $stmt->execute();
                $stmt->close();
            }


                //if client form is set to DELETE then delete the record based on clientID in the form.
               if($_POST['CRUDapp'] == 'DELETE') {

                // echo "Delete the record";

                //connect to the database
                include 'dbconnect.php';


                $stmt = $conn->prepare("DELETE FROM appointments WHERE appID = ?;");
                $stmt->bind_param("i", $appID);
                $stmt->execute();
                $stmt->close();
               }

               header('Location: dashboard.php');



        }
    }
}

include 'dbconnect.php';
$client = $_SESSION['clientID'];

$stmt = $conn->prepare("SELECT * FROM clients WHERE clientID = ? ");
$stmt->bind_param('i', $client);
$stmt->execute();
$result = $stmt->get_result();


if($result->num_rows > 0) {
    // echo "client found";

    $row = $result->fetch_assoc();

}else {
    $row['firstName'] = "";
    $row['lastName'] = "";
    $row['birthDate'] = "";
    $row['email'] = "";
    $row['phoneNumber'] = "";
    $row['address'] = "";
    $row['emergencyContactName'] = "";
    $row['emergencyContactPhone'] = "";
    $row['contactLenses'] = "";
    $row['medicalConditions'] = "";
    $row['allergies'] = "";
    $row['medication'] = "";
    $row['adhesivePatchTest'] = "";
    $row['removerPatchTest'] = "";
    $row['tintPatchTest'] = "";
    $row['liftPatchTest'] = "";
    $row['clientNotes'] = "";
}
$conn->close();

include 'dbconnect.php';
$appID = $_SESSION['appID'];

$stmt = $conn->prepare("SELECT * FROM appointments WHERE appID = ? ");
$stmt->bind_param('i', $appID);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    // echo "appointment found";

    $approw = $result->fetch_assoc();

}else {
    $approw['appClientID'] = "";
    $approw['appType'] = "";
    $approw['cost'] = "";
    $approw['appDate'] = "";
    $approw['appTime'] = "";
    $approw['duration'] = "";
    $approw['lashLength'] = "";
    $approw['lashBrand'] = "";
    $approw['lashWidth'] = "";
    $approw['lashCurl'] = "";
    $approw['adhesive'] = "";
    $approw['remover'] = "";
    $approw['tint'] = "";
    $approw['lift'] = "";
    $approw['appNotes'] = "";
    $approw['beforePhoto'] = "";
    $approw['afterPhoto'] = "";
}
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="script.js" defer></script>
        <script src="handleAddNewClient.js" defer></script>
        <link rel="stylesheet" href="style.css">
        <title>Client Record</title>
    </head>
    <body>
        <div class="gradient-container">
            <header class="nav-container">
                <nav>
                    <ul>
                        <li><a class="back-link" href="dashboard.php"><img class="arrow" src="images/arrow.png" alt="">Dashboard</a></li>
                    </ul>
                </nav>
            
                <h1>Client Record</h1>
            </header>
            <div class="client-record-container">
                <div class="form-container">
                    <form method="POST" action="" id="clientForm" class="CRUD-form">
                        <!-- FORM ID  hidden   -->
                        <input type="hidden" name="formID" id="clientForm" value="clientForm">
                        <label hidden for="clientID">Client ID: </label>
                        <select hidden name="clientID">
                            <option value="<?= htmlspecialchars($_SESSION['clientID']); ?>"> <?= htmlspecialchars($_SESSION['clientID']); ?> </option>
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="New client">New client</option>
                        </select>
                        <div class="client-name-section">
                            <h2><?= htmlspecialchars($row['firstName']) . " " . htmlspecialchars($row['lastName']) ?></h2>
                            <div>
                                <!-- <label for="CRUDclient">Action </label> -->
                            <?php
                            if ($_SESSION['addNewClient'] == "addNewClient") {
                                echo '<select name="CRUDclient" id="CRUDclient">
                                        <option selected value="CREATE">Create new client record</option>
                                        <option value="UPDATE">Update client record</option>
                                        <option value="DELETE">Delete client record</option>
                                    </select>';
                                }else {
                                    echo '<select name="CRUDclient" id="CRUDclient">
                                        <option selected value="UPDATE">Update client record</option>
                                        <option value="CREATE">Create new client record</option>
                                        <option value="DELETE">Delete client record</option>
                                    </select>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="client-record-inner-container">
                            <div >
                                <div>
                                    <label for="firstName">First name</label>
                                    <input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($row['firstName']) ?>">
                                </div>
                                <div>
                                    <label for="lastName">Last name</label>
                                    <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($row['lastName']) ?>">
                                </div>
                                <div>
                                    <label for="birthDate">Date of birth</label>
                                    <input type="date" name="birthDate" id="birthDate" value="<?= htmlspecialchars($row['birthDate']) ?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($row['email']) ?>">
                                </div>
                                <div>
                                    <label for="phoneNumber">Phone number</label>
                                    <input type="text" name="phoneNumber" id="phoneNumber" value="<?= htmlspecialchars($row['phoneNumber']) ?>">
                                </div>
                                <div>
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" value="<?= htmlspecialchars($row['address']) ?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="emergencyContactName">Emergency contact name</label>
                                    <input type="text" name="emergencyContactName" id="emergencyContactName" value="<?= htmlspecialchars($row['emergencyContactName']) ?>">
                                </div>
                                <div>
                                    <label for="emergencyContactPhone">Emergency contact phone number</label>
                                    <input type="text" name="emergencyContactPhone" id="emergencyContactPhone" value="<?= htmlspecialchars($row['emergencyContactPhone']) ?>">
                                </div>
                                <div>
                                    <label for="medicalConditions">Medical conditions</label>
                                    <input type="text" name="medicalConditions" id="medicalConditions" value="<?= htmlspecialchars($row['medicalConditions']) ?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="contactLenses">Contact lenses</label>
                                    <select name="contactLenses" id="contactLenses" value="<?= htmlspecialchars($row['contactLenses']) ?>">
                                        <option selected>choose option</option>
                                        <option>Wears contact lenses</option>
                                        <option>Does not wear contact lenses</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="allergies">Allergies</label>
                                    <input type="text" name="allergies" id="allergies" value="<?= htmlspecialchars($row['allergies']) ?>">
                                </div>
                                <div>
                                    <label for="medication">Medication</label>
                                    <input type="text" name="medication" id="medication" value="<?= htmlspecialchars($row['medication']) ?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="adhesivePatchTest">Adhesive patch test</label>
                                    <input type="text" name="adhesivePatchTest" id="adhesivePatchTest" value="<?= htmlspecialchars($row['adhesivePatchTest']) ?>">
                                </div>
                                <div>
                                    <label for="removerPatchTest">Remover patch test</label>
                                    <input type="text" name="removerPatchTest" id="removerPatchTest" value="<?= htmlspecialchars($row['removerPatchTest']) ?>">
                                </div>
                                <div>
                                    <label for="tintPatchTest">Tint patch test</label>
                                    <input type="text" name="tintPatchTest" id="tintPatchTest" value="<?= htmlspecialchars($row['tintPatchTest']) ?>">
                                </div>
                                <div>
                                    <label for="liftPatchTest">Lift patch test</label>
                                    <input type="text" name="liftPatchTest" id="liftPatchTest" value="<?= htmlspecialchars($row['liftPatchTest']) ?>">
                                </div>
                            </div>
                            <div>
                                <div class="client-notes-section">
                                    <label for="clientNotes">Client notes</label>
                                    <textarea  name="clientNotes" id="clientNotes" value="<?= htmlspecialchars($row['clientNotes']) ?>"><?= htmlspecialchars($row['clientNotes']) ?></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
                <div class="form-container appointment-form-container">
            
                    <form method="POST" action="" id="appForm" class="CRUD-form" enctype="multipart/form-data">
                           <div class="appointment-heading-container">
                                <h2>Appointment details</h2>
                                    <!-- FORM ID     -->
                                    <input type="hidden" name="formID" id="appForm" value="appForm">
                                    <label hidden for="appClientID">Client ID: </label>
                                    <input hidden type="text" name="appClientID" id="appClientID" value="<?= $_SESSION['clientID']; ?>">
                                    <label hidden for="appID">Appointment ID: </label>
                                    <input hidden type="text" name="appID" id="appID" value="<?= $_SESSION['appID']; ?>">
                                    <select name="CRUDapp">
                                        <option value="CREATE">Create new appointment</option>
                                        <option value="UPDATE">Update appointment</option>
                                        <option value="DELETE">Delete appointment</option>
                                    </select>
                                    <div class="app-type-container">
                                        <label for="appType">Appointment type</label>
                                        <select name="appType" id="appType">
                                            <option selected><?=$approw['appType']?></option>
                                            <option>Lash extensions - classic full set: 120</option>
                                            <option>Lash extensions - hybrid: 140</option>
                                            <option>Lash extensions - light volume: 160</option>
                                            <option>Lash extensions - half set: 90</option>
                                            <option>Lash extensions - classic - infills (up to 3 weeks): 90</option>
                                            <option>Lash extensions - hybrid - infills (up to 3 weeks): 100</option>
                                            <option>Lash extensions - light volume - infills (up to 3 weeks): 110</option>
                                            <option>Lash extensions - removal: 35</option>
                                            <option>Lash lift & tint: 95</option>
                                            <option>Lash lift: 80</option>
                                            <option>Lash tint: 30</option>
                                            <option>Consultation</option>
                                        </select>
                                    </div>
                            </div>
                        <div class="appointment-details-container">
            
            
                            <div>
                                <div>
                                    <label for="cost">Cost</label>
                                    <input type="number" name="cost" id="cost" value="<?=htmlspecialchars($approw['cost'])?>">
                                </div>
                                <div>
                                    <label for="appDate">Date</label>
                                    <input type="date" name="appDate" id="appDate" value="<?=htmlspecialchars($approw['appDate'])?>">
                                </div>
                                <div>
                                    <label for="appTime">Time</label>
                                    <input type="time" name="appTime" id="appTime" value="<?=htmlspecialchars($approw['appTime'])?>">
                                </div>
                                <div>
                                    <label for="duration">Duration</label>
                                    <input type="number" step="0.25" name="duration" id="duration" value="<?=htmlspecialchars($approw['duration'])?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="lashLength">Lash lengths on right eye</label>
                                    <input type="text" name="lashLength" id="lashLength" value="<?=htmlspecialchars($approw['lashLength'])?>">
                                </div>
                                <div>
                                    <label for="lashBrand">Lash brand</label>
                                    <input type="text" name="lashBrand" id="lashBrand" value="<?=htmlspecialchars($approw['lashBrand'])?>">
                                </div>
                                <div>
                                    <label for="lashWidth">Lash diameter</label>
                                    <input type="text" name="lashWidth" id="lashWidth" value="<?=htmlspecialchars($approw['lashWidth'])?>">
                                </div>
                                <div>
                                    <label for="lashCurl">Lash curl</label>
                                    <input type="text" name="lashCurl" id="lashCurl" value="<?=htmlspecialchars($approw['lashCurl'])?>">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="adhesive">Adhesive</label>
                                    <input type="text" name="adhesive" id="adhesive" value="<?=htmlspecialchars($approw['adhesive'])?>">
                                </div>
                                <div>
                                    <label for="remover">Remover</label>
                                    <input type="text" name="remover" id="remover" value="<?=htmlspecialchars($approw['remover'])?>">
                                </div>
                                <div>
                                    <label for="tint">Tint</label>
                                    <input type="text" name="tint" id="tint" value="<?=htmlspecialchars($approw['tint'])?>">
                                </div>
                                <div>
                                    <label for="lift">Lift</label>
                                    <input type="text" name="lift" id="lift" value="<?=htmlspecialchars($approw['lift'])?>">
                                </div>
                            </div>
                            <div class="notes-container">
                                <label for="appNotes">Notes</label>
                                <textarea name="appNotes" id="appNotes" value="<?=htmlspecialchars($approw['appNotes'])?>"><?=htmlspecialchars($approw['appNotes'])?></textarea>
                            </div>
                                <?php
                                //TODO
                                //TODO
                                //if the images are set then show the images that are set, otherwise show the palceholder image.
                                ?>
                        </div>
                         <div class="client-images-container">
                                <div class="client-image-container">
                                    <img src="photos/placeholder.jpg" id="beforePhotoImage">
                                    <div class="image-controls">
                                        <label for="beforePhoto">Before photo</label>
                                        <input type="file" name="beforePhoto" id="beforePhoto" accept=".png, .jpg, .jpeg, .gif" value="<?=$approw['beforePhoto']?>">
                                    </div>
                                </div>
                                <div class="client-image-container">
                                    <img src="photos/placeholder.jpg" id="afterPhotoImage">
                                    <div class="image-controls">
                                        <label for="afterPhoto">After photo</label>
                                        <input type="file" name="afterPhoto" id="afterPhoto" accept=".png, .jpg, .jpeg, .gif" value="<?=$approw['afterPhoto']?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <!-- This is the appointment list section below -->
            <section>
                <?php
                    include 'dbconnect.php';
                    $stmt = $conn->prepare("SELECT * FROM appointments WHERE clientID = ? ORDER BY appDate DESC");
                    $stmt->bind_param('i', $client);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows > 0) {
            
                        // echo "client found";
                        $row = $result->fetch_all(MYSQLI_ASSOC);
                        if($client != "New client")
            
                            foreach($row as $appointment): ?>
                                <div class="appointment-record-container">
            
                                    <h2> <?=htmlspecialchars($appointment['appType'])?> </h2>
            
            
                                    <!-- <div class="when-container"> -->
                                    <div class="app-grid">
                                         <div>
                                            <h3>Date</h3>
                                            <p> <?=htmlspecialchars($appointment['appDate'])?> </p>
                                        </div>
                                          <div>
                                            <h3>Time</h3>
                                            <p> <?=htmlspecialchars($appointment['appTime'])?> </p>
                                        </div>
                                         <div>
                                            <h3>Duration</h3>
                                            <p> <?=htmlspecialchars($appointment['duration'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Cost</h3>
                                            <p> <?=htmlspecialchars($appointment['cost'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Lash length</h3>
                                            <p> <?=htmlspecialchars($appointment['lashLength'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Lash Brand</h3>
                                            <p> <?=htmlspecialchars($appointment['lashBrand'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Diameter</h3>
                                            <p> <?=htmlspecialchars($appointment['lashWidth'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Lash curl</h3>
                                            <p> <?=htmlspecialchars($appointment['lashCurl'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Adhesive</h3>
                                            <p> <?=htmlspecialchars($appointment['adhesive'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Remover</h3>
                                            <p> <?=htmlspecialchars($appointment['remover'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Tint</h3>
                                            <p> <?=htmlspecialchars($appointment['tint'])?> </p>
                                        </div>
                                        <div>
                                            <h3>Lift</h3>
                                            <p> <?=htmlspecialchars($appointment['lift'])?> </p>
                                        </div>
                                    </div>
                                    <div>
                                        <h3>Notes</h3>
                                        <p> <?=htmlspecialchars($appointment['appNotes'])?> </p>
                                    </div>
                                    <div class="photos">
                                        <div>
                                            <h3>Before photo</h3>
                                            <img class="photo" src="photos/<?=$appointment['beforePhoto']?>">
                                        </div>
                                        <div>
                                            <h3>After photo</h3>
                                            <img class="photo" src="photos/<?=$appointment['afterPhoto']?>">
                                        </div>
                                    </div>
                                    <form method="POST" action="">
                                        <input type="hidden" name="formID" value="appList">
                                        <button type="submit" name="action" value="viewAppItem">View appointment details</button>
                                        <input type="hidden" name="appID" value="<?=$appointment['appID']?>">
                                    </form>
            
                                    </div>
                            <?php endforeach;
                            } else{
                                $conn->close();
                            }
                ?>
            </section>
        </div>
    </body>
</html>