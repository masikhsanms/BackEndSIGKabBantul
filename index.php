<?php 
// session_start();
// ob_start();
require_once('config/koneksi.php');
require_once('model/database.php');
include 'session.php';
// // include 'login.php';

$connection = new Database ($host, $user, $pass, $database);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Web Admin Wisata</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/dataTable/datatables.min.css" rel="stylesheet">
    <!-- <link href="assets/dataTable/DataTables-1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet"> -->

    
    <!-- css untuk sorting data table -->
    <style type="text/css">
        table.dataTable thead th {
          position: relative;
          background-image: none !important;
        }

        table.dataTable thead th.sorting:after,
        table.dataTable thead th.sorting_asc:after,
        table.dataTable thead th.sorting_des:after {
          position: absolute;
          top: 12px;
          right: 8px;
          display: block;
          font-family: FontAwesome;
        }

        table.dataTable thead th.sorting:after {
          content: "\f0dc";
          color: #ddd;
          font-size: 0.8em;
          padding-top: 0.12em;
        }
        table.dataTable thead th.sorting_asc:after {
          content: "\f0de";  
        }
        table.dataTable thead th.sorting_desc:after {
          content: "\f0dd";  
        }
    </style>
    <!-- end css untuk sorting data table -->


    <!-- Add custom CSS here -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?page=dashboard"><b>Administrator</b></a>
        </div>
        

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>  
            <li><a href="?page=wisata"><i class="fa fa-map-marker"></i> Data Wisata Alam</a></li>
            <li><a href="?page=desawisata"><i class="fa fa-home"></i> Data Desa Wisata</a></li>         

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Akomodasi <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=hotel"><i class="fa fa-h-square"></i> Data Hotel</a></li>
                <li><a href="?page=restoran"><i class="fa fa-cutlery"></i> Data Restoran</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Ikhsan <b class="caret"></b></a>
              <ul class="dropdown-menu">
<!--                 <li class="divider"></li>
 -->                <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">
      <!-- logika -->

      <?php 
        if(@$_GET['page'] == 'dashboard' || @$_GET['page'] == ''){
          include 'view/dashboard.php'; 
        }elseif (@$_GET['page'] == 'wisata') {
          include 'view/wisata.php';
        }elseif (@$_GET['page'] == 'hotel') {
          include 'view/hotel.php';
        }elseif (@$_GET['page'] == 'restoran') {
          include 'view/restoran.php';
        }elseif (@$_GET['page'] == 'desawisata') {
          include 'view/desawisata.php';
        }
        
      ?>
        
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/dataTable/datatables.min.js"></script>
    
    <!-- <link href="assets/dataTable/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <script type="text/javascript">
      $(document).ready(function(){
        $('#datatable').DataTable();
      });
    </script>


  </body>
</html>