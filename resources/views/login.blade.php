<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Panel</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <h2>Login Panel</h2>
        <p class="subtitle">Masuk ke dashboard anda</p>

        <form action="{{ route('login.sys') }}" method="POST">
            @csrf
            <div class="input-group">
                <label>Email</label>
                <input name="email" type="email" placeholder="Masukkan email" autocomplete="off">
            </div>

            <div class="input-group">
                <label>Password</label>
                <input name="password" type="password" placeholder="Masukkan password" autocomplete="new-password">
            </div>

            <button class="login-btn">Login</button>

        </form>

    </div>

</div>

<style>
    *{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Segoe UI, Arial, sans-serif;
}

body{
    height:100vh;
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* container */

.login-container{
    width:100%;
    max-width:400px;
}

/* card */

.login-card{
    background:white;
    padding:40px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* title */

.login-card h2{
    font-size:26px;
    margin-bottom:5px;
    color:#2c3e50;
}

.subtitle{
    color:#7f8c8d;
    margin-bottom:25px;
}

/* input */

.input-group{
    margin-bottom:18px;
}

.input-group label{
    display:block;
    font-size:14px;
    margin-bottom:6px;
    color:#34495e;
}

.input-group input{
    width:100%;
    padding:11px;
    border:1px solid #dcdcdc;
    border-radius:6px;
    font-size:14px;
}

.input-group input:focus{
    outline:none;
    border-color:#3498db;
}

/* button */

.login-btn{
    width:100%;
    padding:12px;
    background:#2c3e50;
    color:white;
    border:none;
    border-radius:6px;
    font-size:15px;
    cursor:pointer;
    margin-top:10px;
}

.login-btn:hover{
    background:#1a252f;
}
</style>

</body>
</html>