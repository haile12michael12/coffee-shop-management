<?php require __DIR__.'/../../includes/header.php'; ?>

<section class="home-slider owl-carousel">
    <!-- Slider content same as original -->
</section>

<section class="ftco-section">
    <div class="container">
        <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <form action="<?php echo APPURL; ?>/booking" method="POST" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading">Book a Table</h3>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group ml-md-4">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <!-- Rest of the form fields -->
                    <div class="col-md-12">
                        <div class="form-group mt-4">
                            <button type="submit" name="submit" class="btn btn-primary py-3 px-4">
                                Book Table
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__.'/../../includes/footer.php'; ?>