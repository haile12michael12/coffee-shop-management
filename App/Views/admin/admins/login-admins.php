<?php
    // Start session if not already started (ideally done ONCE in a central bootstrap file)
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Include necessary files like header, config (for BASE_URL/ADMIN_URL if needed)
    // Adjust paths as necessary
    // Assuming header.php includes config/database.php or constants are defined globally
    require_once __DIR__ . '/../layouts/header.php';

    // Check for login error message from session
    $loginError = '';
    if (isset($_SESSION['login_error'])) {
        $loginError = $_SESSION['login_error'];
        unset($_SESSION['login_error']); // Clear error after displaying
    }

    // Redirect if admin is already logged in
    if (isset($_SESSION['is_admin_logged_in']) && $_SESSION['is_admin_logged_in'] === true) {
        header("Location: " . (defined('ADMIN_URL') ? ADMIN_URL : '/admin') . "/index.php"); // Redirect to dashboard
        exit();
    }
?>
       <div class="row mt-5"> <!- Added margin top ->
        <div class="col-lg-6 col-md-8 mx-auto"> <!- Centering the form ->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center mt-4 mb-4">Admin Login</h5> <!- Centered title ->

              <?php if (!empty($loginError)): ?>
                <div class="alert alert-danger text-center" role="alert"> <!- Centered alert ->
                  <?php echo htmlspecialchars($loginError); ?>
                </div>
              <?php endif; ?>

              <!-- ===================================================================== -->
              <!-- IMPORTANT: Update the action attribute to point to your handler -->
              <!-- Option 1: A dedicated processing script -->
              <!-- action="<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>/admin-login-handler.php" -->
              <!-- Option 2: A route handled by your main router (e.g., public/index.php?url=auth/adminLogin) -->
              <!-- action="<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>/index.php?url=auth/adminLogin" -->
              <!-- Choose the appropriate action based on your setup -->
              <!-- ===================================================================== -->
              <form method="POST" action="<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>/admin-login-handler.php" class="p-auto">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Email address</label>
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" required />
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-4">
                     <label class="form-label" for="form2Example2">Password</label>
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" required />
                  </div>

                  <!-- Submit button -->
                  <div class="text-center"> <!- Center button ->
                    <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Login</button> <!- btn-block for full width ->
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>