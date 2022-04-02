<?php if(!empty($array_result)) {?>

<tr>
 <th>Job Title</th>
 <th>Company</th>
 <th>Applied Date</th>
 <th>Company Status</th>
 <th>Status</th>
</tr>

<?php 
foreach($array_result as $value){?>
<tr>
 <td><?php echo $value['jobTitle'];?></td>
 <td><?php echo $value['companyName'];?></td>
 <td><?php echo $value['appliedDate'];?></td>
 <td><?php echo $value['companyStatus'];?></td>
 <td><?php echo $value['candidateStatus'];?></td>
 <td><a class="accept-nn" href="#">View Details</a></td>
</tr>

<?php } 
}
else{ ?>
  <p>NO RECORD FOUND</p>
<?php }?>

<script src="jobActivity.js"></script>