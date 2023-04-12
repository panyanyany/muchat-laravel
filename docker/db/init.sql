use muchat;

create table if not exists muchat_users
(
    slug       varchar(64)      not null,
    first_time datetime(3)      null,
    first_ip   varchar(128)     null,
    `usage`    bigint default 0 not null,
    max_usage  bigint default 0 not null,
    referer    varchar(128)     null,
    bad_cnt    bigint default 0 not null,
    max_days   bigint default 0 not null,
    expires_at datetime(3)      null,
    name       longtext         null,
    id         bigint unsigned auto_increment
        primary key,
    created_at datetime(3)      null,
    updated_at datetime(3)      null,
    deleted_at datetime(3)      null,
    constraint idx_users_slug
        unique (slug)
);
