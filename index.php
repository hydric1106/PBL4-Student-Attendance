<?php
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Student | Đăng nhập</title>
    <link href="../image/logoFaceWeb.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/withmvc/css/slyte.css">
</head>
<body><div class="container-fluid">
    <h1 class="text-center" slyte="color: red;">Trung tâm Nihongo</h1>
    <h5 class="text-center">
        <img class="img-edit" src="../image/logostudent.png" alt="">
    </h5>
    <form>
        <div class="div-form mb-3">
          <input type="text" class="form-control" id="usernameLogin" aria-describedby="usernameHelp" placeholder="Tên đăng nhập">
          <!-- <div id="usernameHelp" class="form-text">We'll never share isername with anyone else.</div> -->
        </div>
        <div class="div-form mb-3">
          <input type="password" class="form-control" id="passwordLogin" placeholder="Mật khẩu">
        </div>
        <div class="div-form mb-3 d-flex align-items-center">
          <input type="checkbox" class="cb-login form-check-input" id="submitLogin">
          <label class="lb form-check-label" for="submitLogin">Remember Me</label>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </div>
    </form>
</div>
    
</body>
</html>