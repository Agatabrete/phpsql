<?php
  include("phpmysql/config.php");
	session_start();
	if (isset($_SESSION['tuvastamine'])) {
	  header('Location: /admin');
	  exit();
	  } 
    // echo password_hash('admin', PASSWORD_DEFAULT);
  if (!empty($_POST['user']) && !empty($_POST['pass'])) {
  $login = $_POST['user'];
  $pass = $_POST['pass'];

  $paring = "SELECT * FROM users";
  $saada_paring = mysqli_query($yhendus, $paring);
  $rida = mysqli_fetch_assoc($saada_paring);
  // var_dump($rida);
  // $s = $rida["Pass"];
  $u = $rida["user"];
  $s = $rida["pass"];

    if ($login == $u && password_verify($pass, $s)) {
      echo "Tere admin";
      $_SESSION['tuvastamine'] = 'misiganes';
      header('Location: /phpsql/admin');
      exit();
    }
  }
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
<!-- Section: Design Block -->
<section class=" text-center text-lg-start">
  <style>
    .rounded-t-5 {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    @media (min-width: 992px) {
      .rounded-tr-lg-0 {
        border-top-right-radius: 0;
      }

      .rounded-bl-lg-5 {
        border-bottom-left-radius: 0.5rem;
      }
    }
  </style>
  <div class="card mb-3">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="https://picsum.photos/500/600" alt="Trendy Pants and Shoes"
          class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">

          <form method="post">
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input name="user" type="text" id="form2Example1" class="form-control" />
              <label class="form-label" for="form2Example1">kasutajanimi </label>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input name="pass" type="password" id="form2Example2" class="form-control" />
              <label class="form-label" for="form2Example2">Password</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                  <input name="rem" class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
              </div>

              <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
              </div>
            </div>

            <!-- Submit button -->
            <input type="submit" value="logi sisse" class="btn btn-primary btn-block mb-4">

          </form>

        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<!-- Section: Design Block -->    
</body>
</html>

