# Vermon Hotel & Bar

A premium Laravel 12 hotel management system with a powerful CMS for managing your hotel website.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![License](https://img.shields.io/badge/License-Envato-green.svg)

## 🌟 Features

### Content Management System
- ✅ Full page editor for all public pages
- ✅ Section visibility toggles (show/hide)
- ✅ Drag & drop section ordering
- ✅ Per-page style customization
- ✅ SEO settings per page
- ✅ Reset to default functionality

### Admin Panel
- ✅ Modern, responsive admin dashboard
- ✅ Site settings & configuration
- ✅ Theme customization
- ✅ Image upload management
- ✅ Multi-currency support

### Hotel Features
- ✅ Room type management
- ✅ Room availability tracking
- ✅ Booking system
- ✅ Guest management
- ✅ Seasonal pricing

### Security
- ✅ CSRF protection
- ✅ Role-based access control
- ✅ Encrypted password storage
- ✅ Input validation & XSS protection
- ✅ Secure session handling
- ✅ Rate limiting

## 📋 Requirements

- PHP >= 8.2
- MySQL 5.7+ or SQLite
- Composer 2.x
- Node.js 18+ (for development)
- BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, XML, Fileinfo, GD extensions

## 🚀 Quick Installation

### Using Installation Wizard (Recommended)

1. Upload files to your web server
2. Navigate to `https://yourdomain.com/install`
3. Follow the installation steps
4. Access admin at `/admin`

### Manual Installation

```bash
# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Configure database in .env
# DB_CONNECTION=mysql
# DB_DATABASE=your_database
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# Run migrations & seeders
php artisan migrate --seed

# Create storage link
php artisan storage:link

# Build assets (development)
npm install && npm run build
```

## 🛠️ Development

```bash
# Start development server
composer dev

# Or run services individually
php artisan serve
npm run dev
php artisan queue:work
```

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/               # Eloquent models
│   └── Helpers/              # Helper classes
├── config/                   # Configuration files
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   ├── views/                # Blade templates
│   ├── css/                  # Stylesheets
│   └── js/                   # JavaScript
├── routes/                   # Route definitions
└── documentation/            # Documentation files
```

## 📄 Documentation

Full documentation is available in the `/documentation` folder. Open `documentation/index.html` in your browser.

## 🔒 Security

This application implements:
- Laravel's built-in CSRF protection
- Spatie Laravel Permission for RBAC
- Bcrypt password hashing
- Input sanitization middleware
- Security headers middleware
- Rate limiting on authentication
- Encrypted sessions

See [SECURITY.md](SECURITY.md) for details.

## 📝 Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history.

## 📜 License

This project is licensed under the Envato Regular/Extended License. See [LICENSE.md](LICENSE.md) for details.

## 🤝 Support

For support, please:
1. Read the documentation
2. Check the FAQ section
3. Contact through CodeCanyon with your purchase code

## 🙏 Credits

- [Laravel](https://laravel.com) - PHP Framework
- [Spatie](https://spatie.be) - Laravel Permission Package
- [Bootstrap](https://getbootstrap.com) - CSS Framework
- [Font Awesome](https://fontawesome.com) - Icons

---

Made with ❤️ for the hospitality industry

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
