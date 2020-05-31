<!-- DATABASE NAME : yahoo
      table row  id , fname , lname  -->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD2</title>
					<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">	
</head>
<body>
	<div class="container">
		<h1>CRUD</h1>
          <!-- #######################Insert Into Database Table############################ -->
          <div class="container">
          	
          </div>
		<form class="form" method="POST" action="">
			<div class=" py-2 row justify-content-around">
				<div class="form-group " >
				<label>Fname</label>
				<input type="text" name="fname" class="form-control">
			   </div> 
				<div class="form-group ">
				<label>Lname</label>
				<input type="text" name="lname" class="form-control">
			   </div>
			   <input type="submit" name="insert" class="btn btn-primary align-self-center">
			</div>

			<?php
			if(isset($_REQUEST['insert'])){
				 $con = mysqli_connect('localhost','root','','yahoo');
				$fname=$_REQUEST['fname'];
                $lname=$_REQUEST['lname'];
              $sql ="INSERT INTO `person` (fname,lname) VALUES('$fname','$lname')";
               $Insertquery = mysqli_query($con,$sql);

               header("location:crud2.php");
         }
			?>
		</form>
		<!-- ################################################################# -->

		<!-- #########Select from Databse and show in Table############### -->
		<table class="table">

			<tr>
				<th>S.NO</th>
				<th>Fname</th>
				<th>Lname</th>
				<th colspan="2" style="width: 20%">EDIT</th>
			</tr>
			<?php
			 $con = mysqli_connect('localhost','root','','yahoo');
			    $Selectquery = 	mysqli_query($con,"SELECT * from person");
			     if(mysqli_num_rows($Selectquery)>0):
			          	$count=0;
                      while($data = mysqli_fetch_assoc($Selectquery)):
                          $count++;
			?>
			<tr>

				<td><?php echo $data['id']?></td>
				<td><?php echo $data['fname']?></td>
				<td><?php echo $data['lname']?></td>
				<td>
					<a href="#" class="btn btn-primary update"  data-toggle="modal">
					<i class="fa fa-pencil"></i>
				   </a>
				</td>
				<td>
					<form action="">
					<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
					<input type="submit" value="DELETE"  class="btn btn-danger" name="deleteById" id="delete">
                    </form>   
       			</td>
			</tr>

			<?php
   endwhile;
   endif;
			?>
			<!-- ####################DELETE QUERY########################## -->
			<?php

				if(isset($_REQUEST['deleteById'])){
				$Did = $_REQUEST['deleteById'];
				$id=$_REQUEST['id'];
				$sql="DELETE FROM person WHERE id= '$id' ";
				mysqli_query($con,$sql);
             }
			?>
		</table>
	</div>
     <!-- ########################################################## -->

	<!-- ######################## Update Database MODAL################################# -->
<div class="modal fade" id="updateModal">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="">
      <div class="modal-body">
        <div class="form-group">
        	<input type="text" name="fname" class="form-control" id="fname">
        </div>
        <div class="form-group">
        	<input type="text" name="lname" class="form-control" id="lname">
        </div>
        <input type="hidden" name="id" id="updateid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update">
      </div>
     </form>
       <?php
             if(isset($_REQUEST['update'])){
                $con = mysqli_connect('localhost','root','','yahoo');
             	$id = $_REQUEST['id'];
             	$fname= $_REQUEST['fname'];
             	$lname=$_REQUEST['lname'];
             	$sql= "UPDATE person SET fname='$fname',lname='$lname' WHERE id='$id' ";
             	$updatedb = mysqli_query($con,$sql);
                  //$arr = mysqli_fetch_assoc($updatedb);
                  //echo $arr;
             }
 
       ?>
    </div>
  </div>
</div>
<!-- ###################################################### -->

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://use.fontawesome.com/e779a852ac.js"></script>





<script type="text/javascript">
	//for modal
	$(document).ready(function(){
		$(".update").on("click",function(){
			$("#updateModal").modal("show")
		  $tr = $(this).closest('tr')
		    
		    var data = $tr.children("td").map(function(){
		    	return $(this).text()
		    }).get();
		    console.log(data);
             $('#updateid').val(data[0])
		    $("#fname").val(data[1]);
		    $("#lname").val(data[2]);
		    
		})
	})
</script>
</body>
</html>
