<?php 
    session_start();
    include_once './../../../env.php'; 
    $email = trim($_REQUEST['email']);
    $password = $_REQUEST['password'];
    $hashPassword = password_hash ($password, PASSWORD_BCRYPT);
    $errors = [];




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



if (count($errors)>0){
    $_SESSION = $errors;
    header ('Location: ./../../backend/login.php');
}else {
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $authUserData = mysqli_fetch_assoc($result);
    
    
    if (mysqli_num_rows($result)>0){
        $isValidPassword = password_verify ($password, $authUserData ['password']);
        if($isValidPassword){
            //Redirect to Deshboard
            $_SESSION ['auth'] = $authUserData;
            header("Location: ./../../backend/dashboard.php");

        }else{
            $_SESSION['pass_error']= 'Wrong Passowrd';
            header("Location: ./../../backend/login.php");

        }

    }else{
        $_SESSION ['email_error'] = 'please enter correct email address';
        header("Location: ./../../backend/login.php");
    }
    
}

?>
