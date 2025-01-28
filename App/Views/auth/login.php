<?php require '../includes/header.php'; ?>

<div class="login-container">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p class="error"> <?php echo htmlspecialchars($error); ?> </p>
    <?php endif; ?>
    <form action="" method="POST">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="submit">Login</button>
    </form>
</div>

<?php require '../includes/footer.php'; ?>