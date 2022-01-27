<?php 
include("database.php");
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
          <h2> Ajax Crud Example </h2>
          <div class="container">
         
              <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" id="name"/>
              </div>
              <div class="form-group">
                  <label>Age</label>
                  <input type="text" class="form-control" id="age"/>
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" id="email"/>
              </div>
              <input type="hidden" id="uid"/>
              <input type="button" value="Submit" id="adduser" class="btn btn-success"/>
              <input type="button" value="Update" id="updateuser" class="btn btn-success"/>
         
          </div>
          <div id="resultarea">
          <table class="table">
              <tr>
                  <th>S.no</th>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Email</th>
                  <th>Action</th>
              </tr>
              <?php 
          $sel=mysqli_query($conn,"select * from users");
          if(mysqli_num_rows($sel)>0){
              $sn=1;
              while($arr=mysqli_fetch_assoc($sel)){
                  ?>
                <tr>
                    <td><?= $sn;?></td>
                    <td><?= $arr['name'];?></td>
                    <td><?= $arr['age'];?></td>
                    <td><?= $arr['email'];?></td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-primary edit" data-id="<?= $arr['id'];?>">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-danger delete" data-id="<?= $arr['id'];?>">Delete</a>
                    </td>
                </tr>
                  <?php 
                  $sn++;
              }
          }
              ?>
          </table>
          </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $("#updateuser").hide();
        //adduser
        $("#adduser").click(function(){
            alert("hello")
            var uname=$("#name").val();
            var age=$("#age").val();
            var email=$("#email").val();
            var formData={name:uname,age:age,email:email,adduser:'adduser'}
            $.ajax({
                type:"POST",
                url:"ajax.php",
                data:formData,
                success:function(data){
                    alert(data);
                   // window.location.reload();
                   $("#resultarea").load(document.URL +' #resultarea')
                }
            })
        })
        //updateuser 
        $("#updateuser").click(function(){
           
            var uname=$("#name").val();
            var age=$("#age").val();
            var email=$("#email").val();
            var id=$("#uid").val();
            var formData={name:uname,age:age,email:email,id:id,updateuser:'updateuser'}
            console.log(formData);
            $.ajax({
                type:"POST",
                url:"ajax.php",
                data:formData,
                success:function(data){
                    alert(data);
                    $("#adduser").show();
                        $("#updateuser").hide();
                        $("#name").val('');
                        $("#age").val('');
                        $("#email").val('');
                        $("#uid").val('');
                   // window.location.reload();
                   $("#resultarea").load(document.URL +' #resultarea')
                }
            })
        })
        //deleteuser 
        $(".delete").click(function(){
            if(confirm("Do u want to delete ?")==true){
                var id=$(this).data('id');
                $.ajax({
                    type:"post",
                    url:"ajax.php",
                    data:{delid:id},
                    success:function(data){
                        alert(data);
                        $("#resultarea").load(document.URL +' #resultarea')
                    }
                })
            }
        })
        $(".edit").click(function(){
                var id=$(this).data('id');
               
                $.ajax({
                    type:"post",
                    url:"ajax.php",
                    data:{editid:id},
                    dataType:'json',
                    success:function(data){
                        console.log(data.name)
                        $("#name").val(data.name);
                        $("#age").val(data.age);
                        $("#email").val(data.email);
                        $("#uid").val(data.id);
                        $("#adduser").hide();
                        $("#updateuser").show();
                    }
                })
           
        })
    })
</script>
    </body>
</html>