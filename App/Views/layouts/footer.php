    </main>

    <!-- Footer -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Section -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Coffee<span class="text-indigo-600">Shop</span></h3>
                    <p class="text-gray-600 mb-4">
                        Experience the perfect blend of coffee and comfort at our shop. We serve the finest coffee beans sourced from around the world.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">Quick Links</h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="<?php echo APPURL; ?>/menu" class="text-base text-gray-500 hover:text-gray-900">Menu</a>
                        </li>
                        <li>
                            <a href="<?php echo APPURL; ?>/about" class="text-base text-gray-500 hover:text-gray-900">About Us</a>
                        </li>
                        <li>
                            <a href="<?php echo APPURL; ?>/contact" class="text-base text-gray-500 hover:text-gray-900">Contact</a>
                        </li>
                        <li>
                            <a href="<?php echo APPURL; ?>/blog" class="text-base text-gray-500 hover:text-gray-900">Blog</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">Contact Info</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-500">
                            <i class="fas fa-map-marker-alt w-5"></i>
                            <span>123 Coffee Street, City, Country</span>
                        </li>
                        <li class="flex items-center text-gray-500">
                            <i class="fas fa-phone w-5"></i>
                            <span>+1 234 567 890</span>
                        </li>
                        <li class="flex items-center text-gray-500">
                            <i class="fas fa-envelope w-5"></i>
                            <span>info@coffeeshop.com</span>
                        </li>
                        <li class="flex items-center text-gray-500">
                            <i class="fas fa-clock w-5"></i>
                            <span>Mon-Fri: 7AM - 8PM</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        &copy; <?php echo date('Y'); ?> CoffeeShop. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="<?php echo APPURL; ?>/privacy" class="text-gray-400 hover:text-gray-500 text-sm">Privacy Policy</a>
                        <a href="<?php echo APPURL; ?>/terms" class="text-gray-400 hover:text-gray-500 text-sm">Terms of Service</a>
                        <a href="<?php echo APPURL; ?>/sitemap" class="text-gray-400 hover:text-gray-500 text-sm">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Custom JavaScript -->
    <script src="<?php echo APPURL; ?>/public/js/app.js"></script>
</body>
</html>