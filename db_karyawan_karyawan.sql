create table karyawan
(
    id           bigint auto_increment
        primary key,
    nik          varchar(255)                          null,
    nama         varchar(255)                          null,
    status       tinyint                               null,
    created_by   bigint                                null,
    created_date timestamp default current_timestamp() null,
    updated_by   bigint                                null,
    updated_date timestamp                             null,
    deleted_by   bigint                                null,
    deleted_date timestamp                             null
);

INSERT INTO db_karyawan.karyawan (id, nik, nama, status, created_by, created_date, updated_by, updated_date, deleted_by, deleted_date) VALUES (1, '001', 'tes', 1, 1, '2021-09-15 08:19:43', null, null, null, null);