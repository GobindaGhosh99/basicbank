<!doctype html>
<html lang="en">
    <?php
        if (isset($_GET['f']) && isset($_GET['t'])) {
            $from = $_GET['f'];
            $to = $_GET['t'];
            include 'dbopen.php';
        }
    ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Basic Bank | Money Transfer</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .nav-active{
            font-weight: bold;
        }
        .mid-container{
            width: 100%;
            min-height: 781px;
            height: fit-content;
            background-color: rgb(218, 198, 90);
            display: flex;
            flex-direction: column;
            align-items: center;
            /* justify-content: center; */
        }
        .ft{
            display: flex;
            justify-content: space-around;
        }
        .form-details{
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        }
        .left-d{
            color: rgb(10, 10, 87);
        }
        .right-d{
            color: rgb(150, 27, 27);
        }
        .mt-form{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .ip{
            display: flex;
            justify-content: center;
            justify-content: center;
        }
        .ip label{
            font-size: 25px;
        }
        
        footer{
            width: 100%;
            height: 25px;
        }
    </style>
  </head>
  <body>
      <header class="bg-light" style="height: 58px;">
          <h1 class="text-danger text-center">Secured Money Transfer</h1>
      </header>

      <section class="mid-container p-5">
            <?php
                echo '
                <a href="mt.php?id='.$from.'" class="btn btn-primary mb-4">Go Back</a>
                ';
            ?>
            <div class="ft">
                <div class="form-details fw-bold p-5 m-3">
                    <div class="left text-end">
                        <p class="left-d text-capitalize m-0">from :</p>
                    </div>
                    <div class="right text-start">
                        <?php
                            $sql = "SELECT * FROM `customers` WHERE `slno` = '$from'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo '
                            <p class="right-d text-capitalize m-0 ps-2">'.$row['acc_no'].' ('.$row['name'].')</p>
                            ';
                        ?>
                    </div>
                </div>
                <div class="form-details fw-bold p-5 m-3">
                    <div class="left text-end">
                        <p class="left-d text-capitalize m-0">to :</p>
                    </div>
                    <div class="right text-start">
                        <?php
                            $sql = "SELECT * FROM `customers` WHERE `slno` = '$to'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo '
                            <p class="right-d text-capitalize m-0 ps-2">'.$row['acc_no'].' ('.$row['name'].')</p>
                            ';
                        ?>
                    </div>
                </div>
            </div>
            <form action="/basicbank/mt.php" method="post" class="mt-form mt-3">
                <?php
                    echo '
                    <input type="hidden" value="'.$from.'" id="from" name="from" required>
                    <input type="hidden" value="'.$to.'" id="to" name="to" required>
                    ';
                ?>
                <div class="ip mb-4">
                    <label for="amount" class="m-0 py-0 px-2 text-capitalize fw-bold">enter amount :</label>
                    <input type="number" class="m-0 p-2" id="amount" name="amount" required placeholder="Enter Amount">
                </div>
                <button type="submit" class="btn btn-success px-3 mx-4 text-capitalize">transfer</button>
            </form>
      </section>

      <footer class="bg-primary text-center text-light fw-bold">Developed By Sourav Garai.</footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>