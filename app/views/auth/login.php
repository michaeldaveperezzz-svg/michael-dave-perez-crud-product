<?php
$error = $error ?? null;
$identity = $identity ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | Product Desk</title>
    <link rel="stylesheet" href="<?= base_url('css/app.css'); ?>">
</head>
<body>
<div class="auth-shell">
    <aside class="auth-aside">
        <a class="brand" href="<?= site_url('login'); ?>">
            <span class="brand-mark">+</span>
            Product Desk
        </a>

        <div class="auth-copy">
            <p class="eyebrow">Inventory, with intention</p>
            <h1>Make every product count.</h1>
            <p>A focused workspace for keeping your catalogue clear, current, and ready for the next order.</p>
        </div>

        <p class="auth-note">A calmer way to manage the moving parts.</p>
    </aside>

    <main class="auth-main">
        <section class="auth-card" aria-labelledby="login-title">
            <p class="eyebrow">Welcome back</p>
            <h2 id="login-title">Sign in to your desk</h2>
            <p class="intro">Use your account credentials to continue to the product catalogue.</p>

            <?php if ($error): ?>
                <div class="alert" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <form action="<?= site_url('login'); ?>" method="POST">
                <div class="field">
                    <label for="identity">Username or email</label>
                    <input id="identity" type="text" name="identity" value="<?= htmlspecialchars($identity, ENT_QUOTES, 'UTF-8'); ?>" autocomplete="username" required autofocus>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" autocomplete="current-password" required>
                </div>

                <button class="button button-primary" type="submit">Continue to catalogue</button>
            </form>
        </section>
    </main>
</div>
</body>
</html>
