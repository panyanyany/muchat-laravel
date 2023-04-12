docker compose down; docker compose up -d
docker compose exec admin cp .env.docker .env
docker compose exec admin //wait
docker compose exec admin php artisan key:generate

# init orchid
docker compose exec admin php artisan orchid:install -n
docker compose exec admin php artisan migrate
# 生成随机密码
# psw=$(head /dev/urandom | tr -dc A-Za-z0-9 | head -c10)
psw=admin
docker compose exec admin php artisan orchid:admin admin admin@admin.com $psw
echo "Admin password: $psw"

# init db
docker compose exec db sh -c 'cat /app/docker/db/init.sql | mysql -uubuntu -pubuntu'

docker compose exec admin yarn vite
