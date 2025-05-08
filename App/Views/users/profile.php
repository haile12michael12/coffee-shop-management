<?php require __DIR__.'/../../layouts/header.php'; ?>

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">My Profile</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="<?php echo APPURL; ?>">Home</a></span> 
                        <span>My Profile</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Profile Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>First Name:</strong> <?php echo $user['first_name']; ?></p>
                                <p><strong>Last Name:</strong> <?php echo $user['last_name']; ?></p>
                                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                                <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="<?php echo APPURL; ?>/users/bookings" class="btn btn-primary">View My Bookings</a>
                            <a href="<?php echo APPURL; ?>/users/orders" class="btn btn-primary">View My Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__.'/../../includes/footer.php'; ?> 