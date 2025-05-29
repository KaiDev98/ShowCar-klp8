<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar SOCA</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        background-color: #f2f0f1;
        font-family: Arial, sans-serif;
      }

      .container {
        max-width: 400px;
        margin: 80px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
      }

      .logo {
        font-size: 24px;
        font-weight: bold;
        color: black;
      }
      .logo span {
        color: red;
      }

      .form-title {
        font-size: 20px;
        margin-top: 20px;
        font-weight: bold;
      }

      .subtext {
        margin: 10px 0;
      }

      .subtext a {
        color: red;
        text-decoration: none;
        font-weight: bold;
      }

      input[type="text"] {
        width: 100%;
        padding: 12px;
        margin-top: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
      }

      .note {
        margin: 10px 0 5px;
        font-size: 12px;
        color: #555;
      }

      .checkbox {
        text-align: left;
        font-size: 11px;
        margin-top: 10px;
        color: #555;
      }

      .checkbox input {
        vertical-align: middle;
      }

      .checkbox a {
        color: red;
        text-decoration: none;
      }

      button {
        margin-top: 20px;
        background-color: red;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        width: 100%;
        cursor: pointer;
      }

      .form-group {
  text-align: left;
  margin-top: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 6px;
  font-size: 14px;
  font-weight: bold;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
}

    </style>
  </head>
  <body>
    <div class="container">
      <div class="logo">
        So<span>Car</span> <span style="font-size: 20px">🚗</span>
      </div>
      <div class="form-title">Daftar Sekarang</div>
      <div class="subtext">
        Sudah punya Akun SOCA? <a href="{{ url('/login') }}">Masuk</a>
      </div>
      <form action="{{ url('/register') }}" method="POST">
    @csrf
  <div class="form-group">
    <label for="username">Username</label>
    <input
      type="text"
      id="username"
      name="username"
      placeholder="Masukkan username"
    />
  </div>

  <div class="form-group">
    <label for="password">Kata Sandi</label>
    <input
      type="password"
      id="password"
      name="password"
      placeholder="Masukkan kata sandi"
    />
  </div>

  <div class="form-group">
    <label for="confirm_password">Konfirmasi Kata Sandi</label>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" />
  </div>

  <div class="form-group">
    <label for="phone">Masukkan No. Ponsel</label>
    <input
      type="text"
      id="phone"
      name="phone"
      placeholder="62286426346123"
    />
    <div class="note">Pastikan Nomor ponsel yang anda Masukkan aktif</div>
  </div>

  <div class="checkbox">
    <input type="checkbox" id="agree" checked />
    <label for="agree">
      Dengan mendaftar, saya menyetujui
      <a href="#">Kebijakan Privasi</a>
    </label>
  </div>

  <button type="submit">Daftar</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    confirmButtonColor: '#d33'
  });
</script>
@endif
  </body>
</html>
