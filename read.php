<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$item = query("SELECT id_nama, nama, alamat, hp, jenis_barang, barang.id_barang, nama_barang, harga, jumlah, harga*jumlah as total FROM rusialdi INNER JOIN barang on rusialdi.id_barang=barang.id_barang");

// pagination
// configuration
$totalDataPage = 3;
$totalData = count(query("SELECT id_nama, nama, alamat, hp, jenis_barang, barang.id_barang, nama_barang, harga, jumlah, harga*jumlah as total FROM rusialdi INNER JOIN barang on rusialdi.id_barang=barang.id_barang"));
$totalPage = ceil($totalData / $totalDataPage);
$activePage = ( isset($_GET["page"]) ) ? $_GET["page"] : 1;
$data = ($totalDataPage * $activePage ) - $totalDataPage;

$item = query("SELECT id_nama, nama, alamat, hp, jenis_barang, barang.id_barang, nama_barang, harga, jumlah, harga*jumlah as total FROM rusialdi INNER JOIN barang on rusialdi.id_barang=barang.id_barang LIMIT $data, $totalDataPage");
$barang = mysqli_query($conn, "SELECT * FROM barang");

// Button Pencarian
if ( isset($_POST["find"]) ){
    $item = find($_POST["keyword"]);
  //   echo "
  //             <script>
              
  //                 alert('Data berhasil dicari!')
  //             </script>
  //        "; 
  }

?>

