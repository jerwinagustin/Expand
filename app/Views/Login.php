<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Expand Expense Tracker</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #0e0c24;
            min-height: 100vh;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            color: #555;
            margin-bottom: 10px;
            text-align: center;
            font-weight: 600;
        }

        .signup-text {
            font-size: 0.9em;
            color: #888;
            margin-bottom: 25px;
            text-align: center;
        }

        .signup-text a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-text a:hover {
            text-decoration: underline;
        }

        .form-label {
            color: #444;
            font-size: 0.85em;
            font-weight: 500;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .form-control {
            background-color: #f2f2f2;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1em;
        }

        .form-control:focus {
            background-color: #f2f2f2;
            border: 1px solid #a29bfe;
            box-shadow: none;
        }

        .btn-login {
            width: 100%;
            background-color: #c400ff;
            color: #fff;
            border: none;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #a200cc;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <form class="login-box" action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>

            <h2>Login</h2>
            <p class="signup-text">Don't have an Account? <a href="<?= base_url('signup') ?>">SignUp</a></p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="email" class="form-label">EMAIL</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="user@gmail.com" value="<?= old('email') ?>" required>
                <?php if (session()->getFlashdata('errors')['email'] ?? false): ?>
                    <div class="text-danger small mt-1"><?= session()->getFlashdata('errors')['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">PASSWORD</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••" required>
                <?php if (session()->getFlashdata('errors')['password'] ?? false): ?>
                    <div class="text-danger small mt-1"><?= session()->getFlashdata('errors')['password'] ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-login">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>