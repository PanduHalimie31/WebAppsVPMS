<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
  } else {
    if(isset($_POST['submit'])) {
    $parkingnumber=mt_rand(100000000, 999999999);
    $catename=$_POST['catename'];
    $prates=$_POST['rates'];
    $vehcomp=$_POST['vehcomp'];
    $vehreno=$_POST['vehreno'];
    $ownername=$_POST['ownername'];
    $ownercontno=$_POST['ownercontno'];
    $enteringtime=$_POST['enteringtime'];
    $query=mysqli_query($con, "insert into  tblvehicle(ParkingNumber,VehicleCategory,Price,VehicleCompanyname,RegistrationNumber,OwnerName,OwnerContactNumber) value('$parkingnumber','$catename','$prates','$vehcomp','$vehreno','$ownername','$ownercontno')");
    if ($query) {
        echo "<script>alert('Vehicle Entry Detail has been added');</script>";
        echo "<script>window.location.href ='manage-incomingvehicle.php'</script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again.');</script>";       
    }
}

?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <title>VPMS - Add Vehicle</title>
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
</head>
<body>
   <?php include_once('includes/sidebar.php');?>
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
                                    <li><a href="add-vehicle.php">Vehicle</a></li>
                                    <li class="active">Add Vehicle</li>
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
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong> Add Vehicle </strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                    <!-- Category & Price -->
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Category</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="catename" id="catename" class="form-control">
                                                <option value="0">Choose Category</option>
                                                <?php $query = mysqli_query($con, "SELECT * FROM tblcategory");
                                                while ($row = mysqli_fetch_array($query)) { ?>    
                                                    <option value="<?php echo $row['VehicleCat']; ?>" data-price="<?php echo $row['Price']; ?>">
                                                        <?php echo $row['VehicleCat']; ?>
                                                    </option>
                                                <?php } ?> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Hourly Rates</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="rates" name="rates" class="form-control" placeholder="IDR per Hours" required="true" readonly>
                                        </div>
                                    </div>

                                    <script>
                                    document.getElementById('catename').addEventListener('change', function() {
                                        // Ambil option yang dipilih
                                        var selectedOption = this.options[this.selectedIndex];
                                        // Ambil nilai dari atribut data-price
                                        var price = selectedOption.getAttribute('data-price');
                                        // Set nilai ke textbox rates
                                        document.getElementById('rates').value = price || '';
                                    });
                                    </script>

                                    <!-- Vehicle & Regis -->
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Vehicle Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="vehcomp" name="vehcomp" class="form-control" placeholder="Vehicle Name" required="true"></div>
                                    </div>
                                 
                                     <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Registration Number</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="vehreno" name="vehreno" class="form-control" placeholder="Registration Number" required="true"></div>
                                    </div>

                                    <!-- Owner & Contact -->
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Owner Name</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="ownername" id="ownername" class="form-control">
                                                <option value="0">Select Users</option>
                                                <?php $query = mysqli_query ($con, "SELECT * FROM tblregusers");
                                                while ($row = mysqli_fetch_array($query)) { ?>    
                                                 <option value="<?php echo $row['FirstName']; ?>"data-owner="<?php echo $row['OwnerContactNumber'];?>">
                                                    <?php echo $row['FirstName'];?>
                                                </option>
                                                <?php } ?> 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Contact Number</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="ownercontno" name="ownercontno" class="form-control" placeholder="Owner Contact Number" required="true" readonly>
                                        </div>
                                    </div>

                                    <script>
                                        document.getElementById('ownername').addEventListener('change',function(){
                                            var selectedOption = this.options[this.selectedIndex];
                                            var connumber =selectedOption.getAttribute('data-owner');
                                            document.getElementById('ownercontno').value = connumber || '';
                                        });
                                    </script>

                                    <!-- -->
                                   <p style="text-align: center;"> <button type="submit" class="btn btn-primary btn-sm" name="submit" >Add</button></p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php include_once('includes/footer.php');?>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
<?php }  ?>