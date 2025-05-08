<?php 

    session_start();
    define("APPURL", "http://localhost/coffee-shop-management");
    define("IMAGEPRODUCTS", "http://localhost/coffee-blend/admin-panel/products-admins/images");


?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - ' : ''; ?>Coffee Shop Management</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo APPURL; ?>/public/css/custom.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  </head>
  <body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg" x-data="{ isOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="<?php echo APPURL; ?>" class="text-2xl font-bold text-indigo-600">
                            Coffee<span class="text-gray-800">Shop</span>
                        </a>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="<?php echo APPURL; ?>" 
                           class="<?php echo $currentPage === 'home' ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'; ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Home
                        </a>
                        <a href="<?php echo APPURL; ?>/menu" 
                           class="<?php echo $currentPage === 'menu' ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'; ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Menu
                        </a>
                        <a href="<?php echo APPURL; ?>/about" 
                           class="<?php echo $currentPage === 'about' ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'; ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            About
                        </a>
                        <a href="<?php echo APPURL; ?>/contact" 
                           class="<?php echo $currentPage === 'contact' ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'; ?> inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Contact
                        </a>
                    </div>
                </div>

                <!-- Right side navigation -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <!-- Shopping Cart -->
                        <a href="<?php echo APPURL; ?>/cart" class="p-2 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-shopping-cart"></i>
                            <?php if(isset($_SESSION['cart_count']) && $_SESSION['cart_count'] > 0): ?>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-indigo-600 rounded-full">
                                    <?php echo $_SESSION['cart_count']; ?>
                                </span>
                            <?php endif; ?>
                        </a>

                        <!-- User Dropdown -->
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                                        <?php echo substr($_SESSION['user_name'], 0, 1); ?>
                                    </div>
                                </button>
                            </div>
                            <div x-show="open" 
                                 @click.away="open = false"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                                <?php if($_SESSION['user_role'] === 'admin'): ?>
                                    <a href="<?php echo APPURL; ?>/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Dashboard</a>
                                <?php endif; ?>
                                <a href="<?php echo APPURL; ?>/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                                <a href="<?php echo APPURL; ?>/orders" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Orders</a>
                                <a href="<?php echo APPURL; ?>/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo APPURL; ?>/login" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Sign in</a>
                        <a href="<?php echo APPURL; ?>/register" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Sign up
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="isOpen = !isOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars" x-show="!isOpen"></i>
                        <i class="fas fa-times" x-show="isOpen"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="sm:hidden" x-show="isOpen" @click.away="isOpen = false">
            <div class="pt-2 pb-3 space-y-1">
                <a href="<?php echo APPURL; ?>" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700">Home</a>
                <a href="<?php echo APPURL; ?>/menu" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700">Menu</a>
                <a href="<?php echo APPURL; ?>/about" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700">About</a>
                <a href="<?php echo APPURL; ?>/contact" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700">Contact</a>
            </div>
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                                <?php echo substr($_SESSION['user_name'], 0, 1); ?>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800"><?php echo $_SESSION['user_name']; ?></div>
                            <div class="text-sm font-medium text-gray-500"><?php echo $_SESSION['user_email']; ?></div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <?php if($_SESSION['user_role'] === 'admin'): ?>
                            <a href="<?php echo APPURL; ?>/admin" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Admin Dashboard</a>
                        <?php endif; ?>
                        <a href="<?php echo APPURL; ?>/profile" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Your Profile</a>
                        <a href="<?php echo APPURL; ?>/orders" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Your Orders</a>
                        <a href="<?php echo APPURL; ?>/logout" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Sign out</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <div class="space-y-1">
                        <a href="<?php echo APPURL; ?>/login" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700">Sign in</a>
                        <a href="<?php echo APPURL; ?>/register" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700">Sign up</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if(isset($_SESSION['flash_message'])): ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="rounded-md <?php echo $_SESSION['flash_type'] === 'success' ? 'bg-green-50' : 'bg-red-50'; ?> p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <?php if($_SESSION['flash_type'] === 'success'): ?>
                            <i class="fas fa-check-circle text-green-400"></i>
                        <?php else: ?>
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        <?php endif; ?>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium <?php echo $_SESSION['flash_type'] === 'success' ? 'text-green-800' : 'text-red-800'; ?>">
                            <?php echo $_SESSION['flash_message']; ?>
                        </p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button type="button" class="inline-flex rounded-md p-1.5 <?php echo $_SESSION['flash_type'] === 'success' ? 'text-green-500 hover:bg-green-100' : 'text-red-500 hover:bg-red-100'; ?> focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
                                <span class="sr-only">Dismiss</span>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['flash_message'], $_SESSION['flash_type']); ?>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">