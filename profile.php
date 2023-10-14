<?php
    require_once './backend_inc/header.php';
 
?>

<div class = "container-fluid">
    Profile Page
</div>
<div class = "row">
    <div class = "col-5 text-center">
       <div> 
        <label for="profile_input">
        <img src="https://api.dicebear.com/7.x/initials/svg?seed=<?=$_SESSION['auth']['fName']?>" alt="" class = "w-50 rounded"> 
        </label>
        <input type = "file" id = "profile_input" class = "d-none">
       </div>
        <button class = "btn btn-primary">Update Photo </button>

    </div>
    <div class = "col-7">
        <form action="" method = "POST">
            <label for="">First Name</label>
            <input type = "text" class = "form-control mb-4" value="<?=$_SESSION['auth']['fName']?>">
            <label for="">Last Name</label>
            <input type = "text" class = "form-control mb-4" value="<?=$_SESSION['auth']['lName']?>">
            <label for="">email</label>
            <input type = "text" class = "form-control mb-4" value="<?=$_SESSION['auth']['email']?>">
            <button type= "submit" class = "btn btn-primary"> Save Changes </button>

        </form>

    </div>
</div>

<?php
    require_once './backend_inc/footer.php';
?>