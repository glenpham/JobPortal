<?php if(!empty($array_result)) {?>

<tr>
 <th>Job ID</th>
 <th>Job Title</th>
 <th>Applicant Fist Name</th>
 <th>Applicant Last Name</th>
 <th>Applied Date</th>
 <th>Status</th>
 <th>Accept</th>
 <th>Reject</th>
</tr>

<?php 
foreach($array_result as $value){?>
<tr>
 <td><?php echo $value['postingID'];?></td>
 <td><?php echo $value['jobTitle'];?></td>
 <td><?php echo $value['firstname'];?></td>
 <td><?php echo $value['lastname'];?></td>
 <td><?php echo $value['appliedDate'];?></td>
 <td><?php echo $value['companyStatus'];?></td>
 <td><a class="accept-nn" data-id = "<?php echo $value['id'];?>" href="#">Accept</a></td> 
 <td><a class="reject-nn" data-id = "<?php echo $value['id'];?>" href="#">Reject</a></td>
</tr>

<?php } 
}
else{ ?>
  <p>NO RECORD FOUND</p>
<?php }?>

<script src="jobActivity.js"></script>

