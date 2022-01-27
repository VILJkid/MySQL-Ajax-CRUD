<?php 
include("database.php");
//for add user 
if(!empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['email']) && !empty($_POST['adduser']))
{
   $name=$_POST['name'];
   $age=$_POST['age'];
   $email=$_POST['email'];
   if(mysqli_query($conn,"insert into details(name,age,email) values('$name',$age,'$email')")){
       echo "User added";
   }
   else {
       echo "User Not Added";
   }
}
//updateuser 
if(!empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['email']) && !empty($_POST['updateuser']) && !empty($_POST['id']))
{
   $name=$_POST['name'];
   $age=$_POST['age'];
   $email=$_POST['email'];
   $id=$_POST['id'];
   if(mysqli_query($conn,"update details set name='$name',age=$age,email='$email' where id=$id")){
       echo "User Updated";
   }
   else {
       echo "User Not Updated";
   }
}
//for delete user 
if(!empty($_POST['delid']))
{
    $id=$_POST['delid'];
    if(mysqli_query($conn,"delete from details where id=$id")){
        echo "User Deleted";
    }
    else {
        echo "User Not Deleted";
    }
}
//for edit user 
if(!empty($_POST['editid']))
{
    $id=$_POST['editid'];
    $sel=mysqli_query($conn,"select * from details where id=$id");
    $data=mysqli_fetch_assoc($sel);
    if($data){
        echo json_encode($data);
    }
}
