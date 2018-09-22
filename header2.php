
<!doctype html>
  <?php
  $name = $model->getSettings();
  ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="bootstrap-4.0.0/favicon.ico"> -->

    <title><?= $name['name'];?></title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      .banner .container {
        background: url(./img/banner1.jpg) no-repeat;
        background-size: contain;
        height: 430px;
        width: 1000px;
      }
      .hidden { display: none; }
      .banner .container p {
        width: 450px;
      }
      .custom {
        color: #377dff;
        background: rgba(55, 125, 255, 0.1);
        border-color: transparent;
        font-weight: 600;
      }
      .fixedhead {
        padding: 0!important;
        /*position: fixed;
        position: sticky;
        top: 100px;
        z-index: 999;
        width: 100%;
        top: 0;
        background: rgba(0,0,0,.3);
        border: 0;*/
      }
      .logo {
        height: 60px;
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/default.css" rel="stylesheet"/>
    <link rel="stylesheet" href="js/jQuery-File-Upload-master/css/jquery.fileupload.css"/>
    </style>
</head>

<body>
    <div class="fixedhead d-flex container flex-column flex-md-row align-items-center p-3 px-md-4 mb-3">
          <h5 class=" my-0 mr-md-auto font-weight-normal"><a href="index.php"><img src="img/logo.png" class="logo"></a></h5>
          <?php if(isset($_SESSION['id'])) : ?>
            <nav class="my-2 my-md-0 mr-md-3">
              <?php if ($_SESSION['usertype'] == "admin"): ?>
                <a class="p-2 text-black" href="admin.php">Admin</a>
              <?php elseif ($_SESSION['usertype'] == "employer"): ?>
              <a class="p-2 text-black" href="profile.php">Employer</a>
              <?php else: ?>
              <a class="p-2 text-black" href="browse.php">Browse</a>
              <?php endif ?>
              <a class="p-2 text-black" href="logout.php">Logout</a>
            </nav>
          <?php else : ?>
            <nav class="my-2 my-md-0 mr-md-3">

              <a class="p-2 text-black" href="login.php">Login
              </a>
            </nav>
            <a class="btn btn-success" href="signup.php">Sign up</a>
          <?php endif ?>

          
        </div>
      
