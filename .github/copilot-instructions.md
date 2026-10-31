# Copilot Instructions - Vermon Hotel & Bar

## Project Overview
Laravel 12 hotel management system with full CMS. Public website with admin-editable content, session-based admin panel, Spatie Permission for RBAC, Laravel Sanctum for API auth. Supports SQLite/MySQL.

## Development Commands
```bash
composer dev      # Start server + queue + logs + vite (all services)
composer setup    # Fresh installation (install, key:generate, migrate, npm build)
composer test     # Run tests with config:clear
```

## Architecture

### CMS Page Settings Pattern
Each public page has a `*PageSettings` model with JSON columns for content management:
- **Models**: `HomePageSettings`, `AboutPageSettings`, `RoomsPageSettings`, `RestaurantPageSettings`, `ContactPageSettings`, `ServicesPageSettings`, `ExplorePageSettings`, `RoomsGalleryPageSettings`, `SearchPageSettings`, `TandcPageSettings`
- **JSON columns**: `sections` (visibility), `section_order` (drag-drop), `page_styles` (per-page CSS), `content` (key-value)

**Model structure** (see [HomePageSettings.php](app/Models/HomePageSettings.php)):
```php
// Static methods (required)
sectionKeys(): array        // ['hero', 'booking_bar', 'intro', ...]
sectionLabels(): array      // ['hero' => 'Hero Section', ...]
defaultSections(): array    // ['hero' => ['visible' => true], ...]
defaultPageStyles(): array  // ['background_color' => '', ...]

// Instance methods
visible('section_key'): bool
content('key', 'default'): mixed
pageStyle('key'): string
getOrderedSections(): array
```

**View usage** (see [about.blade.php](resources/views/about.blade.php)):
```blade
@foreach($page->getOrderedSections() as $sectionKey)
    @if($page->visible($sectionKey))
        {{-- Render section --}}
        {{ $page->content('hero_title', 'Default Title') }}
    @endif
@endforeach
```

### Admin Controller Pattern
Controllers in `app/Http/Controllers/Admin/` with three methods:
- `edit()` - Load page settings model via `::getCurrent()`
- `update(Request)` - Process sections, section_order, page_styles, content, image uploads
- `reset()` - Restore to defaults

**Admin partials** ([resources/views/admin/partials/](resources/views/admin/partials/)):
- `page-styles-section.blade.php` - Color overrides per page
- `section-order.blade.php` - SortableJS drag-drop reordering
- `reset-button.blade.php` - Reset to defaults

### Route Structure
| Path | Auth | Purpose |
|------|------|---------|
| `/` `/about` `/rooms` `/room/{slug}` | Public | Frontend pages |
| `/admin/*` | Session `auth` | Admin CMS panel |
| `/api/*` | Sanctum + Spatie | API with role/permission |
| `/install/*` | None | Install wizard (disabled after `storage/installed` exists) |

### Key Models & Relationships
```
RoomType (1) → (*) Room → (*) Booking → (1) Guest
                               ↓
                          Payment, Invoice
```
- **Room** scopes: `available()`, `occupied()`, `byFloor()`, `byType()`
- **Booking**: Auto-generates `booking_number` on create (`BK{date}{random}`)

## Key Conventions

### Image Handling
Always use `ImageHelper::url()` - handles URLs, `/assets/*`, `/storage/*`, `/uploads/*`:
```php
{{ \App\Helpers\ImageHelper::url($path, '/assets/img/default.jpg') }}
```

### Assets from Resources
Static assets served via `AssetController` from `resources/`:
- URLs: `/assets/css/*`, `/assets/js/*`, `/assets/img/*`, `/assets/fonts/*`

### Database Seeders
Use `updateOrCreate()` for idempotent seeding:
- `PopulateContentSeeder` - Full hotel content
- `SampleDataSeeder` - Test data for rooms/bookings

### Configuration
Business settings in `config/hotel.php` (not hardcoded):
```php
config('hotel.currency_symbol')        // $
config('hotel.booking.check_in_time')  // 14:00
config('hotel.tax_rate')               // 10.00
```

### Installation Check
`InstallController::isInstalled()` checks for `storage/installed` file.

## Creating New CMS Pages
1. **Migration**: Add `sections`, `section_order`, `page_styles`, `content` JSON columns
2. **Model**: Implement static methods (`sectionKeys`, `sectionLabels`, `defaultSections`, `defaultPageStyles`) and instance methods (`visible`, `content`, `pageStyle`, `getOrderedSections`)
3. **Admin controller**: Create with `edit()`, `update()`, `reset()` methods
4. **Admin view**: Include partials (`reset-button`, `page-styles-section`, `section-order`)
5. **Routes**: Add to `routes/web.php` under `admin` prefix with `auth` middleware

## View Structure
- **Layouts**: `layouts/site.blade.php` (public), `layouts/app.blade.php` (admin)
- **Partials**: `resources/views/partials/` (header/footer), `resources/views/admin/partials/` (admin components)
