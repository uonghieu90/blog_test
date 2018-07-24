Cho apache
Truy cập tới server
trong thư mục www
git clone https://github.com/uonghieu90/blog_test.git
cd blog_test

Sử dung composer với lệnh sau
$ php composer install
$ php composer dumpautoload -o
$ php artisan config:cache
$ php artisan route:cache


change .env file .
change database setting.

dung lenh  php artisan migrate de khoi tao database.
Vào database bang user change is_admin=1 de tao admin.
