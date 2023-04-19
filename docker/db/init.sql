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

create table if not exists open_ai_accounts
(
    email            varchar(64)       not null,
    first_time       datetime(3)       null,
    usd_spent        double  null,
    usd_spent_limit  double  null,
    api_key          varchar(64)       not null,
    status           tinyint default 0 not null,
    query_cnt        bigint  null,
    credit_used      double  null,
    credit_available double  null,
    expires_at       datetime(3)       null,
    name             longtext          null,
    password         longtext          null,
    id               bigint unsigned auto_increment
        primary key,
    created_at       datetime(3)       null,
    updated_at       datetime(3)       null,
    deleted_at       datetime(3)       null,
    email_password   longtext          null,
    constraint idx_open_ai_accounts_api_key
        unique (api_key),
    constraint idx_open_ai_accounts_email
        unique (email)
);
