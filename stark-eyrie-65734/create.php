<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$productnameError = null;
		$prodcodeError = null;
		$descriptionError = null;
		$priceError = null;
		$emailError = null;
		
		// keep track post values
		$productname = $_POST['productname'];
		$prodcode = $_POST['prodcode'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$email = $_POST['email'];
		// validate input
		$valid = true;
		if (empty($productname)) {
			$productnameError = 'Please enter Product Name';
			$valid = false;
		}
		if (empty($prodcode)) {
			$prodcodeError = 'Please enter Product Code';
			$valid = false;
		}
		if (empty($description)) {
			$descriptionError = 'Please provide the description';
			$valid = false;
		}
		if (empty($price)) {
			$priceError = 'Please mention product price';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		
		
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO products (productname,prodcode,description,price,email) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($productname,$prodcode,$description,$price,$email));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a Product</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($productnameError)?'error':'';?>">
					    <label class="control-label">Product Name</label>
					    <div class="controls">
					      	<input name="productname" type="text"  placeholder="Product Name" value="<?php echo !empty($productname)?$productname:'';?>">
					      	<?php if (!empty($productnameError)): ?>
					      		<span class="help-inline"><?php echo $productnameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($prodcodeError)?'error':'';?>">
					    <label class="control-label">Product Code</label>
					    <div class="controls">
					      	<input name="prodcode" type="text" placeholder="Product Code" value="<?php echo !empty($prodcode)?$prodcode:'';?>">
					      	<?php if (!empty($prodcodeError)): ?>
					      		<span class="help-inline"><?php echo $prodcodeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
					    <label class="control-label">Product Description</label>
					    <div class="controls">
					      	<input name="description" type="text"  placeholder="Product Description" value="<?php echo !empty($description)?$description:'';?>">
					      	<?php if (!empty($descriptionError)): ?>
					      		<span class="help-inline"><?php echo $descriptionError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					   <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
					    <label class="control-label">Product Price</label>
					    <div class="controls">
					      	<input name="price" type="text"  placeholder="Product price" value="<?php echo !empty($price)?$price:'';?>">
					      	<?php if (!empty($priceError)): ?>
					      		<span class="help-inline"><?php echo $priceError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<input name="email" type="text"  placeholder="Support email" value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>