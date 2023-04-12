docker compose down; docker compose up -d
docker compose exec admin cp .env.docker .env
docker compose exec admin //wait
docker compose exec admin php artisan key:generate

# init orchid
docker compose exec admin php artisan migrate
#psw=$(docker run --rm busybox sh -c 'echo $(date) | md5sum' | awk '{print $1}' | cut -b -8)
psw=$(head /dev/urandom | tr -dc A-Za-z0-9 | head -c10)
docker compose exec admin php artisan orchid:admin admin admin@admin.com $psw
echo "Admin password: $psw"

# init db
docker compose exec db sh -c 'cat /app/docker/db/init.sql | mysql -uubuntu -pubuntu'

docker compose exec admin yarn vite
