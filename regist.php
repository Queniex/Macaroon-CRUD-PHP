<?php
    require 'functions.php';

    // checking that user has pressed the register button;
    if( isset($_POST["register"]) ) {
       if( regist($_POST) > 0 ) {
        echo "
        <script>
            alert('user successfully added !')
            document.location.href = 'login.php'
        </script>
        "; 
       } else {
        echo mysqli_error($conn);
       }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MacaroonMart | Regist</title>

    <!-- Link daisyui -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.24.2/dist/full.css" rel="stylesheet" type="text/css" />

    <!-- Link tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

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
/* 
        *{
          border: 1px solid blue
         } */

        }
      </style>

</head>
    <body class="items-center w-full h-[100vh] relative bg-[black]">


    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </symbol>
    </svg>

        <!-- Warning -->
        <!-- <?php if( isset($error) ) : ?> -->
          <div class="absolute m-5 top-5">
            <div class="alert alert-error shadow-lg p-0 lg:p-2 lg:w-full flex justify-center items-center">
              <div class="m-0 p-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 ml-1 lg:h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Password / Username is incorrect.</span>
              </div>
            </div>
          </div>
        <!-- <?php endif; ?> -->

    <div class="container h-[100vh] flex items-center justify-center">
        <div class="mt-5 h-[60%] w-[60%] flex flex-row rounded-3xl bg-[#FFACC7]">
            <div class="basis-2/5 rounded-l-3xl">
                <div class=" ml-8 mt-3 h-[60%] w-[80%]">
                    <h3 class="text-white mt-10 ml-3 text-3xl">REGISTER NEW</h3>
                    <h3 class="text-white ml-3 text-3xl">ACCOUNT</h3>
                    <div class="w-[84%] h-[3px] mt-1 bg-white ml-3"></div>
                    <img style='height: 100%; width: 100%; object-fit: contain' src="images/gambar/word.png" alt="">
                </div>
            </div>
            <div class="basis-3/5 rounded-r-3xl">
                <div class="ml-6 mt-[54px] h-[10%] w-[90%]">
                    <div class="w-[70%] h-[100%] bg-white inline-block"></div>
                    <div class="w-[20%] h-[100%] ml-9 bg-white inline-block"></div>
                </div>
                <div class="ml-6 mt-3 h-[68%] w-[90%] bg-white">
                    <div class="h-[90%] w-[95%]">
                        <center>
                            <h1 class="mb-2 text-white">.</h1>
                            <form method="POST">

                                <div class="h-[20%]">
                                    <input type="text" name="username" class="focus:ring focus:ring-violet-500 border-solid bg-[#FFACC7] text-white border-2 border-black w-[60%] h-8 mt-3" placeholder=" Username" required>
                                </div>
                                <div class="h-[20%]">
                                    <input type="password" name="password" class="focus:ring focus:ring-violet-500 border-solid bg-[#FFACC7] text-white border-2 border-black w-[60%] h-8 mt-3"  placeholder=" Password" required>
                                </div>
                                <div class="h-[20%]">
                                    <input type="password" name="password2" class="focus:ring focus:ring-violet-500 border-solid bg-[#FFACC7] text-white border-2 border-black w-[60%] h-8 mt-3 mb-5"  placeholder=" Confirm Password" required>
                                </div>
                                
                            
                                <div class="h-[15%]">
                                    <button class="border-solid border-2 border-black h-10 mt-3 w-[40%] rounded-3xl bg-[#FF535C] hover:bg-[#A13339] text-black hover:text-white" type="submit" name="register">Register</button>
                                </div>
                            </form>
                        </center>
                </div>
                </div>
            </div>`
        </div>
    </div>
</body>
</html>