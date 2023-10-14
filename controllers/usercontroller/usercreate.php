<?php 
    session_start();
    include_once './../../../env.php';
    $fName = trim($_REQUEST['fName']);
    $lName = trim($_REQUEST['lName']);
    $email = trim($_REQUEST['email']);
    $password = $_REQUEST['password'];
    $confirmPassword = $_REQUEST['confirmPassword'];
    $hashPassword = password_hash ($password, PASSWORD_BCRYPT);
    $errors = [];


//First Name Validation
if (empty($fName)){
    $errors ['fNameError'] = 'First name is required';
}elseif (strlen($fName)>20){
    $errors ['fNameError'] = 'First name can not be more than 20 charactr';
}

//Last Name Validation
if (empty($lName)){
    $errors ['lNameError'] = 'Last name is required';
}elseif (strlen($lName)>20){
    $errors ['lNameError'] = 'Last name can not be more than 20 charactr';
}

//Email Validation
if (empty($email)){
    $errors ['emailError'] = 'Email is required';
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors ['emailError'] = 'Invalid Email Address';
}

//Password Validation
if (empty($password)){
    $errors ['passwordError'] = 'Password is required';
}elseif (strlen($password)<8){
    $errors ['passwordError'] = 'Password can not be less than 8 charactr';
}

//Confirm Password Validation
if ($password !== $confirmPassword){
    $errors ['confirmPasswordError'] = 'Password did not match';
}

if (count($errors)>0){
    $_SESSION = $errors;
    header ('Location: ./../../backend/register.php');
}else {
    $query = "INSERT INTO users(fName, lName, email, password) VALUES ('$fName','$lName','$email','$hashPassword')";
    $result = mysqli_query($conn, $query);

    if ($result){
        $_SESSION ["succcess"]= "Account created successfully";
        header ('Location: ./../../backend/login.php');
    }else{
        $_SESSION ["failed"]= "something wrong";
        header ('Location: ./../../backend/register.php');

    }

}


?>