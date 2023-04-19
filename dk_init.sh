# 本脚本仅在 docker-compose up 时执行一次
cp .env.docker .env
/wait
php artisan key:generate

# init orchid
php artisan orchid:install -n
php artisan migrate
# 生成随机密码
# psw=$(head /dev/urandom | tr -dc A-Za-z0-9 | head -c10)
psw=admin
php artisan orchid:admin admin admin@admin.com $psw
echo "Admin password: $psw"

# init db
#cat /app/docker/db/init.sql | mysql -hdb -uubuntu -pubuntu

yarn vite --host 0.0.0.0 &
php artisan serve --host=0.0.0.0

