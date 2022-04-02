<?php 
  if(!isset($_SESSION['navbar'])){ 
?>
  <div class="navbar">
    <a class="active">JOB PORTAL</a>
    <a href="/JobPortal">Find jobs</a>
    <a href="/JobPortal/Candidate/signup.php" class="right">Candidate Sign up</a>
    <a href="/JobPortal/Company/register.php" class="right">Employer Sign up</a>
  </div>
<?php  
  }
  elseif($_SESSION['navbar'] == 'candidate'){ 
?>
  <div class="login">
    Welcome <?php echo $_SESSION['email'];?>
  </div>

  <div class="navbar">
    <a class="active">JOB PORTAL</a>
    <a href="/jobs.php">Find jobs</a>
    <a href="/JobPortal/Candidate/userDashboard.php" class="right">My Account</a>
    <a href="/JobPortal/logout.php" class="right">Logout</a>
  </div>
<?php  
  }
  elseif($_SESSION['navbar'] == 'employer'){ 
?>

  <div class="login">
    Welcome <?php echo $_SESSION['email'];?>
  </div>

  <div class="navbar">
    <a class="active">JOB PORTAL</a>
    <a href="/JobPortal/">HOME</a>
    <a href="/JobPortal/Company/postingPosition.php">Job Posting</a>
    <a href="/JobPortal/Company/DashboardJobPosting/dashboard.php">View Jobs Posted</a>
    <a href="/JobPortal/Company/DashboardJobActivity/jobActivity.php">View Job Activity</a>
    <a href="/JobPortal/logout.php" class="right">Logout</a>
  </div>
<?php  
  }
?>