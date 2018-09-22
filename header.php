
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
    <title><?= $name['name'];?></title>
    <link href="bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </style>
</head>

<body>
    <div class="fixedhead d-flex container flex-column flex-md-row align-items-center p-3 px-md-4 mb-3">
          <h5 class=" my-0 mr-md-auto font-weight-normal"><a href="index.php"><img src="img/logo.png" class="logo"></a></h5>
          <?php if(isset($_SESSION['usertype'])) : ?>
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
          <?php endif ?>

          
        </div>
      
