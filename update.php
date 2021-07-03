<?php
include('config.php');
include('common-array.php');
$date=date("Y-m-d H:i:s");

if (isset($_POST['update'])) {
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
            }else{
                $target_file=$_POST['pre_file'];
            }
           
$rs="update tbl_user set name='".$_POST['name']."',email='".$_POST['email']."',hobbies='".implode(',',$_POST['hobbies'])."',profile_pic='".$target_file."',password='".$_POST['password']."',modified_at='".$date."',status=1 where id='".$_POST['update']."'";
mysqli_query($conn,$rs);
header("Location:user-list.php?update=success");

}

if (isset($_GET['id'])) {
    $rs="select * from tbl_user where id='".$_GET['id']."'";
    $user=mysqli_query($conn,$rs);
    $user_row=mysqli_fetch_array($user);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please fill this form and submit to update user record to the database.</p>
                    <form method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="<?php echo $user_row['name']; ?>" onblur="Name();">
                            <span id="name_err" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $user_row['email']; ?>" autocomplete="new-email" onblur="Email();">
                            <span id="email_err" class="text-danger"></span>
                        </div>


                        <div class="form-group">
                          <label>Hobbies</label><br>
                          <?php
                              foreach($hobbies as $key => $value)

                                if (in_array($value, explode(',',$user_row['hobbies']))) { ?>
                                  <input type="checkbox"  name="hobbies[]" value="<?php echo $value; ?>" checked>
                                  <label for="<?php echo $value; ?>"><?php echo $value; ?></label><br>
                                <?php } else { ?>
                                <input type="checkbox"  name="hobbies[]" value="<?php echo $value; ?>">
                                  <label for="<?php echo $value; ?>"><?php echo $value; ?></label><br>
                                <?php } ?>
                        </div>

                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" name="file" class="form-control" id="file">
                            <input type="hidden" name="pre_file" value="<?php echo $user_row['profile_pic']; ?>">
                            <span id="file_err" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="password" value="<?php echo $user_row['password']; ?>" autocomplete="new-password" onblur="Password();">
                            <span id="password_err" class="text-danger"></span>
                        </div>

                        <button type="submit" name="update" class="btn btn-primary" value="<?php echo $user_row['id']; ?>" onclick="Checkbox();">Update</button>
                        <a href="user-list.php" class="btn btn-secondary ml-2">Home</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

    <script src="validate.js"></script>

</body>
</html>