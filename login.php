
<?php
  include('includes/header.php');
?>
  <style>
        body {
          background-color: rgb(228, 229, 247);
        }
        .social-login img {
          width: 24px;
        }
        a {
          text-decoration: none;
        }

        .card {
          font-family: sans-serif;
          width: 300px;
          margin-left: auto;
          margin-right: auto;
          margin-top: 0.7em;
          margin-bottom:3em;
          border-radius: 10px;
          background-color: #ffff;
          padding: 1.8rem;
          box-shadow: 2px 5px 20px rgba(0, 0, 0, 0.1);
        }

        .title {
          text-align: center;
          font-weight: bold;
          margin: 0;
        }
        .subtitle {
          text-align: center;
          font-weight: bold;
        }
        .btn-text {
          margin: 0;
        }

        .social-login {
          display: flex;
          justify-content: center;
          gap: 5px;
        }

        .google-btn {
          background: #fff;
          border: solid 2px rgb(245 239 239);
          border-radius: 8px;
          font-weight: bold;
          display: flex;
          padding: 10px 10px;
          flex: auto;
          align-items: center;
          gap: 5px;
          justify-content: center;
        }
        .fb-btn {
          background: #fff;
          border: solid 2px #5086BD;
          border-radius: 8px;
          padding: 10px;
          display: flex;
          align-items: center;
        }

        .or {
          text-align: center;
          font-weight: bold;
          border-bottom: 2px solid rgb(245 239 239);
          line-height: 0.1em;
          margin: 25px 0;
        }
        .or span {
          background: #fff;
          padding: 0 10px;
        }

        .email-login {
          display: flex;
          flex-direction: column;
        }
        .email-login label {
          color: rgb(170 166 166);
        }

        input[type="text"],
        input[type="password"] {
          padding: 10px 15px;
          margin-top: 8px;
          margin-bottom: 15px;
          border: 1px solid #ccc;
          border-radius: 8px;
          box-sizing: border-box;
        }

        .cta-btn {
          background-color: #5086BD;
          color: white;
          padding: 18px 20px;
          margin-top: 10px;
          margin-bottom: 20px;
          width: 100%;
          border-radius: 10px;
          border: none;
        }

        .forget-pass {
          text-align: center;
          display: block;
        }

</style>
<script type="text/javascript">

</script>
<?php
if(isset($_POST['login'])){

      $error= [];
      $check=true;
      if($_POST['email']==""){
          $error []="B???n ch??a nh???p Email !";
          $check = false;
      }
      
      if( $_POST['password']==""){
        $error []="B???n ch??a nh???p Password !";
        $check = false;
      }

      if($check){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password = md5($password);

        $show = "SELECT * FROM `user`";
        $result = $con->query($show);


        $check_mail=false;
        $check_password=false;


        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              if($row['email']==$email){
                  $check_mail=true;
              }
              if($row['password'] == $password){
                  $check_password = true;
              }
            }
            $check_account = true;
            
            if($check_mail==false){
              $error[]="T??i kho???n kh??ng ch??nh x??c !";
              $check_account=false;
            }
            if($check_password==false){
              $error[]="Password kh??ng kh??ng ch??nh x??c !";
              $check_account=false;
            }

            if($check_account){

              $_SESSION['email']=$email;
              $_SESSION['password']=$password;
              echo $_SESSION['email'];
              echo("
              <script>
                alert('????ng nh???p th??nh c??ng'); 
              </script>");
              echo "<script>window.open('index.php','_self')</script>";
            }
        }else{
          $error[]="T??i kho???n kh??ng t???n t???i"; 
        }
      }
  }
?>
<div class="card">
   <form method="post" action="#">
      <h2 class="title"> ????ng nh???p</h2>
      <p class="subtitle">B???n ch??a c?? t??i kho???n? <a href="register.php"> ????ng k??</a></p>

      <p class="or"><span>ho???c</span></p>

      <div class="email-login">
         <label for="email"> <b>T??i kho???n</b></label>
         <input type="text" placeholder="Email ho???c s??? ??i???n tho???i" id ="email" name="email" value="<?php if(isset($_POST['email'])){ echo($_POST['email']);} ?>" >
        <!-- <p class="error_email">Ban cua dang nhap</p><br> -->
         <label for="password"><b>M???t kh???u</b></label>
         <input type="password" placeholder="Nh???p m???t kh???u" id="pass" name="password" >
  
      </div>
      <?php if(isset($_POST['login'])){
        foreach($error as $values){
          echo $values."<br>";
        }
      } ?>
      <button class="cta-btn" id="login" name="login" type="submit">????ng nh???p</button>
      <a class="forget-pass" href="checkout.php?forgot_pass">Qu??n m???t kh???u?</a>
      

   </form>

</div>
<?php
     include('includes/footer.php');
     ?>

