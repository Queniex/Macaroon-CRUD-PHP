<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

include('functions.php');
$namaBar = [];
$jumlahBar = [];
$item = query("SELECT DISTINCT nama_barang FROM barang ORDER BY id_barang ASC");
for ($i = 0; $i < count($item); $i++) {
    array_push($namaBar, $item[$i]["nama_barang"]);
    $query = mysqli_query($conn,"SELECT SUM(jumlah) AS jumlah FROM rusialdi WHERE id_barang = '".($i+1)."'");
    $row = $query->fetch_array();
    array_push($jumlahBar, $row[0]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Macaroon Mart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        *{
            /* border: red solid 1px; */
            margin: 0px;
            padding: 0px;
        }

        .header{
            background-color: #ffc4ff;
            padding-bottom: 5px;
        }

        span.a{
            /* text-decoration: underline; */
            color: rgb(255, 0, 149);
            font-weight: 900;
            font-size: larger;
        }

        span.b{
            color: rgba(16, 56, 6, 0.774);
            font-weight: 900;
            font-size: larger;
        }

        .container{
            display: flex;
            justify-content: center;
            /* background-color: aquamarine; */
        }

        .footer{
            margin-top: 0.9rem;
            padding: 0.5rem;
            background-color: #ffc4ff;
        }

        .chart{
            margin-top:7rem;
        }

    </style>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    
   <div>

         <div class="header">
            <center><h1><span class="a">Macaroon</span><span class="b">mart</span> || 
                <span>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="index.php" class="btn btn-outline-dark" >kembali</a>
                    </div>
                </span>
                <span>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="read.php" class="btn btn-outline-primary" >Chart</a>
                    </div>
                </span> ||
                <span>
                    <a href="logout.php" class="btn btn-danger">Log Out</a>
                </span>
            </h1>
            </center>
        </div>

        <div class="chart container text-center">
            <div class="row">
                <div class="col">
                    <div style="width: 400px;height: 400px">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

                <div class="col">
                    <div style="width: 400px;height: 400px">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <center><p style="margin-top: 10px;">&copy; Fildzah Marissa Rusialdi (2022)</p></center>
        </div>

        <script>
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
            type: 'line',
            data: {
                    labels: <?php echo json_encode($namaBar); ?>,
                    datasets: [{
                    label: 'Grafik Penjualan (line)',
                    data: <?php echo json_encode($jumlahBar); ?>,
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    borderColor: 'rgb(153, 102, 255)',
                    borderWidth: 1
                        }]
                    },
                    options: {
                    scales: {
                    y: {
                        beginAtZero: true
                        }
                        }
                    }
                });

            const cty = document.getElementById('myChart2');
            new Chart(cty, {
            type: 'bar',
            data: {
                    labels: <?php echo json_encode($namaBar); ?>,
                    datasets: [{
                    label: 'Grafik Penjualan (bar)',
                    data: <?php echo json_encode($jumlahBar); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(153, 102, 255)',
                    borderWidth: 1
                        }]
                    },
                    options: {
                    scales: {
                    y: {
                        beginAtZero: true
                        }
                        }
                    }
                });
        </script>        

<!-- JQuery -->
<script
src="https://code.jquery.com/jquery-3.6.1.min.js"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
crossorigin="anonymous"></script>
<!-- Server -->
<script src="/fetch/script.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>