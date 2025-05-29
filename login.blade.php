<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - ShowCar</title>
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
  />
  <style>
    body {
      background-color: #f2f0f1;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    .login-container {
      max-width: 400px;
      margin: 100px auto;
      background: #fff;
      padding: 30px 25px;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .login-title {
      text-align: center;
      font-weight: bold;
      font-size: 26px;
      margin-bottom: 25px;
      color: #222;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
    }

    .form-control {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 14px;
      transition: all 0.2s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: #ff4d4f;
      box-shadow: 0 0 5px rgba(255, 0, 0, 0.2);
    }

    .btn-login {
      width: 100%;
      background-color: #ff1a1a;
      color: white;
      font-weight: bold;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-login:hover {
      background-color: #e60000;
      transform: scale(1.02);
    }

    .register-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #555;
    }

    .register-link a {
      color: #ff1a1a;
      text-decoration: none;
      font-weight: bold;
    }

    .register-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
    <div class="login-container">
    <div class="login-title">Masuk ke ShowCar</div>

    @if (session('register_success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
        {{ session('register_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(() => {
            alert("{{ session('register_success') }}");
        }, 500);
    </script>
@endif

    
    <form action="{{ route('login') }}" method="POST">
    @csrf
      @error('username')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="form-group">
        <label for="username">Username</label>
        <input
          type="text"
          class="form-control"
          id="username"
          name="username"
          placeholder="Masukkan username"
          value="{{ old('username') }}"
          required
        />
      </div>
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input
          type="password"
          class="form-control"
          id="password"
          name="password"
          placeholder="Masukkan kata sandi"
          required
        />
      </div>
      <button type="submit" class="btn-login">Masuk</button>
    </form>
  </div>
  <!-- Optional JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  @if (session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2500
    });
</script>
@endif

</body>
</html>
