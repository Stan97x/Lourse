<?php
$title = 'Profil';
$h1 = 'Profil';
$txtHeader = 'Des informations vous Concernant on changé ? Modifiez les !';
require_once('../composants/header.php');
require_once('../db/fonctions_user.php');
require_once('../db/db_config.php');
?>
<section>
    <?php
     echo ($_SESSION['user']['ID']);
      if(!isset($_GET['id']) || !$_SESSION['user'])   {
  
  
      } else {
          $id=$_GET[''];
          $res=$User->getUsersbyUSERS($id);
          if (isset($_POST['submit'])) 
          {
              $user=$_POST['user'];
              $email=$_POST['email'];
              $password=$_POST['passowrd'];
  
              $param=[
                  $user,
                  $email,
                  $password
              ];
              $req=$User->EditUser($id,$param);
  
          }
      }
    ?>
        <h2 style="text-align: center;">Edit Profile</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">User:</label>
                <input type="text" id="user" name="user" value="<?php echo $res['user']['USER']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $res['email']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Save Changes">
            </div>
        </form>
    </div>
</section>
<?php require_once('../composants/footer.php') ?>