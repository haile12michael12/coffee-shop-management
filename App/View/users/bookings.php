<?php require __DIR__.'/../../includes/header.php'; ?>

<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">
                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Your Bookings</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="<?php echo APPURL; ?>">Home</a></span> 
                        <span>Your Bookings</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <?php if(count($allBookings) > 0) : ?>
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Write Review</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allBookings as $booking) : ?>
                                <tr class="text-center">
                                    <td><?php echo $booking->first_name; ?></td>
                                    <td><?php echo $booking->last_name; ?></td>
                                    <td><h3><?php echo $booking->date; ?></h3></td>
                                    <td><?php echo $booking->time; ?></td>
                                    <td><?php echo $booking->phone; ?></td>
                                    <td><?php echo $booking->message; ?></td>
                                    <td><?php echo $booking->status; ?></td>
                                    <td>
                                        <?php if($booking->status == "Done") : ?>
                                            <a class="btn btn-primary" href="<?php echo APPURL; ?>/reviews/write-review.php">
                                                Write Review
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>You do not have any bookings for now</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__.'/../../includes/footer.php'; ?>