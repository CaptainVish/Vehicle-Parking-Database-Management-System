<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
  	// var_dump($_POST);die;
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $category = $_POST['catename'];
    $comapny = $_POST['vehcomp'];
    $registration = $_POST['vehreno'];
    
     
    $query=mysqli_query($con, "UPDATE users
                              SET name='$name', email='$email',mobile='$mobile' , category= 'category', comapny = '$company', registration = '$registration' 
                              WHERE id='$id' ");
    if ($query) {
echo "<script>alert('Users Added Successfully');</script>";
// echo "<script>window.location.href ='manage-incomingvehicle.php'</script>";
  }
  else
    {
     echo "<script>alert('Something Went Wrong. Please try again.');</script>";       
    }

  
}
  ?>
<!doctype html>
<html class="no-js" lang="">
<head>
    
    <title>Edit User</title>
   

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
   <?php include_once('includes/sidebar.php');?>
    <!-- Right Panel -->

   <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Edit Users</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            
                           
                        </div> <!-- .card -->

                    </div><!--/.col-->

              

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Edit </strong> User
                            </div>
                            <?php
                            if (isset($_GET['edit']) && $_GET['edit'] == 1 && isset($_GET['id'])) {
                              $query=mysqli_query($con, "select * from users where id=".$_GET['id']."");
                              $data=mysqli_fetch_array($query);
                            }else{
                              header('Location: ' . $_SERVER['HTTP_REFERER']);
                            }


                            ?>
                            <div class="card-body card-block">
                                <form action="action.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>

  									<!-- name -->
                    <input type="hidden" name="id" value="<?=$_GET['id']?>">
  									<div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="user_name" name="user_name" class="form-control" placeholder="User Name" required="true" value="<?=$data['name']?>"></div>
                                    </div>
  									<!-- end -->

  									<!-- email -->
  									<div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                                        <div class="col-12 col-md-9"><input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required="true" value="<?=$data['email']?>"></div>
                                    </div>
  									<!-- end -->

  									<!-- email -->
  									<div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mobile No.</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile Number" required="true" value="<?=$data['mobile']?>"></div>
                                    </div>
  									<!-- end -->
                                   

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Select</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="catename" id="catename" class="form-control">
                                                <option value="0">Select Category</option>
                                                <?php $query=mysqli_query($con,"select * from tblcategory");
              while($row=mysqli_fetch_array($query))
              {
              ?>    
                                                 <option value="<?php echo $row['VehicleCat'];?>" <?php if($data['category'] == $row['VehicleCat']) echo 'selected'?>><?php echo $row['VehicleCat'];?></option>
                  <?php } ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Vehicle Company</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="vehcomp" name="vehcomp" class="form-control" placeholder="Vehicle Company" required="true" value="<?=$data['comapny']?>"></div>
                                    </div>
                                 
                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Registration Number</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="vehreno" name="vehreno" class="form-control" placeholder="Registration Number" required="true" value="<?=$data['registration']?>"></div>
                                    </div>
                                    <!-- <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Owner Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="ownername" name="ownername" class="form-control" placeholder="Owner Name" required="true"></div>
                                    </div> -->
                                     <!-- <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Owner Contact Number</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="ownercontno" name="ownercontno" class="form-control" placeholder="Owner Contact Number" required="true" maxlength="10" pattern="[0-9]+"></div>
                                    </div> -->
                                   
                                    
                                    
                                   <p style="text-align: center;"> <button type="submit" class="btn btn-primary btn-sm" name="submit" >Update</button></p>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-lg-6">
                        
                  
                </div>

           

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

   <?php include_once('includes/footer.php');?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
<?php }  ?>