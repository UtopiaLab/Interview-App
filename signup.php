<?php 
session_start();
?>

<html lang="en">

<head>
    <title>Interview App</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php

if (isset($_REQUEST["submit"])) {
    $title = $_REQUEST["title"];
    $fName = $_REQUEST["fName"];
    $lName = $_REQUEST["lName"];
    $mobile = $_REQUEST["mobile"];
    $email = $_REQUEST["email"];
    $bDay = $_REQUEST["bDay"];
    $password = $_REQUEST["password"];
    $re_password = $_REQUEST["re_password"];

    $errIDF = FALSE;
    if (!preg_match("/^[a-zA-Z ]+$/",$fName) and !preg_match("/^[a-zA-Z ]+$/",$lName)) {
        $nameError = "Name must contain only letters and spaces.";
        $errIDF = TRUE;
    }
    if (strlen($mobile) != 10) {
        $mobileError = "Mobile number must have 10 digits.";
        $errIDF = TRUE;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Please enter a valid email address.";
        $errIDF = TRUE;
    }

    if (!strlen($password) < 8) {
        $passwordError2 = "Password must contain at least 08 characters.";
        $errIDF = TRUE;

    }

    if ($password != $re_password) {
        $passwordError = "Password confirmation not matching.";
        $errIDF = TRUE;
    }


    $errIDF2 = FALSE;

    if ($errIDF == FALSE) {
        $queryDuplicateCheck = "SELECT * FROM user WHERE email='$email'";
        require_once "dbConnect.php";
        $result = $conn -> query($queryDuplicateCheck);
        if ($result -> num_rows == 1) {
            $duplicateError = "Email already exists!";
            $errIDF2 = TRUE;
        }

    }

   if ($errIDF2 == FALSE) {
        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
        $querySaveUser = "INSERT INTO user (title, f_name, l_name, mobile, email, birthday, password, role) VALUES ('$title', '$fName', '$lName', '$mobile', '$email', $bDay, '$encryptedPassword', 'user')";
        require_once "dbConnect.php";
        if ($conn -> query($querySaveUser) == TRUE) {
            $_SESSION["signupSuccess"] = "Account created successfully. You can login here now!";
            header("Location: login.php");
            exit();
        } else {
            echo "Failed!";
            exit();
        }
   }
    

}

function formKeep($keep) {
    echo isset($_REQUEST[$keep]) ? $_REQUEST[$keep] : '';
}
?>

<body>
<h1>Sign Up</h1>
<p>Please fill the form below and click Signup!</p>
<div class="form-input">
    <form method="post">

        <input id="mr" name="title" value="Mr" type="radio" required>
        <label for="mr"> Mr</label>
        <input id="mrs" name="title" value="Mrs" type="radio" required>
        <label for="mrs"> Mrs</label>
        <input id="miss" name="title" value="Miss" type="radio" required>
        <label for="miss"> Miss</label>

        <span class="form-error"><?php if (isset($nameError)) echo $nameError ?></span>

        <input name="fName" placeholder="First Name" value="<?php formKeep("fName"); ?>" type="text" title="First Name" required>
        <input name="lName" placeholder="Last Name" value="<?php formKeep("lName"); ?>" type="text" title="Last Name" required>

        <span class="form-error"><?php if (isset($mobileError)) echo $mobileError ?></span>

        <input name="mobile" placeholder="Mobile Number" value="<?php formKeep("mobile"); ?>" type="number" title="Mobile number must be in 07XXXXXXXX format." required>

        <span class="form-error"><?php if (isset($emailError)) echo $emailError ?></span>
        <span class="form-error"><?php if (isset($duplicateError)) echo $duplicateError ?></span>

        <input name="email" placeholder="E-Mail Address" value="<?php formKeep("email"); ?>" type="text" title="Email will be used as your login username." required>
        <label for="bDay">Birthday
            <input name="bDay" placeholder="BDay" value="<?php formKeep("bDay"); ?>" type="date" title="Must be in age between 18 and 65." required></label>

        <span class="form-error"><?php if (isset($passwordError)) echo $passwordError ?></span>

        <input name="password" placeholder="Password" value="password" type="password" title="Password" required>
        <input name="re_password" placeholder="Password" value="re_password" type="password" title="Re enter password" required>

        <input name="submit" type="submit" value="Signup">
    </form>

</div>
</body>
</html>
