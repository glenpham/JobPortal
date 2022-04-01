<?php 

  //echo print_r($_SESSION);

?>

<?php 
  if($_SESSION['navbar'] == 'home'){ 
?>
    <div class="navbar">
      <a class="active">JOB PORTAL</a>
      <a href="../index.php">Find jobs</a>
      <a href="../Candidate/signup.php" class="right">Candidate Sign up</a>
      <a href="../Company/register.php" class="right">Employer Sign up</a>
    </div>
<?php  
  }
  elseif($_SESSION['navbar'] == 'candidate'){ 
?>
    <div class="navbar">
      <a class="active">JOB PORTAL</a>
      <a href="../Candidate/jobs.php">Find jobs</a>
      <a href="userDashboard.php" class="right">My Account</a>
      <a href="/JobPortal/index.php" class="right">Logout</a>
    </div>
<?php  
  }
  elseif($_SESSION['navbar'] == 'employer'){ 
?>
    <div class="navbar">
      <a class="active">JOB PORTAL</a>
      <a href="/JobPortal/Company/postingPosition.php">Job Posting</a>
      <a href="/JobPortal/Company/DashboardJobPosting/dashboard.php">View Jobs Posted</a>
      <a href="/JobPortal/Company/DashboardJobActivity/jobActivity.php">View Job Activity</a>
      <a href="/JobPortal/index.php" class="right">Logout</a>
    </div>
<?php  
  }
?>


