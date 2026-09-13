<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="<?= base_url('css/app.css'); ?>">
</head>

<body class="shell form-screen">
<header class="topbar">
    <a class="brand" href="<?= site_url('products'); ?>">
        <span class="brand-mark">+</span>
        Product Desk
    </a>
    <div class="nav-user">
        <strong><?= htmlspecialchars($_SESSION['user']['username'] ?? 'Account', ENT_QUOTES, 'UTF-8'); ?></strong>
        <button class="nav-link" type="button" data-modal-open="logout-modal">Sign out</button>
    </div>
</header>

<main class="page form-page">
    <div class="page-heading">
        <div>
            <p class="eyebrow">Catalogue update</p>
            <h1>Add a product.</h1>
            <p>Give your team the detail they need to keep the catalogue moving.</p>
        </div>
    </div>

    <section class="panel form-panel">

    <form action="<?= site_url('products/create'); ?>" method="POST">

        <div class="form-grid">
            <div class="field field-wide">
                <label for="product_name">Product name</label>
                <input id="product_name" type="text" name="product_name" required maxlength="100">
            </div>

            <div class="field field-wide">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5"></textarea>
            </div>

            <div class="field">
                <label for="price">Price</label>
                <input id="price" type="number" name="price" step="0.01" min="0" required>
            </div>

            <div class="field">
                <label for="quantity">Quantity</label>
                <input id="quantity" type="number" name="quantity" min="0" required>
            </div>
        </div>

        <div class="form-actions">
            <button class="button button-primary" type="submit">Save product</button>
            <a class="button button-quiet" href="<?= site_url('products'); ?>">Cancel</a>
        </div>

    </form>
</section>
</main>

<div class="modal-backdrop" id="logout-modal" role="dialog" aria-modal="true" aria-labelledby="logout-title" hidden>
    <div class="modal-card">
        <p class="eyebrow">Sign out</p>
        <h2 id="logout-title">Do you want to log out?</h2>
        <p>Your current session will end and you will return to the sign-in page.</p>
        <div class="modal-actions">
            <button class="button button-quiet" type="button" data-modal-close>Cancel</button>
            <a class="button button-primary" href="<?= site_url('logout'); ?>">Yes, sign out</a>
        </div>
    </div>
</div>
<script>
    const logoutModal = document.getElementById('logout-modal');
    document.querySelector('[data-modal-open="logout-modal"]').addEventListener('click', () => logoutModal.hidden = false);
    document.querySelector('[data-modal-close]').addEventListener('click', () => logoutModal.hidden = true);
    logoutModal.addEventListener('click', (event) => { if (event.target === logoutModal) logoutModal.hidden = true; });
</script>
</body>
</html>