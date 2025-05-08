<?php require_once 'App/Views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Admin Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['total_users']; ?></p>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-coffee text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Products</p>
                    <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['total_products']; ?></p>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Orders</p>
                    <p class="text-2xl font-semibold text-gray-900"><?php echo $stats['total_orders']; ?></p>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                    <p class="text-2xl font-semibold text-gray-900">$<?php echo number_format($stats['revenue'], 2); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders and Top Products -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Recent Orders</h2>
            </div>
            <div class="p-6">
                <div class="flow-root">
                    <ul class="-my-5 divide-y divide-gray-200">
                        <?php foreach ($stats['recent_orders'] as $order): ?>
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-100">
                                        <i class="fas fa-shopping-bag text-gray-500"></i>
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        Order #<?php echo $order['id']; ?>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        <?php echo $order['customer_name']; ?> - $<?php echo number_format($order['total'], 2); ?>
                                    </p>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        <?php echo $order['status'] === 'completed' ? 'bg-green-100 text-green-800' : 
                                            ($order['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'); ?>">
                                        <?php echo ucfirst($order['status']); ?>
                                    </span>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mt-6">
                    <a href="/admin/orders" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        View all orders
                    </a>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Top Selling Products</h2>
            </div>
            <div class="p-6">
                <div class="flow-root">
                    <ul class="-my-5 divide-y divide-gray-200">
                        <?php foreach ($stats['top_products'] as $product): ?>
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <?php if ($product['image']): ?>
                                        <img class="h-8 w-8 rounded-full object-cover" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                                    <?php else: ?>
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gray-100">
                                            <i class="fas fa-coffee text-gray-500"></i>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        <?php echo $product['name']; ?>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        $<?php echo number_format($product['price'], 2); ?> - <?php echo $product['total_sold']; ?> sold
                                    </p>
                                </div>
                                <div class="text-sm text-gray-500">
                                    $<?php echo number_format($product['total_revenue'], 2); ?>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mt-6">
                    <a href="/admin/products" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        View all products
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="/admin/products/create" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                <i class="fas fa-plus mr-2"></i> Add New Product
            </a>
            <a href="/admin/orders" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                <i class="fas fa-shopping-cart mr-2"></i> Manage Orders
            </a>
            <a href="/admin/users" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                <i class="fas fa-users mr-2"></i> Manage Users
            </a>
        </div>
    </div>
</div>

<?php require_once 'App/Views/layouts/footer.php'; ?> 