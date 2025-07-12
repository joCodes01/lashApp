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

                <label for="emergencyContactPame">Emergency contact phone number</label>
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

                <!-- check for appropriate modern submit method -->

            </form>
        </div>
        <div class="form-container">
            <form method="POST" action="" id="appForm" class="CRUD-form">
                <label for="appType">Appointment type</label>
                <select name="appType" id="appType">
                    <option>Lash extensions - full set</option>
                    <option>Lash extensions - half set</option>
                    <option>Lash extensions - infills</option>
                    <option>Lash extensions - removal</option>
                    <option>Lash lift & tint - standard</option>
                    <option>Lash lift & tint - Korean</option>
                    <option>Lash lift - Korean</option>
                    <option>Lash lift - standard</option>
                    <option>Lash tint</option>
                    <option>Consultation</option>
                </select>

                <label for="cost">Cost</label>
                <input type="text" name="cost" id="cost">

                <label for="appDate">Date</label>
                <input type="date" name="appDate" id="appDate">

                <label for="appTime">Time</label>
                <input type="time" name="appTime" id="appTime">

                <label for="duration">Duration</label>
                <input type="number" step="0.25" value="0.00" name="duration" id="duration">

                <label for="lashLength">Lash length</label>
                <input type="text" name="lashLength" id="lashLength">

                <label for="lashBrand">Lash brand</label>
                <input type="text" name="lashBrand" id="lashBrand">

                <label for="lashWidth">Lash width</label>
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

                <!-- check for appropriate modern submit method -->

            </form>

        </div>
    </div>




    
</body>
</html>