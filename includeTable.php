<?php if(!empty($array_result)) {?>

<tr>
 <th>ID</th>
 <th>Company</th>
 <th>Job Title</th>
 <th>Job Type</th>
 <th>Job Location</th>
 <th>Job Description</th>
 <th>Salary</th>
 <th>Benefits</th>
 <th>Status</th>
 <th>Created Date</th>
 <th>Apply</th>
</tr>

<?php 
foreach($array_result as $value){?>
<tr>
 <td><?php echo $value['id'];?></td>
 <td><?php echo $value['companyName'];?></td>
 <td><?php echo $value['jobTitle'];?></td>
 <td><?php echo $value['jobType'];?></td>
 <td><?php echo $value['jobLocation'];?></td>
 <td><?php echo $value['jobdescription'];?></td>
 <td><?php echo $value['salary'];?></td>
 <td><?php echo $value['benefits'];?></td>
 <td><?php echo $value['status'];?></td>
 <td><?php echo $value['createdDate'];?></td>
 <td><?php if (!isset($_SESSION['candidateID'])){ ?> <a href="Candidate/signup.php">Apply</a> <?php ;} 
 
 elseif ($value['status'] == 'active' && $_SESSION['candidateID'] != ''){ ?><a href="Candidate/apply.php?jobID=<?php echo $value['id'];?>">Apply</a><?php }?></td>
</tr>

<?php } 
}
else{ ?>
  <p>NO RECORD FOUND</p>
<?php }?>

<script src="companyAccount.js"></script>

