create table users
(
    id           bigint auto_increment
        primary key,
    username     varchar(255)                          null,
    password     varchar(255)                          null,
    access_token varchar(255)                          null,
    status       tinyint                               null,
    created_by   bigint                                null,
    created_date timestamp default current_timestamp() null,
    updated_by   bigint                                null,
    updated_date timestamp                             null,
    deleted_by   bigint                                null,
    deleted_date timestamp                             null
);

INSERT INTO db_karyawan.users (id, username, password, access_token, status, created_by, created_date, updated_by, updated_date, deleted_by, deleted_date) VALUES (1, 'admin', '$2y$10$stDW3708fxUoOhvHcjGU5eOE9qD5a.Qfx0Gxcq4ocg12tEYFHIdvS', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEifQ.GX-o9Fq7VKDAxSJh4LjPp8NLYa2OwFt56hJXL_d3Ey0', 1, 1, '2020-05-04 11:19:35', null, null, null, null);