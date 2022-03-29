<?php if(!empty($array_result)) {?>

<tr>
 <th>Job ID</th>
 <th>Job Title</th>
 <th>Applicant Fist Name</th>
 <th>Applied Date</th>
 <th>Status</th>
 <th>CV</th>
</tr>

<?php 
foreach($array_result as $value){?>
<tr>
 <td><?php echo $value['postingID'];?></td>
 <td><?php echo $value['jobTitle'];?></td>
 <td><?php echo $value['candidateID'];?></td>
 <td><?php echo $value['appliedDate'];?></td>
 <td><?php echo $value['companyStatus'];?></td>
 <td><?php echo $value['cv'];?></td>
 <td><a class="accept-nn" data-id = "<?php echo $value['id'];?>" href="#">Accept</a> | <a class="reject-nn" data-id = "<?php echo $value['id'];?>" href="#">Reject</a></td>
</tr>

<?php } 
}
else{ ?>
  <p>NO RECORD FOUND</p>
<?php }?>

<script src="jobActivity.js"></script>

