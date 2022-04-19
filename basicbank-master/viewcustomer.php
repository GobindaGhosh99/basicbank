<!doctype html>
<html lang="en">

<?php
    include 'dbopen.php';
    $sql = "SELECT * FROM `customers`";
    $result = mysqli_query($conn, $sql);
?>

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Basic Bank | All Customers</title>
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
            width: 330px;
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
                    <a class="nav-link text-dark nav-active" href="viewcustomer.php">All Customers</a>
                    </li>
                    <li class="nav-item mx-2">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">View Customer</a>
                    </li>
                    <li class="nav-item mx-2">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Money Transfer</a>
                    </li>
                    <li class="nav-item mx-2">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Transaction History</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

      <section class="mid-container p-5">
          <h1 class="fw-bold text-danger mb-4">All Customers List</h1>
          <table class="customer-list">
              <thead class="customer-head">
                <tr>
                    <th class="slno text-capitalize text-center border-end p-3 m-0">Sl. No.</th>
                    <th class="name text-capitalize text-center border-end p-3 m-0">customer name</th>
                    <th class="select text-capitalize text-center px-3 m-0">select</th>
                </tr>
              </thead>
              <tbody class="customer-body">
                <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <tr class="border-top">
                            <td class="slno text-capitalize text-center fw-bold border-end px-3 py-2 m-0">'.$i.'</td>
                            <td class="name text-capitalize text-center fw-bold border-end px-3 py-2 m-0">'.$row['name'].'</td>
                            <td class="select text-capitalize text-center px-3 m-0">
                                <a href="customer.php?id='.$row['slno'].'" class="btn btn-success selects my-1">Select</a>
                            </td>
                        </tr>
                        ';
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