<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MacaroonMart | Login</title>

    <!-- Link daisyui -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.24.2/dist/full.css" rel="stylesheet" type="text/css" />

    <!-- Link tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />

    <script>
        tailwind.config = {
          theme: {
            container: {
              center: true,
              padding: '16px'
            },
            extend: {
              colors: {
                primary: '#14b8a6',
              },
              screens: {
                '2xl': '1320px',
              }
            }
          }
        }
      </script>

      <style type="text/tailwindcss">
        /* import font */
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue&family=Dosis:wght@500&family=Luckiest+Guy&family=Poppins:ital,wght@0,300;0,500;0,600;0,800;0,900;1,600&display=swap');

        @layer utilities {
         .hamburger-active > span:nth-child(1){
           @apply rotate-45;
         }

         @layer base {
          *{
            font-family: 'Poppins', sans-serif;
            color: black;
          }
         }

        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg .tg-cmwg{background-color:white;text-align:center;vertical-align:top}
        .tg .tg-wp8o{border-color:#000000;text-align:center;vertical-align:top}
        .tg .tg-qytt{background-color:white;border-color:#000000;text-align:center;vertical-align:middle}
        .tg .tg-r31r{background-color:white;border-color:#000000;text-align:center;vertical-align:top}
        .tg .tg-0lax{text-align:left;vertical-align:top}

        /* *{
          border: 1px solid blue
         } */

        }
      </style>

</head>
<body>
    
<div class="bg-[#FFFBEB]">
        <div class="header h-[20vh]">
            <div class="md:flex justify-center">
                <div class="w-[70%] bg-white h-[12vh] border-black border-2 rounded-[80px] mt-4 mb-4 flex">
                    <div class="w-[70%] h-[12vh] rounded-l-[80px] flex">
                        <div class="ml-20 w-[20%] h-[12vh]"> 
                            <img style="height: 100%; width: 100%; object-fit: contain" src="images/macaroon.png" alt="">
                        </div>
                        <span style="-webkit-text-stroke-width: 1px;-webkit-text-stroke-color: black;" class="h-8 mt-2 text-[40px] font-bold text-[#F3E850]"><span class="text-[#FF0095]">Macaroon</span>mart</span>
                    </div>
                    <div class="w-[30%] h-[12vh] rounded-r-[80px] flex justify-center">
                        <div class="ml-16 mt-4 px-2">
                            <div class="flex items-stretch">

                              <div class="dropdown dropdown-end">
                                <label tabindex="0" class="btn bg-[#FFE898] text-black hover:text-white rounded-btn">Menu</label>
                                <ul tabindex="0" class="menu dropdown-content p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                                  <li><a href="index.php">Dashboard</a></li> 
                                  <li><a href="read.php">Data</a></li>
                                </ul>
                              </div>

                              <a href="logout.php" class="ml-2 btn bg-[black] text-white hover:text-[pink] rounded-btn">Log Out</a>

                            </div>
                          </div>
                    </div>
                </div>
            </div>
            <!-- <center><h1><span class="a">Macaroon</span><span class="b">mart </span>|| 
                <span>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="read.php" class="btn btn-outline-dark" >kembali</a>
                    </div>
                </span>
            </h1>
            </center> -->
        </div>

        <div class="isi h-[67vh]">
            <div class="h-[10vh]">
                <div class="mt-5 container2 flex justify-center">
                    <div class="searchDiv">
                      <form action="" method="POST">
                          <input type="text" name="keyword" class=" bg-[pink] p-1 border-black border-2" size="40" autofocus placeholder=" Enter keyword.." required autocomplete="off">
                          <button class="find  p-1 bg-white border-[pink] hover:bg-[pink] hover:text-white border-2" type="submit" name="find">Find!</button>
                      </form>
                    </div>
                  </div>
            </div>

            <div class="h-[45vh]">
                <div class="isi mt-1 flex justify-center">
                    <div class="text-center">
                    <table class="tg">
                        <thead>
                            <tr>
                                <th class="tg-qytt">ID</th>
                                <th class="tg-r31r">Nama</th>
                                <th class="tg-qytt">No HP</th>
                                <th class="tg-qytt">Nama Barang</th>
                                <th class="tg-r31r">Harga</th>
                                <th class="tg-r31r">Total Bayar</th>
                                <th class="tg-cmwg" colspan="3">Kontrol</th>
                            </tr>
                        </thead>
                        <tbody>
        
                        <!-- Mulai Perulangan -->
                        <?php foreach( $item as $itm ) : ?>
                            <tr>
                                <td class="tg-wp8o"><span style="background-color:pink"><?= $itm["id_nama"]; ?></span></td>
                                <td class="tg-wp8o"><?= $itm["nama"]; ?></td>
                                <td class="tg-wp8o"><?= $itm["hp"]; ?></td>
                                <td class="tg-wp8o"><?= $itm["nama_barang"]; ?></td>
                                <td class="tg-wp8o"><?= $itm["harga"]; ?></td>
                                <td class="tg-wp8o"><?= $itm["total"]; ?></td>
                                <form action="GET"></form>
                                    <td class="tg-0lax"><a href="seek.php?id=<?= $itm["id_nama"]; ?>" class="btn bg-white hover:bg-[pink]" name="baca"><img width="20px" height="20px" src="images/eye.png" alt=""></a></td>
                                    <td class="tg-0lax"><a href="edit.php?id=<?= $itm["id_nama"]; ?>" class="btn bg-white hover:bg-[pink]" name="baca"><img width="20px" height="20px" src="images/pen.png" alt=""></a></td>
                                    <td class="tg-0lax"><button href="delete.php?id=<?= $itm["id_nama"]; ?>" class="btn bg-white hover:bg-[pink]" name="baca" type="button" data-modal-toggle="popup-modal"><img width="20px" height="20px" src="images/delete.png" alt=""></button></td>
                                </form>
                            </tr>
                        <?php endforeach; ?>    
                        <!--Akhir perulangan  -->
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="h-[15vh]">
                <!-- Navigation -->
                <div class="btn-group flex justify-center">
                    <?php if( $activePage > 1 ) : ?>
                        <a class="btn bg-[pink] text-black hover:text-white" href="?page=<?= $activePage - 1; ?>">«</a>
                    <?php endif; ?> 
                    
                    <?php for( $i = 1; $i <= $totalPage; $i++ ) : ?>
                        <?php if( $i == $activePage ) : ?>
                            <a class="btn bg-[pink] text-black hover:text-white" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        <?php else : ?>
                            <a class="btn bg-[pink] text-black hover:text-white" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if( $activePage < $totalPage ) : ?>
                        <a class="btn bg-[pink] text-black hover:text-white" href="?page=<?= $activePage + 1; ?>">»</a>
                    <?php endif; ?>
                </div>         
            <!-- End Navigation -->
            </div>
        </div>

        <div class="footer h-[10vh] bg-[#F65A83] flex justify-center">
            <center><p style="margin-top: 3vh;" class="text-white">&copy; Fildzah Marissa Rusialdi (2022)</p></center>
        </div>
   </div>

    <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-[pink] hover:bg-[#DDA5AE] hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:text-white" data-modal-toggle="popup-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 bg-white rounded-lg text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Anda yakin akan menghapus data ini?</h3>
                    <a href="delete.php?id=<?= $itm["id_nama"]; ?>" data-modal-toggle="popup-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Ya
                    </a>
                    <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Tidak
                    </button>
                </div>
            </div>
        </div>
    </div>
                
   

<!-- JQuery -->
<script
src="https://code.jquery.com/jquery-3.6.1.min.js"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
crossorigin="anonymous"></script>
<!-- Server -->
<script src="/fetch/script.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>
</html>