# DCGroup - Laravel Contact Form Application

## Steps to Run the Project

1. Create a MySQL database named `dc_group`

2. Install dependencies:
   composer install

3. Copy `.env.example` to `.env` and generate application key:
   php artisan key:generate

4. Run migrations:
   php artisan migrate

5. Start the development server:
   php artisan serve
   Access the application at `http://localhost:8000`

## How to Configure Mail (.env sample)

Update your `.env` file with the following mail configuration:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your email
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your email"
MAIL_FROM_NAME="${APP_NAME}"
MAIL_ADMIN=admin email
```

After updating `.env`, clear config cache:
php artisan config:clear

## How to Run Tests

Run below artisan command to perform tests:

php artisan test --filter ContactFormTest
