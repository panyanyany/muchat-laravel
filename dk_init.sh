# 本脚本仅在 docker-compose up 时执行一次
if [ ! -f /app/installed ]; then
    cp .env.docker .env
    php artisan key:generate

    # init orchid
    php artisan orchid:install -n
    php artisan migrate
    # 生成随机密码
    # psw=$(head /dev/urandom | tr -dc A-Za-z0-9 | head -c10)
    psw=admin
    php artisan orchid:admin admin admin@admin.com $psw
    echo "Admin password: $psw"

    touch /app/installed
else
    echo 'already installed'
fi

# init db
#cat /app/docker/db/init.sql | mysql -hdb -uubuntu -pubuntu


