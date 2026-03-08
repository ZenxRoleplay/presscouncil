# Information of Press Council of Maharashtra — Website

## Deployment Requirements

### 1. Install PHP dependencies
```
composer install
```

### 2. Copy Nirmala UI fonts (required for PDF generation)

The PDF generators use Nirmala UI for Devanagari/Hindi/Marathi rendering. These fonts must be copied manually from the Windows system fonts folder:

```
copy C:\Windows\Fonts\NIRMALA.TTF vendor\mpdf\mpdf\ttfonts\Nirmala.ttf
copy C:\Windows\Fonts\NIRMALAB.TTF vendor\mpdf\mpdf\ttfonts\NirmalaB.ttf
```

> **Note:** Nirmala UI is a Microsoft-licensed font included with Windows. It cannot be distributed in the repository. This step is required on every fresh deployment.

### 3. Start the PHP development server
```
php -S localhost:8080 router.php
```

### 4. Database
Start MariaDB/MySQL and ensure the credentials in `db.php` match your environment.
