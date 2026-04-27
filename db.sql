create table posts
(
    id          int auto_increment comment 'post ID'
        primary key,
    image       varchar(255) null comment 'image filename',
    title       varchar(255) not null,
    description tinytext     null,
    text        text         null,
    views       integer(6)   default 0 comment 'views counter',
    created_at  datetime   default CURRENT_TIMESTAMP comment 'created date'
);

create table categories
(
    id          int auto_increment comment 'category ID'
        primary key,
    title       varchar(255) null,
    description text         null
);

create table category_posts
(
    category_id int not null,
    post_id     int not null
)
    comment 'pivot for category hasMany posts';
