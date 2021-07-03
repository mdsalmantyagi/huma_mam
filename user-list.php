<?php
include('config.php');
    if(isset($_GET['del'])){
      $update="update `tbl_user` set status=0 where id='".$_GET['del']."'";
        mysqli_query($conn,$update);  
      header('location:user-list.php?delete=success');
        }
?>
<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>User Records</h2>

    <?php if(isset($_GET['insert']) && ($_GET['insert']=='success')){?>
    <div id="alert_box_err" class="alert alert-dismissable alert-success">
    User save successfully.
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
    <?php } ?>

    <?php if(isset($_GET['update']) && ($_GET['update']=='success')){?>
    <div id="alert_box_err" class="alert alert-dismissable alert-success">
    User updated successfully.
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   </div>
    <?php } ?>

    <?php if(isset($_GET['delete']) && ($_GET['delete']=='success')){?>
    <div id="alert_box_err" class="alert alert-dismissable alert-danger">
    User deleted successfully.
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   </div>
    <?php } ?>

<table>
    <th>#</th>  
        <th>Name</th>
        <th>Email</th>
        <th>Hobbies</th>
        <th>Iamge</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
                          <?php
                                $c=1;
                                $rs="select * from `tbl_user` where status='1' order by id desc";
                                $user=mysqli_query($conn,$rs);
                                while($user_row=mysqli_fetch_array($user)){
                                    ?>
                                 <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $user_row['name']; ?></td>
                                    <td><?php echo $user_row['email']; ?></td>
                                    <td><?php echo $user_row['hobbies']; ?></td>
                                    <td><img src="images/<?php echo $user_row['profile_pic']; ?>" width='50px;' height='50px;'></td>
                                    <td><?php echo $user_row['created_at']; ?></td>
                                    <td>
                                     <a type="button" class="btn btn-secondary" href="user-list.php?del=<?php echo $user_row['id']; ?>"> 
                                     <i class="fa fa-trash" aria-hidden="true">Delete</i></a>
                                     <a type="button" class="btn btn-secondary" href="update.php?id=<?php echo $user_row['id']; ?>"> 
                                     <i class="fa fa-trash" aria-hidden="true">Edit</i></a>
                                     

                            </td>
                                </tr>
                         <?php  $c++;
                                }
                            ?>
</table>

</body>
<script type="text/javascript">
setTimeout(function() {
$('.alert').fadeOut('fast');
}, 4000);
</script>
</html>
