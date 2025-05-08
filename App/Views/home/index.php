<?php require __DIR__.'/../../includes/header.php'; ?>

    <section class="home-slider owl-carousel">
      <!-- Slider items remain the same -->
      <!-- ... slider items code ... -->
    </section>

    <!-- Rest of the HTML structure -->
    <!-- ... about section, services, menu, etc ... -->

    <!-- Products Section -->
    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Best Coffee Sellers</h2>
            <p>Far far away, behind the word mountains...</p>
          </div>
        </div>
        <div class="row">
			<?php foreach($allProducts as $product) : ?>
				<div class="col-md-3">
					<div class="menu-entry">
							<a target="_blank" href="products/product-single.php?id=<?php echo $product->id; ?>" 
                               class="img" style="background-image: url(<?php echo IMAGEPRODUCTS; ?>/<?php echo $product->image; ?>);">
                            </a>
							<div class="text text-center pt-4">
								<h3><a href="#"><?php echo $product->name; ?></a></h3>
								<p><?php echo $product->description; ?></p>
								<p class="price"><span>$<?php echo $product->price; ?></span></p>
								<p><a target="_blank" href="products/product-single.php?id=<?php echo $product->id; ?>" 
                                    class="btn btn-primary btn-outline-primary">Show</a></p>
							</div>
						</div>
				</div>
			<?php endforeach; ?>
        </div>
    	</div>
    </section>

    <!-- Testimonials Section -->
    <section class="ftco-section img" id="ftco-testimony" style="background-image: url(images/bg_1.jpg);">
    	<div class="overlay"></div>
	    <div class="container">
	      <div class="row justify-content-center mb-5">
	        <div class="col-md-7 heading-section text-center ftco-animate">
	        	<span class="subheading">Testimony</span>
	          <h2 class="mb-4">Customers Says</h2>
	          <p>Far far away, behind the word mountains...</p>
	        </div>
	      </div>
	    </div>
	    <div class="container-wrap">
	      <div class="row d-flex no-gutters">
			<?php foreach($allReviews as $review) : ?>
	        <div class="col-md-3 align-self-sm-end ftco-animate">
	          <div class="testimony">
	             <blockquote>
	                <p>&ldquo;<?php echo $review->review; ?>.&rdquo;</p>
	              </blockquote>
	              <div class="author d-flex mt-4">
	                <div class="name align-self-center"><?php echo $review->username; ?></div>
	              </div>
	          </div>
	        </div>
			<?php endforeach; ?>
	      </div>
	    </div>
	  </section>

<?php require __DIR__.'/../../includes/footer.php'; ?>