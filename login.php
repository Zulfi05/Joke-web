<?php
require_once("db.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $errors = array();
    $dataOK = TRUE;
    
    $username = test_input($_POST["username"]);
    $unameRegex = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
    if (!preg_match($unameRegex, $username)) {
        $errors["username"] = "Invalid Username";
        $dataOK = FALSE;
    }

    $password = test_input($_POST["password"]);
    $passwordRegex = "/^(?=.*?[a-zA-Z])(?=.*?[^\w\s]).{8,20}$/";
    if (!preg_match($passwordRegex, $password)) {
        $errors["password"] = "Invalid Password";
        $dataOK = FALSE;
    }

    if ($dataOK) {

        try {
            $db = new PDO($attr, $db_user, $db_pwd, $options);
            $query = "SELECT  uid, 
            first_name , 
            last_name,
            username,
            password,
            dob,
            avatar
            from userinfo 
            where username ='$username' and password= '$password'";
            $result = $db->query($query);

            if (!$result) {
                // handle errors
                $errors["Database Error"] = "Could not retrieve user information";
            } elseif ($row = $result->fetch()) {
                // If there's a row, we have a match and login is successful!
                

                session_start();
                $_SESSION=$row;
                $db = null;
                header("Location:Joke_List.php");
                exit();
            } else {
                // login unsuccessful
                $errors["Login Failed"] = "That username/password combination does not exist.";
            }

            $db = null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

    } else {

        $errors[] = "You entered a blank data while logging in.";
    }
    if(!empty($errors)){
        foreach($errors as $message) {
            echo $message . "<br />\n";
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Jokes</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="Jokepage.js"></script>
</head>

<body>
    <div class="mygrid">
        <div class="header">
            <h1>Welcome to My Jokes Page </h1>
        </div>
        <div class="div2">
            <img src="images/2.jpg" alt="Image " />
        </div>

        <main class="div3">
            <form action="" method="post"  id="loginform">
                <h2>Login to Get Started</h2>
                <p class="in">
                    <label>Username:</label>
                    <input type="text" name="username" id="username" class="oinput"/>
                    <p id="error-text-username" class="error-text-hidden">Username is invalid,Username needs to be a valid Email</p>
                </p>
                <p class="in">
                    <label>Password:</label>
                    <input type="password" name="password" id="password" class="oinput"/>
                    <p id="error-text-password" class="error-text-hidden">Password is invalid,Password needs to be 8 characters long, at least one non-letter character</p>
                </p>
                <p class="input-field">
                    <button type="submit" >Login</button>
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
        <footer class="foot">
            <h3>Don't Have an account?<a href="Sign-up.php">Signup Now!</a></h3>
        </footer>
    </div>
    <script src="jokeregister.js"></script>
</body>

</html>