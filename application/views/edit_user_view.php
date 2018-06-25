<?php 
//print_r($user);
//die;
$vehecale_Array = explode(',', $user['user_vehical']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">
   $(document).ready(function () {


     $("#add_user").on("submit", function (e) {
        e.preventDefault();

        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var gender = $("#gender").val();
        var dob = $("#bday").val();
        var range = $("#range").val();
        var age = $("#age").val();
        var address = $("#address").val();
        var mobile = $("#mobile").val();
        var email = $("#email").val();
        var password = $('#pwd').val();
        var cpassword = $('#cpwd').val();
        var quation = $('#squestion').val();


        var vehicle=document.getElementsByName('vehicle');
        var selectedItems="";
        for(var i=0; i<vehicle.length; i++){
          if(vehicle[i].type=='checkbox' && vehicle[i].checked==true)
            selectedItems+=vehicle[i].value+",";
        }
        //alert(selectedItems);

        /*
        var favorite = [];
        $.each($("input[name='vehicle']:checked"), function(){            
            favorite.push($(this).val());
        });
        alert("My favourite sports are: " + favorite.join(", "));
        */

        var base_url = "<?php echo base_url(); ?>home/add_user";

        if (firstname == null || firstname == "") {
            var data = "Please enter firstname.";
            $("#error_firstname").text(data);
            return false;
        } else {
            $("#error_firstname").text("");
        }

        if (lastname == null || lastname == "") {
            var data = "Please enter lastname.";
            $("#error_lastname").text(data);
            return false;
        } else {
            $("#error_lastname").text("");
        }


        if (dob == null || dob == "") {
            var data = "Please select dob.";
            $("#error_dob").text(data);
            return false;
        } else {
            $("#error_dob").text("");
        }

        if (address == null || address == "") {
            var data = "Please select address.";
            $("#error_address").text(data);
            return false;
        } else {
            $("#error_address").text("");
        }


        if (mobile == null || mobile == "") {
            var data = "Please select mobile.";
            $("#error_mobile").text(data);
            return false;
        } else {
            $("#error_mobile").text("");
        }


        if (email == null || email == "" ) {
            var data = "Please Enter email.";
            $("#error_email").text(data);
            return false;
        } else {
            $("#error_email").text("");
        }


        if (password == null || password == "") {
            var data = "Please Enter password.";
            $("#error_password").text(data);
            return false;
        } else {
            $("#error_password").text("");
        }

        $.ajax({
         type: 'POST',
         url: base_url,
         data: {
            firstname: firstname,
            lastname: lastname,
            gender: gender,
            dob: dob,
            range: range,
            age: age,
            address:address,
            mobile: mobile,
            email: email,
            password: password,
            cpassword: cpassword,
            quation: quation,
            vehicle:selectedItems
        },
        success: function (data)
        {
          if (data == 0) {

             document.getElementById("add_user").reset();

/*               $("#firstname").val("");
               $("#lastname").val("");
               $("#gender").val("");
               $("#bday").val("");
               $("#range").val("");
               $("#age").val("");
               $("#address").val("");
               $("#mobile").val("");
               $("#email").val("");
               $('#pwd').val("");
               $('#cpwd').val("");
               $('#squestion').val("");
               $('#vehicle').val("");
               */

               $("#error_message").text('Promocode successfully inserted');
              //window.location.href = "<?php //echo base_url(); ?>promocode/index";
          }
          if (data == 1) {0
             $("#error_message").text('Server Authentication Failed Please Try Again');
         }
         if (data == 3) {
             $("#error_message").text('Promocode already exist please try other name.');
         }
     },
     error: function () {
     }
 });
    });

});
</script>
</head>
<body>
  <div class="jumbotron text-center">
    <p><h3>User Information<h3></p> 
</div>
<div class="container">
    <div class="row">
      <div class=" col-sm-offset-2 col-sm-8">
        <h2>Horizontal form</h2>
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" id="add_user">
          <div class="form-group">
            <label class="control-label col-sm-2" for="firstname">Firstname:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="firstname" placeholder="Please Enter firstname" name="firstname" value="<?php echo $user['user_firstname']; ?>">
          </div>
          <label id="error_firstname" class="control-label pull-left"></label>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="lastname">Lastname:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="lastname" placeholder="Please Enter lastname" name="lastname" value="<?php echo $user['user_lastname']; ?>">
      </div>
      <label id="error_lastname" class="control-label pull-left"></label>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="gender">Gender:</label>
    <div class="col-sm-6">
      <input type="radio" name="gender" id="gender" value="male" <?= 'male' == $user['user_gender'] ? 'checked' : '' ?>> Male<br>
      <input type="radio" name="gender" id="gender" value="female" <?= 'female' == $user['user_gender'] ? 'checked' : '' ?>> Female<br>
      <input type="radio" name="gender" id="gender" value="other" <?= 'other' == $user['user_gender'] ? 'checked' : '' ?>> Other
  </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="gender">Date of Birth:</label>
    <div class="col-sm-6">
      <input type="date" class="form-control"  id="bday" placeholder="Select Birth Date" name="bday" value="<?php echo $user['user_dob']; ?>">
  </div>
  <label id="error_bday" class="control-label pull-left"></label>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="profile">Profile Pic:</label>
    <div class="col-sm-6">
      <input type="file"  id="profile"  name="profile">
  </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="profile">Age:</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" id="age" name="age" min="1" max="100" value="<?php echo $user['user_age']; ?>">
  </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="profile">Range:</label>
    <div class="col-sm-6">
      <input type="range" name="range" id="range" min="0" max="10" value="<?php echo $user['user_range']; ?>">
  </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="address">Address:</label>
    <div class="col-sm-6">
      <textarea class="form-control" id="address" placeholder="Please Enter Address" name="address"><?php echo $user['user_firstname']; ?></textarea>
  </div>
    <label id="error_address" class="control-label pull-left"></label>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="mobile">Mobile:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="mobile" placeholder="Please Enter Mobile number" name="mobile" value="<?php echo $user['user_mobile']; ?>">
  </div>
            <label id="error_mobile" class="control-label pull-left"></label>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-6">
      <input type="email" class="form-control" id="email" placeholder="Please Enter Email" name="email" value="<?php echo $user['user_email']; ?>">
  </div>
            <label id="error_email" class="control-label pull-left"></label>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-6">          
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" value="<?php echo $user['user_password']; ?>">
  </div>
            <label id="error_password" class="control-label pull-left"></label>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="cpwd">Conform Password:</label>
    <div class="col-sm-6">          
      <input type="password" class="form-control" id="cpwd" placeholder="Enter Conform password" name="cpwd" value="<?php echo $user['user_password']; ?>">
  </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="squestion">Sequrity Quation:</label>
    <div class="col-sm-6">          
      <select class="form-control"  name="squestion" id="squestion">
        <option>--Select--</option>
        <option>Your Fevorite Car ?</option>
        <option>Your Fevorite Teacher ?</option>
        <option>Your Fevorite Food ?</option>
        <option>Your Fevorite School ?</option>
    </select>
</div>
</div>
<div class="form-group">  
  <label class="control-label col-sm-2" for="vehicle">Which Vehical you have</label>      
  <div class="col-sm-6">
      <div class="checkbox">
        <input type="checkbox" name="vehicle" id="vehicle" value="Bike"  <?= (in_array('Bike', $vehecale_Array)) ? 'checked' : '' ?>> I have a bike<br>
        <input type="checkbox" name="vehicle" id="vehicle" value="Car" <?= (in_array('Car', $vehecale_Array)) ? 'checked' : '' ?>> I have a car 
    </div>
</div>
</div>
<div class="form-group">        
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" class="btn btn-default">Submit</button>
  </div>
</div>
</form>
</div>
</div>
</div>
</body>
</html>
