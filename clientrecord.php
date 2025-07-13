<?php 

// session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    

    //if the form submitted is the client form then do these checks
    if(isset($_POST['formID'])){
        
        if($_POST['formID'] == 'clientForm') {
            

            if(isset($_POST['firstName'])){
                $sanitize_firstName = $_POST['firstName'];
                $firstName = htmlspecialchars($sanitize_firstName);
            }
            if(isset($_POST['lastName'])){
                $sanitize_lastName = $_POST['lastName'];
                $lastName = htmlspecialchars($sanitize_lastName);
            }
            if(isset($_POST['email'])){
                $sanitize_email = $_POST['email'];
                $email = htmlspecialchars($sanitize_email);
            }
            if(isset($_POST['phoneNumber'])){
                $sanitize_phoneNumber = $_POST['phoneNumber'];
                $phoneNumber = htmlspecialchars($sanitize_phoneNumber);
            }
            if(isset($_POST['birthDate'])){
                $sanitize_birthDate = $_POST['birthDate'];
                $birthDate = htmlspecialchars($sanitize_birthDate);
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
        }

         //if the form submitted is the appointment form then do these checks
        if($_POST['formID'] == 'appForm') {
            
            if(isset($_POST['']))
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
    <title>Client Record</title>
</head>
<body>
   
    <h1>Client Record</h1>
    <div class="client-record-container">
        <div class="form-container">
            <form method="POST" action="" id="clientForm" class="CRUD-form">

                <!-- FORM ID  hidden   -->
                <input type="hidden" name="formID" id="clientForm" value="clientForm">


                <label for="firstName">First name</label>
                <input type="text" name="firstName" id="firstName">

                <label for="lastName">Last name</label>
                <input type="text" name="lastName" id="lastName">

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email">

                <label for="phoneNumber">Phone number</label>
                <input type="text" name="phoneNumber" id="phoneNumber">

                <label for="birthDate">Date of birth</label>
                <input type="date" name="birthDate" id="birthDate">

                <label for="address">Address</label>
                <input type="text" name="address" id="address">

                <label for="GPname">GP name</label>
                <input type="text" name="GPname" id="GPname">

                <label for="GPaddress">GP address</label>
                <input type="text" name="GPaddress" id="GPaddress">

                <label for="emergencyContactName">Emergency contact name</label>
                <input type="text" name="emergencyContactName" id="emergencyContactName">

                <label for="emergencyContactPhone">Emergency contact phone number</label>
                <input type="text" name="emergencyContactPhone" id="emergencyContactPhone">

                <label for="contactLenses">Contact lenses</label>
                <select name="contactLenses" id="contactLenses">
                    <option selected>choose option</option>
                    <option>Wears contact lenses</option>
                    <option>Does not wear contact lenses</option>
                </select>

                <label for="medicalConditions">Medical conditions</label>
                <input type="text" name="medicalConditions" id="medicalConditions">

                <label for="allergies">Allergies</label>
                <input type="text" name="allergies" id="allergies">

                <label for="medication">Medication</label>
                <input type="text" name="medication" id="medication">

                <label for="adhesivePatchTest">Adhesive patch test</label>
                <input type="text" name="adhesivePatchTest" id="adhesivePatchTest">

                <label for="removerPatchTest">Remover patch test</label>
                <input type="text" name="removerPatchTest" id="removerPatchTest">

                <label for="tintPatchTest">Tint patch test</label>
                <input type="text" name="tintPatchTest" id="tintPatchTest">

                <label for="liftPatchTest">Lift patch test</label>
                <input type="text" name="liftPatchTest" id="liftPatchTest">

                <label for="clientNotes">Client notes</label>
                <input type="textarea" name="clientNotes" id="clientNotes">


                <button type="submit">Submit</button>

            </form>
        </div>
        <div class="form-container">
            <form method="POST" action="" id="appForm" class="CRUD-form">

                <!-- FORM ID     -->
                <input type="hidden" name="formID" id="appForm">


                <label for="appType">Appointment type</label>
                <select name="appType" id="appType">
                    <option>Lash extensions - classic full set: 120</option>
                    <option>Lash extensions - light volume: 140</option>
                    <option>Lash extensions - half set: 90</option>
                    <option>Lash extensions - infills (up to 3 weeks): 90</option>
                    <option>Lash extensions - infills (3 weeks plus): 120</option>
                    <option>Lash extensions - removal: 30</option>
                    <option>Lash lift & tint: 105</option>
                    <option>Lash lift: 90</option>
                    <option>Lash tint: 30</option>
                    <option>Consultation</option>
                </select>

                <label for="cost">Cost</label>
                <input type="number" value="000.00"name="cost" id="cost">

                <label for="appDate">Date</label>
                <input type="date" name="appDate" id="appDate">

                <label for="appTime">Time</label>
                <input type="time" name="appTime" id="appTime">

                <label for="duration">Duration</label>
                <input type="number" step="0.25" value="0.00" name="duration" id="duration">

                <label for="lashLength">Lash lengths on right eye</label>
                <input type="text" name="lashLength" id="lashLength">

                <label for="lashBrand">Lash brand</label>
                <input type="text" name="lashBrand" id="lashBrand">

                <label for="lashWidth">Lash diameter</label>
                <input type="text" name="lashWidth" id="lashWidth">

                <label for="lashCurl">Lash curl</label>
                <input type="text" name="lashCurl" id="lashCurl">

                <label for="adhesive">Adhesive</label>
                <input type="text" name="adhesive" id="adhesive">

                <label for="remover">Remover</label>
                <input type="text" name="remover" id="remover">

                <label for="tint">Tint</label>
                <input type="text" name="tint" id="tint">

                <label for="lift">Lift</label>
                <input type="text" name="lift" id="lift">

                <label for="notes">Notes</label>
                <input type="textarea" name="notes" id="notes">

                <label for="beforePhoto">Before photo</label>
                <input type="file" name="beforePhoto" id="beforePhoto">

                <label for="afterPhoto">After photo</label>
                <input type="file" name="afterPhoto" id="afterPhoto">


                <button type="submit">Submit</button>

            </form>

        </div>
    </div>




    
</body>
</html>