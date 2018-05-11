<?php 
include 'controller.php'; 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
	
    <title>What To Buy? - List</title>
  </head>
  <body>
	  <div class="container">
		<div class="row">
			<div class="col">
				<h1>What To Buy? - List</h1>						
				<table class="table table-striped" id="mainTable">
				  <thead class="thead-dark">
					<tr>
					  <th scope="col">URI</th>
					  <th scope="col">Bought?</th>
					  <th scope="col">Change Status</th>            
					</tr>
				  </thead>
				  <tbody>
					<?php foreach ($db as $uri => $bought) { ?>
					<tr>          
					  <td><b><a href="<?php echo $uri; ?>" target="_blank"><?php echo $uri; ?></a></b></td>
					  <td><?php if ($bought == 1) { echo '<span style="color:green">YES</span>'; } else { echo '<span style="color:red">NO</span>'; } ?></td>
					  <td><a href="list.php?mark=<?php echo $uri; ?>&val=<?php if ($bought == 1) echo '0'; else echo '1';?>" class="btn btn-<?php if ($bought == 1) echo 'danger'; else echo 'success'; ?>">Change to <?php if ($bought == 1) echo ' not '; ?>bought</a></td>
					</tr>
					<?php } ?>
				  </tbody>
				</table>		
				<hr>
				<h3>Add</h3>
				<form class="form-inline" align="center">				  
				  <div class="form-group mx-sm-3 mb-2">
					<label for="inputPassword2" class="sr-only">URI</label>
					<input type="text" class="form-control" size="50" id="uri" name="uri" placeholder="http://www.bandcamp.com/...">
				  </div>
				  <button type="submit" class="btn btn-primary mb-2">+</button>
				</form>	
			</div>
		</div>
	  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<!-- DataTables -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
	<script>
		$(document).ready( function () {
			$('#mainTable').DataTable();
		} );		
	</script>
  </body>
</html>