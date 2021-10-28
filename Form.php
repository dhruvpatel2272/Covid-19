<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Fname']) && 
        isset($_POST['Lname']) && 
        isset($_POST['Surname']) &&
        isset($_POST['gender']) && 
        isset($_POST['DOB']) &&
        isset($_POST['Age']) && 
        isset($_POST['Contact']) &&
        isset($_POST['Email']) &&
        isset($_POST['Address']) &&
        isset($_POST['Fever']) &&
        isset($_POST['Cough']) &&
        isset($_POST['Sore_Throat']) &&
        isset($_POST['Difficulty_in_Breathing']) &&
        isset($_POST['Other_Symptoms'])
        ) {
        
        $Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
        $Surname = $_POST['Surname'];
        $gender = $_POST['gender'];
        $DOB = $_POST['DOB'];
        $Age = $_POST['Age'];
        $Contact = $_POST['Contact'];
        $Email = $_POST['Email'];
        $Address = $_POST['Address'];
        $Fever = $_POST['Fever'];
        $Cough = $_POST['Cough'];
        $Sore_Throat = $_POST['Sore_Throat'];
        $Difficulty_in_Breathing = $_POST['Difficulty_in_Breathing'];
        $Other_Symptoms = $_POST['Other_Symptoms'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "register";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO register1(Fname,Lname,Surname,gender,DOB,Age,Contact,Email,Address,Fever,Cough,Sore_Throat,Difficulty_in_Breathing,Other_Symptoms) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssisisssssss",$Fname,$Lname,$Surname,$gender,$DOB,$Age,$Contact,$Email,$Address,$Fever,$Cough,$Sore_Throat,$Difficulty_in_Breathing,$Other_Symptoms);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>