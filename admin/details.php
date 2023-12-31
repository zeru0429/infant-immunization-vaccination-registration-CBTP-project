<?php include("./parts/header.php"); 
$id = $_GET['id'];
?>
    <!--HEADER -->
    <header id="main-header" class="py-2 bg-primary text-white">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h1>Post One</h1>
          </div>
        </div>
      </div>
    </header>
    <!--ACTIONS BUTTONS-->

    <section id="action" class="py-4 mb-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-3 mr-auto">
            <a href="post.php" class="btn btn-light btn-block"
              ><i class="fa fa-arrow-left"></i> Back to Post</a
            >
          </div>
         
          <div class="col-md-3">
            <a href="delete_post.php?id=<?php echo $id; ?>" class="btn btn-danger btn-block"
              ><i class="fa fa-remove"> Delete Post</i></a
            >
          </div>
        </div>
      </div>
    </section>
    <?php
        if(isset($_SESSION['add'])){
          echo "<h1 class='error'>". $_SESSION['add']."</h1>";
          unset($_SESSION['add']);}
   
         ?>
    <section id="posts">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h4>Edit Posts</h4>
              </div>
              <div class="card-body">
               <form action="#" method="post">
                <?php  
                      $query = "SELECT * FROM cbtp.post where post_id='$id'";
                      // echo $query;
                      // die();
                      $result = mysqli_query($conn,$query) or die(mysqli_error());
                      $rows = mysqli_num_rows($result);  
                      if ($rows>0){
                        while($rows=mysqli_fetch_assoc($result)){
                             $id=$rows['post_id'];
                             $title = $rows['tittle'];
                             $catagory = $rows['catagory'];
                             $description = $rows['description'];
                             $date_of_post = $rows['date_of_post'];
                    
                ?>

                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name='tittle' class="form-control" value="<?php echo $title; ?>" />
                  </div>
                  <div class="form-group">
                    <label for="categories">Categories </label>
                    <select name="catagory" id="catagory" value="<?php echo $catagory; ?>" class="form-control">
                      <option value="mothers vacine" <?php if($catagory=='mothers vacine') echo "selected";?> >Mother vacine</option>
                      <option value="Children vacine" <?php if($catagory=='Children vacine') echo "selected";?> > Children vacine </option>
                      <option value="Infant news" <?php if($catagory=='Infant news') echo "selected";?> > Infant news </option>
                      <option value="daily news" <?php if($catagory=='daily news') echo "selected";?> >daily news </option>
                      <option value="other" <?php if($catagory=='other') echo "selected";?> > other </option>
                    </select>
                  </div>
      
                  <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="editor1" id="" class="form-control"><?php echo $description; ?></textarea>
                  </div>
                  <?php
                      }
                    }
                  ?>
                   <div class="col-md-3">
                     <input type="submit" class="btn btn-primary" name='updatepost' value='Save change'>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>




<?php  

if(isset($_POST['updatepost'])){
          $title = $_POST['tittle'];
          $catagory = $_POST['catagory'];
          $description = $_POST['editor1'];
          $date_of_post = date('y-m-d h:m:s');
    $query ="UPDATE `cbtp`.`post` SET
             tittle='$title',
             catagory='$catagory', 
             description='$description', 
             date_of_post='$date_of_post' 
             where post_id='$id'";

    $result = mysqli_query($conn,$query)or die(mysqli_error());
    if($result == True){
        $_SESSION["add"]=$title." sucessfully added";
       # header("Location:".HOMEURL."admin/post.php");
     }else{
         $_SESSION["add"]=$title." failed to added";
        
     }
     
}















include("./parts/footer.php") ?>