<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products</title>
    <link rel="stylesheet" href="<?= base_url('css/app.css'); ?>">
</head>

<body class="shell">
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

<main class="page">
    <div class="page-heading">
        <div>
            <p class="eyebrow">Catalogue overview</p>
            <h1>Products, in focus.</h1>
            <p>Keep the details that matter close at hand, from stock levels to the next update.</p>
        </div>
        <a href="<?= site_url('products/create'); ?>" class="button button-primary">+ Add product</a>
    </div>

    <section class="panel table-panel">
        <div class="table-wrap">
        <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php if (!empty($products)): ?>

            <?php foreach ($products as $product): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars($product['id']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['product_name']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['description']); ?>
                    </td>

                    <td>
                        ₱<?= number_format($product['price'], 2); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['quantity']); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($product['created_at']); ?>
                    </td>

                    <td>
                        <div class="actions">
                            <a
                                href="<?= site_url('products/edit/' . $product['id']); ?>"
                                class="action-link">
                                Edit
                            </a>

                            <button
                                type="button"
                                data-delete-url="<?= site_url('products/delete/' . $product['id']); ?>"
                                class="action-link action-danger"
                                data-delete-product="<?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>">
                                Delete
                            </button>
                        </div>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="7" class="table-empty">
                    No products found.
                </td>
            </tr>

        <?php endif; ?>

        </tbody>

        </table>
        </div>
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
<div class="modal-backdrop" id="delete-modal" role="dialog" aria-modal="true" aria-labelledby="delete-title" hidden>
    <div class="modal-card">
        <p class="eyebrow">Remove product</p>
        <h2 id="delete-title">Delete this product?</h2>
        <p id="delete-message">This action cannot be undone.</p>
        <div class="modal-actions">
            <button class="button button-quiet" type="button" data-delete-close>Cancel</button>
            <a class="button button-primary" id="delete-confirm" href="#">Yes, delete</a>
        </div>
    </div>
</div>
<script>
    const logoutModal = document.getElementById('logout-modal');
    document.querySelector('[data-modal-open="logout-modal"]').addEventListener('click', () => logoutModal.hidden = false);
    document.querySelector('[data-modal-close]').addEventListener('click', () => logoutModal.hidden = true);
    logoutModal.addEventListener('click', (event) => { if (event.target === logoutModal) logoutModal.hidden = true; });

    const deleteModal = document.getElementById('delete-modal');
    const deleteConfirm = document.getElementById('delete-confirm');
    const deleteMessage = document.getElementById('delete-message');
    document.querySelectorAll('[data-delete-url]').forEach((button) => {
        button.addEventListener('click', () => {
            deleteConfirm.href = button.dataset.deleteUrl;
            deleteMessage.textContent = 'Are you sure you want to delete "' + button.dataset.deleteProduct + '"? This action cannot be undone.';
            deleteModal.hidden = false;
        });
    });
    document.querySelector('[data-delete-close]').addEventListener('click', () => deleteModal.hidden = true);
    deleteModal.addEventListener('click', (event) => { if (event.target === deleteModal) deleteModal.hidden = true; });
</script>
</body>
</html>