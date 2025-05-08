# Coffee Shop Management System

A modern PHP-based Coffee Shop Management System built using the MVC (Model-View-Controller) architecture.

## Features

- Product Management
  - Add, edit, and delete products
  - Categorize products
  - Track inventory
- Order Management
  - Create and manage orders
  - Track order status
  - Process payments
- User Management
  - Multiple user roles (admin, staff, customer)
  - Secure authentication
- Modern UI
  - Responsive design
  - Bootstrap 5
  - Font Awesome icons

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (for dependency management)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/haile12michael12/coffee-shop-management.git
cd coffee-shop-management
```

2. Install dependencies:
```bash
composer install
```

3. Create the database:
```bash
mysql -u root -p < database/schema.sql
```

4. Configure the database connection:
- Copy `config/database.example.php` to `config/database.php`
- Update the database credentials in `config/database.php`

5. Set up the web server:
- Point your web server's document root to the `public` directory
- Ensure the `storage` directory is writable by the web server

6. Start the development server:
```bash
php -S localhost:8000 -t public
```

## Directory Structure

```
coffee-shop-management/
├── App/
│   ├── Controllers/
│   ├── Models/
│   └── Views/
├── config/
├── database/
├── public/
├── storage/
└── vendor/
```

## Usage

1. Access the application at `http://localhost:8000`
2. Log in with the default admin credentials:
   - Username: admin
   - Password: admin123
3. Start managing your coffee shop!

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, email support@coffeeshop.com or create an issue in the repository.