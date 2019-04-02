<?php 

    require "../config.php";
    require "common.php";

    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
            
            $work =[
              "id"         => $_POST['id'],
              "location" => $_POST['location'],
              "activity"  => $_POST['activity'],
              "time"   => $_POST['time'],
              "expenses"   => $_POST['expenses'],
              "date"   => $_POST['date'],
            ];
            
            $sql = "UPDATE `works` 
                    SET id = :id, 
                        location = :location, 
                        activity = :activity, 
                        time = :time, 
                        expenses = :expenses, 
                        date = :date 
                    WHERE id = :id";

            $statement = $connection->prepare($sql);
            
            $statement->execute($work);

        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    if (isset($_GET['id'])) {
        
        try {
            $connection = new PDO($dsn, $username, $password, $options);
            
            $id = $_GET['id'];
            
            $sql = "SELECT * FROM works WHERE id = :id";
            
            $statement = $connection->prepare($sql);
            
            $statement->bindValue(':id', $id);
            
            $statement->execute();
            
            $work = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {
        echo "No id - something went wrong";
    };

?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<p>Plan successfully changed.</p>
<?php endif; ?>

<h2>Edit a plan</h2>

<form method="post">
    
    <label for="id">ID</label>
    <input type="text" name="id" id="id" value="<?php echo escape($work['id']); ?>" >
    
    <label for="location">Location</label>
    <input type="text" name="location" id="location" value="<?php echo escape($work['location']); ?>">

    <label for="activity">Activity</label>
    <input type="text" name="activity" id="activity" value="<?php echo escape($work['activity']); ?>">

    <label for="time">Time</label>
    <input type="text" name="time" id="time" value="<?php echo escape($work['time']); ?>">

    <label for="expenses">Expenses</label>
    <input type="text" name="expenses" id="expenses" value="<?php echo escape($work['expenses']); ?>">

    <input type="submit" name="submit" value="Save">

</form>

<?php include "templates/footer.php"; ?>