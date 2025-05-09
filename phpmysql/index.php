<?php include("config.php"); ?>

<!doctype html>
<html lang="et">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HKHK spordipäev 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <h1>HKHK spordipäev 2025</h1>

        <?php
            if(isset($_GET["muuda"]) && isset($_GET["id"])) {
                $id = $_GET["id"];
                $kuvaparing = "SELECT * FROM sport2025 WHERE id=".$id."";
                $saada_paring = mysqli_query($yhendus, $kuvaparing);
                $rida = mysqli_fetch_assoc($saada_paring);

            

                // $muuda_paring="UPDATE sport2025 SET fullname= 'Imre Tardi', email='uuss@gmail.com', age='11', gender='apach', category='laulmine' WHERE id = 1";
            }
            
            if(isset($_GET["salvesta_muudatus"]) && isset($_GET["id"])) {
                $id = $_GET["id"];
                $fullname = $_GET["fullname"];
                $email = $_GET["email"];
                $age = $_GET["age"];
                $gender = $_GET["gender"];
                $category = $_GET["category"];

                $muuda_paring="UPDATE sport2025 SET fullname= '".$fullname."', email='".$email."', age='".$age."', gender='".$gender."', category='".$category."' WHERE id = ".$id."";

                $saada_paring = mysqli_query($yhendus, $muuda_paring);
                $tulemus = mysqli_affected_rows($yhendus);
                if($tulemus == 1){
                    header('Location: index.php?msg=andmed uuendatud');
                } else {
                    echo "andmed pole uuendatud";
                }
            }

        ?>

        <form action="index.php" method="get">
            <input type="hidden" name="id" value="<?php  !empty($rida['id']) ? print_r($rida['id']) : '' ?>"><br>
            Nimi: <input type="text" name="fullname" required value="<?php  !empty($rida['fullname']) ? print_r($rida['fullname']) : '' ?>"><br>
            Email: <input type="email" name="email" required value="<?php  !empty($rida['email']) ? print_r($rida['email']) : '' ?>"><br>
            Vanus: <input type="number" name="age" min="16" max="88" step="1" required value="<?php  !empty($rida['age']) ? print_r($rida['age']) : '' ?>"><br>
            Sugu: <input type="text" name="gender" required value="<?php  !empty($rida['gender']) ? print_r($rida['gender']) : '' ?>"><br>
            Spordiala: <input type="text" name="category" required value="<?php  !empty($rida['category']) ? print_r($rida['category']) : '' ?>"><br>

            <?php if(isset($_GET["muuda"]) && isset($_GET["id"])){ ?>
                <input type="submit" value="Salvesta_muudatus" name="salvesta_muudatus" class="btn btn-primary"><br>
            <?php } else { ?>
                <input type="submit" value="Salvesta" name="salvesta" class="btn btn-primary"><br>
            <?php } ?>
        </form>
        <?php
            if(isset($_GET['msg'])){
                echo "<div class='alert alert-success'>".$_GET['msg']."</div>";
            }

            if  (isset($_GET["salvesta"]) && !empty($_GET["fullname"])) {

                $fullname = $_GET["fullname"];
                $email = $_GET["email"];
                $age = $_GET["age"];
                $gender = $_GET["gender"];
                $category = $_GET["category"];

                $lisa_paring = "INSERT INTO sport2025 (fullname, email, age, gender, category)
                VALUES ('".$fullname."', '".$email."', '".$age."', '".$gender."', '".$category."')";

                $saada_paring = mysqli_query($yhendus, $lisa_paring);
                $tulemus = mysqli_affected_rows($yhendus);
                if($tulemus == 1){
                    echo "Kirje edukalt lisatud";
                } else {
                    echo "Kirjet ei lisatud";
                }

            }
        ?>

        <form action="index.php" method="get" class="py-4">
            <input type="text" name="otsi">
            <select name="cat">
                <option value="fullname">Nimi</option>
                <option value="category">Spordiala</option>
            </select>
            <input type="submit" value="Otsi...">
        </form>
        
        <table class="table table-striped">
    <tr>
        <th>id</th>
        <th>fullname</th>
        <th>email</th>
        <th>age</th>
        <th>gender</th>
        <th>category</th>
        <th>reg_time</th>
        <th>Muuda</th>
        <th>Kustuta</th>
    </tr>
        <?php

            

            if  (isset($_GET["kustuta"]) && isset($_GET["id"])) {
                $id = $_GET["id"];
                $kparing = "DELETE FROM sport2025 WHERE id=".$id."";
                $saada_paring = mysqli_query($yhendus, $kparing);
                $tulemus = mysqli_affected_rows($yhendus);
                if($tulemus == 1){
                    header('Location: index.php?msg=Rida kustutatud');
                } else {
                    echo "Kirjet ei kustutatud";
                }

            }

            // Leheküljenumber
            //uudiseid ühel lehel
            $uudiseid_lehel = 50;

            $uudiseid_kokku_paring = "SELECT COUNT('id') FROM sport2025";
            $lehtede_vastus = mysqli_query($yhendus, $uudiseid_kokku_paring);
            $uudiseid_kokku = mysqli_fetch_array($lehtede_vastus);
            $lehti_kokku = $uudiseid_kokku[0];
            $lehti_kokku = ceil($lehti_kokku/$uudiseid_lehel);
            //var_dump($lehti_kokku);
            echo 'Lehekülgi kokku: '.$lehti_kokku.'<br>';
            echo 'Uudiseid lehel: '.$uudiseid_lehel.'<br>';

            //kasutaja valik
            if (isset($_GET['page'])) {
	            $leht = $_GET['page'];
            } else {
	            $leht = 1;
            }
            //millest näitamist alustatakse
            $start = ($leht-1)*$uudiseid_lehel;
            

            if  (isset($_GET["otsi"]) && !empty($_GET["otsi"])) {
                $s = $_GET["otsi"];
                $cat = $_GET["cat"];
                echo "Otsing: ".$s;
                $paring = 'SELECT * FROM sport2025 WHERE '.$cat.' LIKE "%'.$s.'%"';
            } else {
                $paring = "SELECT * FROM sport2025 LIMIT $start, $uudiseid_lehel";
            }

            
            $saada_paring = mysqli_query($yhendus, $paring);
            //võtab kõik read
            while($rida = mysqli_fetch_assoc($saada_paring)){
                //print_r($rida["fullname"]);
                echo "<tr>";
                echo "<td>".$rida['id']."</td>";
                echo "<td>".$rida['fullname']."</td>";
                echo "<td>".$rida['email']."</td>";
                echo "<td>".$rida['age']."</td>";
                echo "<td>".$rida['gender']."</td>";
                echo "<td>".$rida['category']."</td>";
                echo "<td>".$rida['reg_time']."</td>";
                echo "<td><a class='btn btn-success' href='?muuda&id=".$rida['id']."'>Muuda</a></td>";
                echo "<td><a class='btn btn-danger' href='?kustuta&id=".$rida['id']."'>Kustuta</a></td>";
                echo "</tr>";
            }


            //kuvame lingid
            $eelmine = $leht - 1;
            $jargmine = $leht + 1;
            if ($leht>1) {
                echo "<a class='btn btn-primary m-1' href='?page=$eelmine'>Eelmine</a> ";
            }
            if ($lehti_kokku >= 1) {
                for ($i=1; $i<=$lehti_kokku ; $i++) { 
                    if ($i==$leht) {
                        echo "<b><a class='btn btn-primary m-1' href='?page=$i'>$i</a></b> ";
                    } else {
                        echo "<a class='btn btn-primary m-1' href='?page=$i'>$i</a> ";
                    }
                    
                }
            }
            if ($leht<$lehti_kokku) {
            echo "<a class='btn btn-primary m-1' href='?page=$jargmine'>Järgmine</a> ";
            }

            

        ?>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>