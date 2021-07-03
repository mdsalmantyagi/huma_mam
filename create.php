<?php
include('config.php');
$date=date("Y-m-d H:i:s");

if (isset($_POST['submit'])) {
            $file_names = $_FILES['file']['name'];
            if(!empty($file_names))
            {
                $image_arr=explode(".",$file_names);
                $filename = rand(1000, 10000);
                $extension = $image_arr[1];
                  $location = $_FILES['file']['tmp_name'];
                  $target_file = $filename."_".time().".".$extension;
                  $filepath = "images/".$target_file; 
                  $upload = move_uploaded_file($location, $filepath);
            }
           
$rs="insert into tbl_user(name,email,hobbies,profile_pic,password,created_at,status)values('".$_POST['name']."','".$_POST['email']."','".implode(',',$_POST['hobbies'])."','".$target_file."','".$_POST['password']."','".$date."',1)";
mysqli_query($conn,$rs);
header("Location:user-list.php?insert=success");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add user record to the database.</p>
                    <form method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" id="name" onblur="Name();">
                            <span id="name_err" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" id="email" autocomplete="new-email" onblur="Email();">
                            <span id="email_err" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                          <label>Hobbies</label><br>
                          <input type="checkbox" id="dance" name="hobbies[]" value="Dance">
                          <label for="dance">Dance</label><br>
                          <input type="checkbox" id="yoga" name="hobbies[]" value="Yoga">
                          <label for="yoga">Yoga</label><br>
                          <input type="checkbox" id="blogging" name="hobbies[]" value="Blogging">
                          <label for="blogging">Blogging</label><br>
                          <input type="checkbox" id="cooking" name="hobbies[]" value="Cooking">
                          <label for="cooking">Cooking</label><br>
                          <span id="hobbies_err" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" name="file" class="form-control" id="file">
                            <span id="file_err" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="password" autocomplete="new-password" onblur="Password();">
                            <span id="password_err" class="text-danger"></span>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary" value="Submit" onclick="Checkbox();">Add<button></button>
                        <a href="user-list.php" class="btn btn-secondary ml-2">Home</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

    <script src="validate.js"></script>

</body>
</html>