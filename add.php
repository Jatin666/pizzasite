<?php 

$title = $email = $ingredients = '' ;


$errors = array('email' => "",'title' =>"", 'ingredients' => "");

if(isset($_POST['submit'])){
//htmlspecialchars used for prevent xss attack
    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['ingredients']);

    //form validation
    //checking email
    if(empty($_POST['email'])){
        $errors ['email'] ='An email is required <br />';
    } else{
       $email = $_POST['email'];
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors ['email'] = 'email must be a valid email address';
       }
    }
    if(array_filter($errors)){
        //echo 'errors in the form';
    } else{
        //echo "form is valid";
        header('Location : index.php');
    }

    //checking title
    if(empty($_POST['title'])){
        $errors['title']= 'An title is required <br />';
    } else{
        $title = $_POST['title'];
        if(!preg_match('/^([a-zA-z\s]+$)/',$title)){
            $errors['title']= 'Title must be letters and spaces only';
        }
    }

    //checking ingredients
    if(empty($_POST['ingredients'])){
        $errors['ingredients'] = 'Atleast one ingredient is required <br />';
    } else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-X\s]+)(,\s*[a-zA-z\s]*)*$/',$ingredients)){
            $errors['ingredients'] = 'Ingredients must be comma separeted';
        }
    }


} //check whether the value is set

?>
<!DOCTYPE html>
<html>
    <?php include('template/header.php');?>

    <section class = "container black-text">
        <h4 class ="center">Add a pizza</h4>
        <form class = "white" action ="add.php" method ="POST"> 
        <label> Your email :</label>
        <input type="text" name = "email" value = "<?php echo htmlspecialchars($email);?>">
        <div class ="red-text"><?php echo $errors['email'];?></div>
        <label> Pizza Title:</label>
        <input type="text" name = "title" value = "<?php echo htmlspecialchars($title);?>">
        <div class ="red-text"><?php echo $errors['title'];?></div>
        <label> Ingredients(comma separated):</label>
        <input type="text" name = "ingredients" value = "<?php echo htmlspecialchars($ingredients);?>">
        <div class ="red-text"><?php echo $errors['ingredients'];?></div>
        <div class = "center">
            <input type="submit" name = "submit" value="submit" class  = "btn brand z-depth-0">
        </div>

        </form>
    </section>


    <?php include('template/footer.php');?>

</html>