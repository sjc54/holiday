<?php 
if (isset($_POST['submit'])) {
	
    require "../config.php"; 
    
	try {
        $connection = new PDO($dsn, $username, $password, $options);
		
        $new_work = array( 
            "location" => $_POST['location'], 
            "activity" => $_POST['activity'],
            "time" => $_POST['time'],
            "expenses" => $_POST['expenses'], 
        );
        
        $sql = "INSERT INTO works (location, activity, time, expenses) VALUES (:location, :activity, :time, :expenses)";        
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_work);
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}	
}
?>


<?php include "templates/header.php"; ?>

<h2>Add a plan</h2>

<?php if (isset($_POST['submit']) && $statement) { ?>
<p>Plan added!</p>
<?php } ?>

<form method="post">
    <label for="location">Location</label>
    <input type="text" name="location" id="location">

    <label for="activity">Activity</label>
    <input type="text" name="activity" id="activity">

    <label for="time">Time</label>
    <input type="text" name="time" id="time">

    <label for="expenses">Expenses</label>
    <input type="text" name="expenses" id="expenses">

    <input type="submit" name="submit" value="Submit">

</form>

<?php include "templates/footer.php"; ?>
