# Server Requirements

## Minimum Requirements

| Software | Version |
|----------|---------|
| PHP | 8.2+ |
| MySQL | 5.7+ |
| -or- SQLite | 3.x |
| Composer | 2.x |
| Node.js | 18+ (dev only) |

## Required PHP Extensions

The following PHP extensions must be enabled:

- ✅ BCMath PHP Extension
- ✅ Ctype PHP Extension
- ✅ cURL PHP Extension
- ✅ DOM PHP Extension
- ✅ Fileinfo PHP Extension
- ✅ JSON PHP Extension
- ✅ Mbstring PHP Extension
- ✅ OpenSSL PHP Extension
- ✅ PCRE PHP Extension
- ✅ PDO PHP Extension
- ✅ PDO_MySQL PHP Extension (for MySQL)
- ✅ PDO_SQLite PHP Extension (for SQLite)
- ✅ Tokenizer PHP Extension
- ✅ XML PHP Extension
- ✅ GD PHP Extension (for image processing)

## Directory Permissions

The following directories must be writable by the web server:

```
storage/           (755 or 775)
bootstrap/cache/   (755 or 775)
```

## Recommended Configuration

### PHP Settings (php.ini)

```ini
upload_max_filesize = 20M
post_max_size = 25M
max_execution_time = 120
memory_limit = 256M
```

### MySQL Settings

```ini
innodb_file_per_table = 1
innodb_buffer_pool_size = 256M
```

## Supported Web Servers

- ✅ Apache 2.4+ (with mod_rewrite)
- ✅ Nginx 1.18+
- ✅ LiteSpeed

### Apache (.htaccess)

The application includes a pre-configured `.htaccess` file for Apache.

### Nginx Configuration

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/public;

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Hosting Recommendations

### Shared Hosting
- Must support PHP 8.2+
- Must have Composer access or allow vendor folder upload
- Examples: cPanel with PHP selector, Plesk

### VPS/Dedicated
- Any Linux distribution with PHP 8.2+
- 1GB RAM minimum (2GB+ recommended)
- Examples: DigitalOcean, Linode, AWS EC2

### Cloud Platforms
- Laravel Forge
- Laravel Vapor (serverless)
- Heroku with PHP buildpack
- Google Cloud Run

## Checking Your Environment

Run this command to check Laravel requirements:

```bash
php artisan about
```

Or check PHP info:

```bash
php -m  # List installed modules
php -v  # PHP version
```
