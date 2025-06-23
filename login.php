<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    // For demo, accept any non-empty username with password = "password"
    if ($username === '') {
        $errors[] = 'Username is required.';
    }
    if ($password === '') {
        $errors[] = 'Password is required.';
    }
    if (empty($errors)) {
        if ($password === 'password') {
            // Set session & redirect
            $_SESSION['user'] = ['username' => htmlspecialchars($username)];
            header('Location: dashboard.php');
            exit();
        } else {
            $errors[] = 'Invalid credentials. Password is "password".';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login - Staff Portal</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<style>
  body {
    margin:0; min-height: 100vh; display:flex; justify-content:center; align-items:center;
    font-family: 'Inter', sans-serif, Arial, sans-serif;
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
  }
  .login-container {
    background: rgba(255 255 255 / 0.1);
    padding: 32px 40px;
    border-radius: 24px;
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
    backdrop-filter: blur(12px);
    width: 320px;
  }
  h1 {
    margin-bottom: 24px;
    text-align: center;
    font-weight: 700;
    font-size: 1.75rem;
  }
  label {
    display: block;
    font-weight: 600;
    margin-bottom: 4px;
  }
  input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 20px;
    border-radius: 12px;
    border: none;
    font-size: 1rem;
    outline: none;
  }
  button {
    width: 100%;
    padding: 14px 0;
    background: #a5b4fc;
    border: none;
    border-radius: 16px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    color: #3730a3;
    transition: background-color 0.3s ease;
  }
  button:hover, button:focus-visible {
    background: #6366f1;
    color: white;
    outline: none;
  }
  .error-list {
    background: #fee2e2;
    color: #b91c1c;
    border-radius: 12px;
    padding: 12px 16px;
    margin-bottom: 20px;
    font-weight: 600;
  }
</style>
</head>
<body>
  <main class="login-container" role="main" aria-label="Login form">
    <h1><span class="material-icons" aria-hidden="true">lock</span> Staff Login</h1>
    <?php if (!empty($errors)): ?>
      <div class="error-list" role="alert" aria-live="assertive">
        <ul style="margin:0; padding-left: 20px;">
          <?php foreach($errors as $error): ?>
            <li><?=htmlspecialchars($error)?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form method="post" novalidate>
      <label for="username">Username</label>
      <input id="username" name="username" type="text" required autocomplete="username" aria-required="true" autofocus />
      <label for="password">Password</label>
      <input id="password" name="password" type="password" required autocomplete="current-password" aria-required="true" />
      <button type="submit" aria-label="Log in to staff portal">Login</button>
    </form>
  </main>
</body>
</html>

