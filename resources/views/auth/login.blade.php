<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/auth/loginAdmin.css">
        <link rel="icon" type="image/png" href="img/landing/logoBali2.png">

</head>
<body>
    {{-- <section class="background-login">
                    
        
    </section> --}}
    {{-- <div class="container mt-5" style="display: flex; justify-content:center; "> --}}
    <div class="background-login">
        <div class="row align-items-center">
            <div class="col">
                <div class="form-box " 
                {{-- style="margin-top: 10%;margin-left:15%;margin-right:15%" --}}
                data-aos="fade-up">
                    <div class="form-value">
                        @if(session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
            <form action="" method="post">
                            @csrf
                            <h2>Login</h2>
                            <div class="inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input type="email" name="email" required="" >
                                <label for="">Email</label>
                            </div>
                            <div class="inputbox">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                                <input type="password" name="password" required="">
                                <label for="">Password</label>
                            </div>
                            <div class="forget">
                                <label for=""><input type="checkbox">Ingat Saya | <a href="#">Lupa Password</a></label>
                            
                            </div>
                            <button type="submit" >Masuk</button>
                            {{-- <div class="register">
                                <p>Belum Mempunyai Akun? <a href="/registrasi">Daftar</a></p>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="img/landing/logoBali2.png" alt="" style="width: 100%">
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>