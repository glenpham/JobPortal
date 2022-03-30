<?php if(!empty($array_result)) {?>

<tr>
 <th>ID</th>
 <th>Job Title</th>
 <th>Job Type</th>
 <th>Job Location</th>
 <th>Job Description</th>
 <th>Salary</th>
 <th>Benefits</th>
 <th>Status</th>
 <th>Created Date</th>
</tr>

<?php 
foreach($array_result as $value){?>
<tr>
 <td><?php echo $value['id'];?></td>
 <td><?php echo $value['jobTitle'];?></td>
 <td><?php echo $value['jobType'];?></td>
 <td><?php echo $value['jobLocation'];?></td>
 <td><?php echo $value['jobdescription'];?></td>
 <td><?php echo $value['salary'];?></td>
 <td><?php echo $value['benefits'];?></td>
 <td><?php echo $value['status'];?></td>
 <td><?php echo $value['createdDate'];?></td>
 <td><a href="edit.php/<?php echo $value['id'];?>">Edit</a></td>
 <td><a class="delete-anchor-nn" data-id = "<?php echo $value['id'];?>" href="#">Delete</a></td>
 <td><a href="../DashboardJobActivity/jobActivity.php/<?php echo $value['id'];?>">Applicants</a></td>
</tr>

<?php } 
}
else{ ?>
  <p>NO RECORD FOUND</p>
<?php }?>

<script src="companyAccount.js"></script>

