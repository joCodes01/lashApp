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
            
            echo "client form submitted";

            if(isset($_POST['clientID'])){
                $sanitize_clientID = $_POST['clientID'];
                $clientID = htmlspecialchars($sanitize_clientID);

                //set the clientID to a session variable
                $_SESSION['clientID'] = $clientID;
            }
            if(isset($_POST['CRUDclient'])){
                $sanitize_CRUDclient = $_POST['CRUDclient'];
                $CRUDclient = htmlspecialchars($sanitize_CRUDclient);
            }
            if(isset($_POST['firstName'])){
                $sanitize_firstName = $_POST['firstName'];
                $firstName = htmlspecialchars($sanitize_firstName);
            }
            if(isset($_POST['lastName'])){
                $sanitize_lastName = $_POST['lastName'];
                $lastName = htmlspecialchars($sanitize_lastName);
            }
            if(isset($_POST['birthDate'])){
                $sanitize_birthDate = $_POST['birthDate'];
                $birthDate = htmlspecialchars($sanitize_birthDate);
            }
            if(isset($_POST['email'])){
                $sanitize_email = $_POST['email'];
                $email = htmlspecialchars($sanitize_email);
            }
            if(isset($_POST['phoneNumber'])){
                $sanitize_phoneNumber = $_POST['phoneNumber'];
                $phoneNumber = htmlspecialchars($sanitize_phoneNumber);
            }
            if(isset($_POST['address'])){
                $sanitize_address = $_POST['address'];
                $address = htmlspecialchars($sanitize_address);
            }
            if(isset($_POST['GPname'])){
                $sanitize_GPname = $_POST['GPname'];
                $GPname = htmlspecialchars($sanitize_GPname);
            }
            if(isset($_POST['GPaddress'])){
                $sanitize_GPaddress = $_POST['GPaddress'];
                $GPaddress = htmlspecialchars($sanitize_GPaddress);
            }
            if(isset($_POST['emergencyContactName'])){
                $sanitize_emergencyContactName = $_POST['emergencyContactName'];
                $emergencyContactName = htmlspecialchars($sanitize_emergencyContactName);
            }
            if(isset($_POST['emergencyContactPhone'])){
                $sanitize_emergencyContactPhone = $_POST['emergencyContactPhone'];
                $emergencyContactPhone = htmlspecialchars($sanitize_emergencyContactPhone);
            }
            if(isset($_POST['contactLenses'])){
                $sanitize_contactLenses = $_POST['contactLenses'];
                $contactLenses = htmlspecialchars($sanitize_contactLenses);
            }
            if(isset($_POST['medicalConditions'])){
                $sanitize_medicalConditions = $_POST['medicalConditions'];
                $medicalConditions = htmlspecialchars($sanitize_medicalConditions);
            }
            if(isset($_POST['allergies'])){
                $sanitize_allergies = $_POST['allergies'];
                $allergies = htmlspecialchars($sanitize_allergies);
            }
            if(isset($_POST['medication'])){
                $sanitize_medication = $_POST['medication'];
                $medication = htmlspecialchars($sanitize_medication);
            }
            if(isset($_POST['adhesivePatchTest'])){
                $sanitize_adhesivePatchTest = $_POST['adhesivePatchTest'];
                $adhesivePatchTest = htmlspecialchars($sanitize_adhesivePatchTest);
            }
            if(isset($_POST['removerPatchTest'])){
                $sanitize_removerPatchTest = $_POST['removerPatchTest'];
                $removerPatchTest = htmlspecialchars($sanitize_removerPatchTest);
            }
            if(isset($_POST['tintPatchTest'])){
                $sanitize_tintPatchTest = $_POST['tintPatchTest'];
                $tintPatchTest = htmlspecialchars($sanitize_tintPatchTest);
            }
            if(isset($_POST['liftPatchTest'])){
                $sanitize_liftPatchTest = $_POST['liftPatchTest'];
                $liftPatchTest = htmlspecialchars($sanitize_liftPatchTest);
            }
            if(isset($_POST['clientNotes'])){
                $sanitize_clientNotes = $_POST['clientNotes'];
                $clientNotes = htmlspecialchars($sanitize_clientNotes);
            }


            //if the form is set to CREATE then create a new record
            if($_POST['CRUDclient'] == 'CREATE') {

                //connect to the database
                include 'dbconnect.php';
                
                //check client does not exist before creating client again!
                $result = $conn->query("SELECT clientID FROM clients WHERE firstName = '$firstName' AND lastName = '$lastName';");

                if($result->num_rows > 0){

                    echo "<br>Client already exists, record not created.";


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
                        GPname, 
                        GPaddress, 
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
                        clientNotes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                
                    $stmt->bind_param("sssssssssssssssssss", 
                        $firstName, 
                        $lastName, 
                        $birthDate, 
                        $email, 
                        $phoneNumber, 
                        $address, 
                        $GPname, 
                        $GPaddress, 
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

                echo "update the form";

                //connect to the database
                include 'dbconnect.php';
              
                $stmt = $conn->prepare("UPDATE clients SET 
                    firstName = ?, 
                    lastName = ?, 
                    birthDate = ?, 
                    email = ?, 
                    phoneNumber = ?,
                    address = ?,
                    GPname = ?,
                    GPaddress = ?, 
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

                $stmt->bind_param("sssssssssssssssssssi", 
                    $firstName, 
                    $lastName,        
                    $birthDate, 
                    $email, 
                    $phoneNumber,  
                    $address, 
                    $GPname, 
                    $GPaddress, 
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

                echo "Delete the record";

                //connect to the database
                include 'dbconnect.php';


                $stmt = $conn->prepare("DELETE FROM clients WHERE clientID = ?;");
                $stmt->bind_param("i", $clientID);
                $stmt->execute();
                $stmt->close();
               }
        }

         //if the form submitted is the appointment form then do these checks
        if($_POST['formID'] == 'appForm') {

            echo "appointment form submitted";

            if(isset($_POST['appClientID'])){
                $sanitize_appClientID = $_POST['appClientID'];
                $appClientID = htmlspecialchars($sanitize_appClientID);
            }
            if(isset($_POST['CRUDapp'])){
                $sanitize_CRUDapp = $_POST['CRUDapp'];
                $CRUDapp = htmlspecialchars($sanitize_CRUDapp);
            }
            if(isset($_POST['appType'])){
                $sanitize_appType = $_POST['appType'];
                $appType = htmlspecialchars($sanitize_appType);
            }
            if(isset($_POST['cost'])){
                $sanitize_cost = $_POST['cost'];
                $cost = htmlspecialchars($sanitize_cost);
            }
            if(isset($_POST['appDate'])){
                $sanitize_appDate = $_POST['appDate'];
                $appDate = htmlspecialchars($sanitize_appDate);
            }
            if(isset($_POST['appTime'])){
                $sanitize_appTime = $_POST['appTime'];
                $appTime = htmlspecialchars($sanitize_appTime);
            }
            if(isset($_POST['duration'])){
                $sanitize_duration = $_POST['duration'];
                $duration = htmlspecialchars($sanitize_duration);
            }
            if(isset($_POST['lashLength'])){
                $sanitize_lashLength = $_POST['lashLength'];
                $lashLength = htmlspecialchars($sanitize_lashLength);
            }
            if(isset($_POST['lashBrand'])){
                $sanitize_lashBrand = $_POST['lashBrand'];
                $lashBrand = htmlspecialchars($sanitize_lashBrand);

                echo $lashBrand;
            }
            if(isset($_POST['lashWidth'])){
                $sanitize_lashWidth = $_POST['lashWidth'];
                $lashWidth = htmlspecialchars($sanitize_lashWidth);
            }
            if(isset($_POST['lashCurl'])){
                $sanitize_lashCurl = $_POST['lashCurl'];
                $lashCurl = htmlspecialchars($sanitize_lashCurl);
            }
            if(isset($_POST['adhesive'])){
                $sanitize_adhesive = $_POST['adhesive'];
                $adhesive = htmlspecialchars($sanitize_adhesive);
            }
            if(isset($_POST['remover'])){
                $sanitize_remover = $_POST['remover'];
                $remover = htmlspecialchars($sanitize_remover);
            }
            if(isset($_POST['tint'])){
                $sanitize_tint = $_POST['tint'];
                $tint = htmlspecialchars($sanitize_tint);
            }
            if(isset($_POST['lift'])){
                $sanitize_lift = $_POST['lift'];
                $lift = htmlspecialchars($sanitize_lift);
            }
             if(isset($_POST['appNotes'])){
                $sanitize_appNotes = $_POST['appNotes'];
                $appNotes = htmlspecialchars($sanitize_appNotes);
            }

            //image upload

            //make a date string to re-name uploaded images
            $date = new DateTime(); 
            $dateString = date_format($date, 'Y-m-d_H-i-s');
            
            //UPLOAD BEFORE PHOTO
            if(isset($_FILES['beforePhoto']) && $_FILES["beforePhoto"]["error"] === UPLOAD_ERR_OK) {
                echo "<br> <p>image is uploaded<p>";
                

                //upload image   
                $targetDir = "photos/";
                $targetFile = $targetDir . basename($_FILES["beforePhoto"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                
                //rename the uploaded file to a date string
                $targetFileRename = $targetDir . $dateString . "_before" . "." . $imageFileType;
                //set the image file name for upload to DB
                $beforePhoto = $dateString . "_before" . "." . $imageFileType;

                $uploadOk = TRUE;
               

                echo "<br>" . "image file type is" . $imageFileType . "<br>";
                echo $targetFileRename;
          
                //check if the file is an image
                $checkimage = getimagesize($_FILES["beforePhoto"]["tmp_name"]);

                if ($checkimage === false) {
                    echo "Sorry this file is not an image.";
                    $uploadOk = FALSE;
                }

                //check file size does not exceed 5MB
                if ($_FILES["beforePhoto"]["size"] > 5000000) {
                    echo "File is too large. 5MB allowed";
                    $uploadOk = FALSE;
                }

                //check file type is JPG, JPEG, PNG, or GIF
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
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
            }


            //UPLOAD AFTER PHOTO
            if(isset($_FILES['afterPhoto']) && $_FILES["afterPhoto"]["error"] === UPLOAD_ERR_OK) {
                echo "<br> <p>image is uploaded<p>";
                

                //upload image   
                $targetDir = "photos/";
                $targetFile = $targetDir . basename($_FILES["afterPhoto"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                //rename the uploaded file to a date string
                $targetFileRename = $targetDir . $dateString . "_after" . "." . $imageFileType;
                //set the image file name
                $afterPhoto = $dateString . "_after" . "." . $imageFileType;

                $uploadOk = TRUE;
               

                echo "<br>" . "image file type is" . $imageFileType . "<br>";
                echo $targetFileRename;
          
                //check if the file is an image
                $checkimage = getimagesize($_FILES["afterPhoto"]["tmp_name"]);

                if ($checkimage === false) {
                    echo "Sorry this file is not an image.";
                    $uploadOk = FALSE;
                }

                //check file size does not exceed 5MB
                if ($_FILES["afterPhoto"]["size"] > 5000000) {
                    echo "File is too large. 5MB allowed";
                    $uploadOk = FALSE;
                }

                //check file type is JPG, JPEG, PNG, or GIF
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
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
            }

            if($_POST['CRUDapp'] == 'CREATE') {


                //connect to the database
                include 'dbconnect.php';

                //check if a record exists with the client ID on this date
                $result = $conn->query("SELECT clientID FROM appointments WHERE clientID = '$appClientID' AND appDate = '$appDate'");
                //if the record exists echo error message
                if($result->num_rows > 0){
                    echo "sorry an appointment for this date already exists for client ID: " . $appClientID;
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
        }
    }
}

include 'dbconnect.php';
$client = $_SESSION['clientID'];

$result = $conn->query("SELECT * FROM clients WHERE clientID = '$client' ");


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
    $row['GPname'] = "";
    $row['GPaddress'] = "";
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
$result = $conn->query("SELECT * FROM appointments WHERE appID = '$appID' ");

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
    <link rel="stylesheet" href="style.css">
    <title>Client Record</title>
</head>
<body>
     <header>
        <a href="dashboard.php">Dashboard</a>
    </header>
   
    <h1>Client Record</h1>
    <div class="client-record-container">
        <div class="form-container">
            <h2>Client details</h2>
            <form method="POST" action="" id="clientForm" class="CRUD-form">

                <!-- FORM ID  hidden   -->
                <input type="hidden" name="formID" id="clientForm" value="clientForm">

                <label hidden for="clientID">Client ID: </label> 
                 <select hidden name="clientID">
                    <option value="<?= $_SESSION['clientID']; ?>"> <?= $_SESSION['clientID']; ?> </option>
                    <option value="1">1</option>
                    <option value="3">3</option>
                    <option value="New client">New client</option>
                </select>

                <label for="CRUDclient">Action: </label>
                <select name="CRUDclient">
                    <option value="CREATE">Create new client record</option>
                    <option value="UPDATE">Update client record</option>
                    <option value="DELETE">Delete client record</option>
                </select>

                <label for="firstName">First name</label>
                <input type="text" name="firstName" id="firstName" value="<?= $row['firstName'] ?>">

                <label for="lastName">Last name</label>
                <input type="text" name="lastName" id="lastName" value="<?= $row['lastName'] ?>">

                <label for="birthDate">Date of birth</label>
                <input type="date" name="birthDate" id="birthDate" value="<?= $row['birthDate'] ?>">

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" value="<?= $row['email'] ?>">

                <label for="phoneNumber">Phone number</label>
                <input type="text" name="phoneNumber" id="phoneNumber" value="<?= $row['phoneNumber'] ?>">

                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="<?= $row['address'] ?>">

                <label for="GPname">GP name</label>
                <input type="text" name="GPname" id="GPname" value="<?= $row['GPname'] ?>">

                <label for="GPaddress">GP address</label>
                <input type="text" name="GPaddress" id="GPaddress" value="<?= $row['GPaddress'] ?>">

                <label for="emergencyContactName">Emergency contact name</label>
                <input type="text" name="emergencyContactName" id="emergencyContactName" value="<?= $row['emergencyContactName'] ?>">

                <label for="emergencyContactPhone">Emergency contact phone number</label>
                <input type="text" name="emergencyContactPhone" id="emergencyContactPhone" value="<?= $row['emergencyContactPhone'] ?>">

                <label for="contactLenses">Contact lenses</label>
                <select name="contactLenses" id="contactLenses" value="<?= $row['contactLenses'] ?>">
                    <option selected>choose option</option>
                    <option>Wears contact lenses</option>
                    <option>Does not wear contact lenses</option>
                </select>

                <label for="medicalConditions">Medical conditions</label>
                <input type="text" name="medicalConditions" id="medicalConditions" value="<?= $row['medicalConditions'] ?>">

                <label for="allergies">Allergies</label>
                <input type="text" name="allergies" id="allergies" value="<?= $row['allergies'] ?>">

                <label for="medication">Medication</label>
                <input type="text" name="medication" id="medication" value="<?= $row['medication'] ?>">

                <label for="adhesivePatchTest">Adhesive patch test</label>
                <input type="text" name="adhesivePatchTest" id="adhesivePatchTest" value="<?= $row['adhesivePatchTest'] ?>">

                <label for="removerPatchTest">Remover patch test</label>
                <input type="text" name="removerPatchTest" id="removerPatchTest" value="<?= $row['removerPatchTest'] ?>">

                <label for="tintPatchTest">Tint patch test</label>
                <input type="text" name="tintPatchTest" id="tintPatchTest" value="<?= $row['tintPatchTest'] ?>">

                <label for="liftPatchTest">Lift patch test</label>
                <input type="text" name="liftPatchTest" id="liftPatchTest" value="<?= $row['liftPatchTest'] ?>">

                <label for="clientNotes">Client notes</label>
                <input type="textarea" name="clientNotes" id="clientNotes" value="<?= $row['clientNotes'] ?>">

                <button type="submit">Submit</button>

            </form>
        </div>
        <div class="form-container">
            <h2>Appointment details</h2>
            
            <form method="POST" action="" id="appForm" class="CRUD-form" enctype="multipart/form-data">

                <!-- FORM ID     -->
                <input type="hidden" name="formID" id="appForm" value="appForm">
                <label hidden for="appClientID">Client ID: </label>
                <input hidden type="text" name="appClientID" id="appClientID" value="<?= $_SESSION['clientID']; ?>">

                 <select name="CRUDapp">
                    <option value="CREATE">Create new appointment</option>
                    <option value="UPDATE">Update appointment</option>
                    <option value="DELETE">Delete appointment</option>
                </select>

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

                <label for="cost">Cost</label>
                <input type="number" name="cost" id="cost" value="<?=$approw['cost']?>">

                <label for="appDate">Date</label>
                <input type="date" name="appDate" id="appDate" value="<?=$approw['appDate']?>">

                <label for="appTime">Time</label>
                <input type="time" name="appTime" id="appTime" value="<?=$approw['appTime']?>">

                <label for="duration">Duration</label>
                <input type="number" step="0.25" name="duration" id="duration" value="<?=$approw['duration']?>">

                <label for="lashLength">Lash lengths on right eye</label>
                <input type="text" name="lashLength" id="lashLength" value="<?=$approw['lashLength']?>">

                <label for="lashBrand">Lash brand</label>
                <input type="text" name="lashBrand" id="lashBrand" value="<?=$approw['lashBrand']?>">

                <label for="lashWidth">Lash diameter</label>
                <input type="text" name="lashWidth" id="lashWidth" value="<?=$approw['lashWidth']?>">

                <label for="lashCurl">Lash curl</label>
                <input type="text" name="lashCurl" id="lashCurl" value="<?=$approw['lashCurl']?>">

                <label for="adhesive">Adhesive</label>
                <input type="text" name="adhesive" id="adhesive" value="<?=$approw['adhesive']?>">

                <label for="remover">Remover</label>
                <input type="text" name="remover" id="remover" value="<?=$approw['remover']?>">

                <label for="tint">Tint</label>
                <input type="text" name="tint" id="tint" value="<?=$approw['tint']?>">

                <label for="lift">Lift</label>
                <input type="text" name="lift" id="lift" value="<?=$approw['lift']?>">

                <label for="appNotes">Notes</label>
                <input type="textarea" name="appNotes" id="appNotes" value="<?=$approw['appNotes']?>">

                <label for="beforePhoto">Before photo</label>
                <input type="file" name="beforePhoto" id="beforePhoto" accept=".png, .jpg, .jpeg, .gif" value="<?=$approw['beforePhoto']?>">
                <img src="photos/placeholder.jpg" id="beforePhotoImage">  

                <label for="afterPhoto">After photo</label>
                <input type="file" name="afterPhoto" id="afterPhoto" accept=".png, .jpg, .jpeg, .gif" value="<?=$approw['afterPhoto']?>">
                <img src="photos/placeholder.jpg" id="afterPhotoImage">  

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <!-- This is the appointment list section below -->
    <section>
        <?php 
            include 'dbconnect.php';

            $result = $conn->query("SELECT * FROM appointments WHERE clientID = '$client' ORDER BY appDate DESC");

            if($result->num_rows > 0) {
                
                echo "client found";

                $row = $result->fetch_all(MYSQLI_ASSOC);

                if($client != "New client")
            
                    foreach($row as $appointment): ?>

                        <div class="appointment-record-container">
                        
                            <h2> <?=$appointment['appType']?> </h2>
                            
                        
                            <!-- <div class="when-container"> -->
                            <div class="app-grid">
                                <div>
                                    <h3>Cost</h3>
                                    <p> <?=$appointment['cost']?> </p>
                                </div>
                                <div>
                                    <h3>Duration</h3>
                                    <p> <?=$appointment['duration']?> </p>
                                </div>
                                <div>
                                    <h3>Time</h3>
                                    <p> <?=$appointment['appTime']?> </p>
                                </div>
                                <div>
                                    <h3>Date</h3>
                                    <p> <?=$appointment['appDate']?> </p>
                                </div>
                                <div>
                                    <h3>Lash length</h3>
                                    <p> <?=$appointment['lashLength']?> </p>
                                </div>
                                <div>
                                    <h3>Lash Brand</h3>
                                    <p> <?=$appointment['lashBrand']?> </p>
                                </div>
                                <div>
                                    <h3>Diameter</h3>
                                    <p> <?=$appointment['lashWidth']?> </p>
                                </div>
                                <div>
                                    <h3>Lash curl</h3>
                                    <p> <?=$appointment['lashCurl']?> </p>
                                </div>
                                <div>
                                    <h3>Adhesive</h3>
                                    <p> <?=$appointment['adhesive']?> </p>
                                </div>
                                <div>
                                    <h3>Remover</h3>
                                    <p> <?=$appointment['remover']?> </p>
                                </div>
                                <div>
                                    <h3>Tint</h3>
                                    <p> <?=$appointment['tint']?> </p>
                                </div>
                                <div>
                                    <h3>Lift</h3>
                                    <p> <?=$appointment['lift']?> </p>
                                </div>
                            </div>
                            <div>
                                <h3>Notes</h3>
                                <p> <?=$appointment['appNotes']?> </p>
                            </div>
                            <div class="photos">
                                <div>
                                    <h3>Before photo</h3>
                                    <img src="photos/<?=$appointment['beforePhoto']?>">
                                </div>
                                <div>
                                    <h3>After photo</h3>
                                    <img src="photos/<?=$appointment['afterPhoto']?>">
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
</body>
</html>