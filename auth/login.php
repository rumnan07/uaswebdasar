<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/parsley.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card card-body mt-4">
                    <h3>Login</h3>
                    <hr>

                    <?php
                    require('../koneksi.php');
                    if (isset($_POST["btnLogin"])) {
                        $inputemail = htmlspecialchars($_POST["txtemail"]);
                        $inputpassword = sha1(htmlspecialchars($_POST["txtpassword"]));

                        echo $inputpassword;

                        $query = "SELECT * FROM pengguna WHERE email='$inputemail' AND password='$inputpassword'";

                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) == 1){

                            $dataUser = mysqli_fetch_object($result);

                            $_SESSION['login'] = true;
                            $_SESSION['nama_lengkap'] = $dataUser->nama_lengkap;
                            $_SESSION['role'] = $dataUser->role;

                            header('location: ../pengguna/tampil.php');
                        
                        } else {
                        
                            echo    '<div class="alert alert-danger">Gagal Login, Silahkan periksa 
                                    email / password anda.</div>';
                        
                        }

                    }
                    ?>

                    <form action="" method="post" data-parsley-validate="">

                        <input type="email" class="form-control" required name="txtemail" placeholder="Masukkan email">
                        <br>

                        <input type="password" class="form-control" required name="txtpassword"
                            placeholder="Masukkan password">

                        <br>
                        <input type="submit" class="btn btn-info" value="Login" name="btnLogin">

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>