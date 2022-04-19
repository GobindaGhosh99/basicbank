<!doctype html>
<html lang="en">

    <?php
        if (isset($_GET['id'])) {
            $cust_id = $_GET['id'];
            include 'dbopen.php';
            $sql = "SELECT * FROM `customers` WHERE `slno` = '$cust_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $sql = "SELECT * FROM `transaction` WHERE `sender_id` = '$cust_id' 
            or `recever_id` = '$cust_id' ORDER BY `slno` DESC";
            $result = mysqli_query($conn, $sql);
        }
    ?>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Basic Bank | Transaction History</title>
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

        .customer-head tr{
            background-color: blueviolet;
            color: white;
        }
        .customer-body tr:nth-child(odd){
            background-color: rgb(240, 89, 253);
        }
        .customer-body tr:nth-child(even){
            background-color: rgb(207, 17, 224);
        }
        .name{
            width: 300px;
        }

        footer{
            width: 100%;
            height: 25px;
        }
    </style>
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 58px;">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-danger mx-4" href="#">Basic Bank</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 bg-light">
                    <li class="nav-item mx-2">
                    <a class="nav-link text-dark" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                    <a class="nav-link text-dark" href="viewcustomer.php">All Customers</a>
                    </li>
                    <?php
                        echo '
                        <li class="nav-item mx-2">
                        <a class="nav-link text-dark" href="customer.php?id='.$cust_id.'" tabindex="-1" aria-disabled="true">View Customer</a>
                        </li>
                        <li class="nav-item mx-2">
                        <a class="nav-link text-dark" href="mt.php?id='.$cust_id.'" tabindex="-1" aria-disabled="true">Money Transfer</a>
                        </li>
                        <li class="nav-item mx-2">
                        <a class="nav-link text-dark nav-active" href="th.php?id='.$cust_id.'" tabindex="-1" aria-disabled="true">Transaction History</a>
                        </li>
                        ';
                    ?>
                </ul>
                </div>
            </div>
        </nav>

        <section class="mid-container p-5">
            <h1 class="m-0 pt-3 text-center text-capitalize text-danger">account details</h1>
            <div class="form-details fw-bold p-5 m-3 bg-light rounded">
                <div class="left text-end">
                    <p class="left-d text-capitalize m-0">customer name :</p>
                    <p class="left-d text-capitalize m-0">email id :</p>
                    <p class="left-d text-capitalize m-0">account no. :</p>
                    <p class="left-d text-capitalize m-0">current balance :</p>
                </div>
                <div class="right text-start">
                    <?php
                        echo '
                        <p class="right-d text-capitalize m-0 ps-2">'.$row['name'].'</p>
                        <p class="right-d m-0 ps-2">'.$row['email'].'</p>
                        <p class="right-d text-capitalize m-0 ps-2">'.$row['acc_no'].'</p>
                        <p class="right-d text-capitalize m-0 ps-2">'.$row['current_bal'].'</p>
                        ';
                    ?>
                </div>
            </div>
            <h1 class="m-0 pt-3 text-center text-capitalize text-danger">transaction history</h1>
            <table class="customer-list my-3">
              <thead class="customer-head">
                <tr>
                    <th class="slno text-capitalize text-center border-end p-3 m-0">sl. no.</th>
                    <th class="trn-type text-capitalize text-center border-end p-3 m-0">transaction type</th>
                    <th class="ft text-capitalize text-center border-end px-3 m-0">from / to account no.</th>
                    <th class="amount text-capitalize text-center px-3 m-0">amount</th>
                </tr>
              </thead>
              <tbody class="customer-body">
                <?php
                $i = 1;
                    while ($ro = mysqli_fetch_assoc($result)) {
                        if ($ro['sender_id'] == $cust_id) {
                            $sql = "SELECT `acc_no` FROM `customers` WHERE `slno` = ".$ro['recever_id'];
                            $temp = mysqli_query($conn, $sql);
                            $temp_row = mysqli_fetch_assoc($temp);
                            echo '
                            <tr class="border-top">
                            <td class="text-capitalize text-center fw-bold border-end px-3 py-2 m-0">'.$i.'</td>
                            <td class="text-capitalize text-center fw-bold border-end px-3 py-2 m-0">transfered</td>
                            <td class="text-capitalize text-center fw-bold border-end px-3 m-0">to '.$temp_row['acc_no'].'</td>
                            <td class="text-capitalize text-center fw-bold px-3 m-0">'.$ro['amount'].'</td>
                            </tr>
                            ';
                        } else {
                            $sql = "SELECT `acc_no` FROM `customers` WHERE `slno` = ".$ro['sender_id'];
                            $temp = mysqli_query($conn, $sql);
                            $temp_row = mysqli_fetch_assoc($temp);
                            echo '
                            <tr class="border-top">
                                <td class="text-capitalize text-center fw-bold border-end px-3 py-2 m-0">'.$i.'</td>
                                <td class="text-capitalize text-center fw-bold border-end px-3 py-2 m-0">credited</td>
                                <td class="text-capitalize text-center fw-bold border-end px-3 m-0">from '.$temp_row['acc_no'].'</td>
                                <td class="text-capitalize text-center fw-bold px-3 m-0">'.$ro['amount'].'</td>
                            </tr>
                            ';
                        }
                        
                        $i++;
                    }
                ?>
              </tbody>
          </table>
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