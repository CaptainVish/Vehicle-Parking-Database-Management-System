<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
}

if(isset($_GET['delete']) && $_GET['delete'] == 1 && isset($_GET['id'])){
	$query=mysqli_query($con, "DELETE FROM users WHERE id = ".$_GET['id']."");
    if ($query) {
		echo "<script>alert('User Deleted Successfully');</script>";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		// echo "<script>window.location.href ='manage-incomingvehicle.php'</script>";
	}else{
		echo "<script>alert('Something Went Wrong. Please try again.');</script>";       
    }
}elseif (isset($_POST['id']) && $_POST['id'] != null) {
	$name = $_POST['user_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $category = $_POST['catename'];
    $comapny = $_POST['vehcomp'];
    $registration = $_POST['vehreno'];

	$query=mysqli_query($con, "
							UPDATE users
                            SET name='$name', email='$email',mobile='$mobile' , category= '$category', comapny = '$comapny', registration = '$registration' 
                            WHERE id=".$_POST['id']."");

	if ($query) {
		echo "<script>alert('Updated Successfully');</script>";
		// header('Location: ' . $_SERVER['HTTP_REFERER']);
		echo "<script>window.location.href ='users_list.php'</script>";
	}else{
		echo "<script>alert('Something Went Wrong. Please try again.');</script>";       
    }
}elseif (isset($_GET['park']) && $_GET['park'] == 1 && isset($_GET['id'])) {
	$query=mysqli_query($con, "select * from users where id = ".$_GET['id']."");
	$data=mysqli_fetch_array($query);

	$parkingnumber=mt_rand(100000000, 999999999);
    $catename=$data['category'];
    $vehcomp=$data['comapny'];
    $vehreno=$data['registration'];
    $ownername=$data['name'];
    $ownercontno=$data['mobile'];
    $enteringtime=$data['enteringtime'];

    $query=mysqli_query($con, "insert into  tblvehicle(ParkingNumber,VehicleCategory,VehicleCompanyname,RegistrationNumber,OwnerName,OwnerContactNumber) value('$parkingnumber','$catename','$vehcomp','$vehreno','$ownername','$ownercontno')");
    if ($query) {
		echo "<script>alert('Vehicle Entry Detail has been added');</script>";
		echo "<script>window.location.href ='manage-incomingvehicle.php'</script>";
  	}else{
		echo "<script>alert('Something Went Wrong. Please try again.');</script>";       
    }
}