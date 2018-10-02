<header class="masthead mb-auto">
  <div class="inner">
    <h3 class="masthead-brand">ColorBlind</h3>
    <nav class="nav nav-masthead justify-content-center">
      <a class="nav-link <?= ($active=='index') ? 'active' : '';?>" href="index.php">Home</a>
      <a class="nav-link <?= ($active=='upload') ? 'active' : '';?> " href="newexams.php">Upload Exam</a>
      <a class="nav-link <?= ($active=='incomplete') ? 'active' : '';?>" href="incomplete.php">Pending Exam</a>
      <a class="nav-link <?= ($active=='exams') ? 'active' : '';?>" href="exams.php">Exams</a>
      <a class="nav-link <?= ($active=='login') ? 'active' : '';?>" href="login.php">Admin Login</a>
    </nav>
  </div>
</header>