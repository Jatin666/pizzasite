<?php ini_set('display errors' , '1');

//MySql
//connect to the database
include('config/db_connect.php');
// $conn = mysqli_connect('localhost','admin','admin','pizza');

// //check connection
// if(!$conn){
//         echo "Connection error: " . mysqli_connect_error();
// }

//write query for all pizzas
$sql = "SELECT title, ingredients, id from pizzas ORDER BY created_at";

//make query to get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$pizza = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from the memory
mysqli_free_result($result);

//close the connection
mysqli_close($conn);

// explode(',',$pizza[0]['ingredients']);

?>
<!DOCTYPE html>
<html>
    <?php include('template/header.php');?>
<h4 class ="center grey-text">Pizzas</h4>
<div class= " container ">
    <div class = row>
        <?php foreach($pizza as $pizzz): ?>
            <div class = "col s6 md3">
                <div class ="card z-depth-0">
                    <img src ="img/pizza.svg" class = "pizza">
                    <div class = "card-content center">
                        <h6><?php echo htmlspecialchars($pizzz['title']);?></h6>
                        <div>
                            <ul>
                                <?php foreach(explode(',', $pizzz['ingredients'])as $ing){?>
                                    <li><?php echo htmlspecialchars($ing);?></li>
                                <?php } ?>
                            </ul>
                        </div>


                    </div>
                    <div class ="card-action right-align">
                        <a class = "brand-text" href="details.php?id=<?php echo $pizzz['id']?>">more info</a>
                    </div>
                </div>
            </div>

        <?php  endforeach; ?>
<?php if(count($pizza) >= 2): ?>
    <p>There are 2 or more Pizzas</p>
    <?php  else: ?>
        <p>There are less than 2 Pizzas</p>

<?php endif;?>

    </div>
</div>

    <?php include('template/footer.php');?>

</html>