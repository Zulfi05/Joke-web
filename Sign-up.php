<?php
require_once("db.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); //encodes
    return $data;
}

$errors = array();
$firstName = "";
$lastName = "";
$username = "";
$password = "";
$dob = "";
$avatar = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = test_input($_POST["firstname"]);
    $lastName = test_input($_POST["lasttname"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $dob = test_input($_POST["dob"]);
    //$avatar = test_input($_POST["avatar"]);
    // Form Field Regular Expressions
    $nameRegex = "/^[a-zA-Z]+$/" ;
    $unameRegex = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/" ;
    $passwordRegex = "/^(?=.*?[a-zA-Z])(?=.*?[^\w\s]).{8,20}$/";
    $dobRegex = "/^\d{4}[-]\d{2}[-]\d{2}$/";
    //$avatarRegEx = "/^[^\n]+\.[a-zA-Z]{3,4}$/";
    // Validate the form inputs against their Regexes 
    $dataOK = TRUE;
    if (!preg_match($nameRegex, $firstName)) {
        $errors["fname"] = "Invalid First Name";
        $dataOK = FALSE;
    }
    if (!preg_match($nameRegex, $lastName)) {
        $errors["lname"] = "Invalid Last Name";
        $dataOK = FALSE;
    }
    if (!preg_match($unameRegex, $username)) {
        $errors["username"] = "Invalid Username";
        $dataOK = FALSE;
    }
    if (!preg_match($passwordRegex, $password)) {
        $errors["password"] = "Invalid Password";
        $dataOK = FALSE;
    }
    if (!preg_match($dobRegex, $dob)) {
        $errors["dob"] = "Invalid DOB";
        $dataOK = FALSE;
    }
    //if (!preg_match($avatarRegEx, $avatar)) {
      //  $errors["avatar"] = "Invalid Avatar";
       // $dataOK = FALSE;
    //}


    $target_file = "";
    if ($dataOK) {
        try{

            $db = new PDO("mysql:host=localhost;dbname=zno031","zno031","WASDqe0@");;
            $query = "SELECT COUNT(*) from userinfo where username='$username'";
            $result = $db->query($query);
            $matches = $result->fetchColumn();
            if ($matches == 0) {
                $query = "INSERT INTO userinfo (first_name,last_name,username,password,dob,avatar) 
                VALUES('$firstName','$lastName','$username','$password','$dob','avatar_stub')";
                $result = $db->exec($query);

                if (!$result) {
                    $errors["Database Error:"] = "Failed to insert user";
                } else {
                    $target_dir = "uploads/";
                    $uploadOk = TRUE;
                
                    // Fetch the image filetype
                    $imageFileType = strtolower(pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION));
                    $uid = $db->lastInsertId();

                    $target_file = "uploads/$uid.$imageFileType";

                    if (file_exists($target_file)) {
                        $errors["avatar"] = "Sorry, file already exists. ";
                        $uploadOk = FALSE;
                    }
                        
                    // Check whether the file is not too large
                    if ($_FILES["avatar"]["size"] > 1000000) {
                        $errors["avatar"] = "File is too large. Maximum 1MB. ";
                        $uploadOk = FALSE;
                    }

                    // Check image file type
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                        $errors["avatar"] = "Bad image type. Only JPG, JPEG, PNG & GIF files are allowed. ";
                        $uploadOk = FALSE;
                    }
                                    
                    // Check if $uploadOk still TRUE after validations
                    if ($uploadOk) {
                        // Move the user's avatar to the uploads directory and capture the result as $fileStatus.
                        $fileStatus = move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);

                        // Check $fileStatus:
                        if (!$fileStatus) {
                            // The user's avatar file could not be moved
                            $errors["Server Error"] = "File could not be moved";
                            $query = "DELETE FROM userinfo WHERE avatar='avatar_stub'";
                            $result = $db->exec($query);
                            if (!$result) {
                                $errors["Database Error"] = "could not delete user when avatar upload failed";
                            }

                            $db = null;
                        } else {
                            $query =  "UPDATE userinfo 
                            SET avatar = 'uploads/$uid.$imageFileType' 
                            WHERE uid = $uid";
                            $result = $db->exec($query);
                            if (!$result) {
                                $errors["Database Error:"] = "could not update avatar";
                            } else {
                                $result=null;
                                $db =null;
                                header("Location:login.php");
                                exit();
                            }
                        }
                    } // image was uploadOk
                } // Insert user query worked
            } else {
                // The email address was found in the Users table 
                $errors["Account Taken"] = "A user with that username already exists.";
            }

        } catch(PDOException $e){
            die("error: " . $e->getMessage());
        }

    } // $dataOk was TRUE

    if (!empty($errors)) {
        foreach($errors as $error => $message) {
            print("$error: $message \n<br />");
        }
    }

} // submit method was POST
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Jokes</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="joke_signup_page.js"></script>
</head>

<body>
    <div class="mygrid">
        <div class="header">
            <h1>Sign-up</h1>
        </div>
        <div class="div2">
            <img src="images/2.jpg" alt="Image " />
        </div>
        <main class="div3">
            <form action="" method="post" class="auth-form" id="loginform" enctype="multipart/form-data">
                <h2>Enter Your Information to Sign-up</h2>
                <p class="in">
                    <label>Firstname:</label>
                    <input type="text" name="firstname" id="firstname" class="oinput" />
                    <p id="error-text-firstname" class="error-text-hidden">Firstname is invalid,Name should be without any space or number or special charecter</p>
                </p>
                <p class="in">
                    <label>Lastname:</label>
                    <input type="text" name="lasttname" id="lasttname" class="oinput" />
                    <p id="error-text-lastname" class="error-text-hidden">Lastname is invalid,Name should be without any space or number or special charecter</p>
                </p>
                <p class="in">
                    <label>Username:</label>
                    <input type="text" name="username" id="username" class="oinput"/>
                    <p id="error-text-username" class="error-text-hidden">Username is invalid,Username needs to be a valid Email</p>
                </p>
                <p class="in">
                    <label>Password:</label>
                    <input type="password" name="password" id="password"  class="oinput" />
                    <p id="error-text-password" class="error-text-hidden">Password is invalid,Password needs to be 8 characters long, at least one non-letter character</p>
                </p>
                <p class="input-field">
                    <label>Confirm Password:</label>
                    <input type="password" name="confirmpassword" id="cpassword" class="oinput"/>
                    <p id="error-text-cpassword" class="error-text-hidden">Password Does not MAtch</p>
                </p>
                <p class="input-field">
                    <label> Upload Your Image:</label>
                    <input type="file" name="avatar" id="avatar" class="oinput"/>
                    <p id="error-text-avatar" class="error-text-hidden">AVATAR is invalid</p>
                </p>
                <p class="input-field">
                    <label> Date of Birth:</label>
                    <input type="date" name="dob" id="dob" class="oinput"/>
                    <p id="error-text-dob" class="error-text-hidden">DOB is invalid</p>
                </p>
                <p class="input-field">
                    <button type="submit">Sign-up</button>
                </p>
            </form>

        </main>
        <div class="div4">
            <img src="images/4.jpg" alt="Image " />
        </div>
        <div class="div5">
            <img src="images/5.jpg" alt="Image " />
        </div>
        <div class="div6">
            <img src="images/5.jpg" alt="Image " />
        </div>
        
    </div>
    <script src="joke_signup_page_regis.js"></script>
</body>

</html>