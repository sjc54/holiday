<?php 
    require "../config.php";
    require "common.php";
    if (isset($_GET["id"])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);
            
            $id = $_GET["id"];
            
            $sql = "DELETE FROM works WHERE id = :id";
            
            $statement = $connection->prepare($sql);
            
            $statement->bindValue(':id', $id);
            
            $statement->execute();
            $success = "Plan successfully deleted";
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    };
    try {
        $connection = new PDO($dsn, $username, $password, $options);
		
        $sql = "SELECT * FROM works";
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
?>

<?php include "templates/header.php"; ?>


<h2>Delete a plan</h2>

<?php if ($success) echo $success; ?>

<?php foreach($result as $row) { ?>

<p>
    ID:
    <?php echo $row["id"]; ?><br> Location:
    <?php echo $row['location']; ?><br> Activity:
    <?php echo $row['activity']; ?><br> Time:
    <?php echo $row['time']; ?><br> Expenses:
    <?php echo $row['expenses']; ?><br> 
    <a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a>
</p>
<?php 
                            
                        ?>

<hr>
<?php }; 
    
?>



<form method="post">

    <input type="submit" name="submit" value="View all">

</form>


<?php include "templates/footer.php"; ?>