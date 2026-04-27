<?php

use App\DB;

require_once __DIR__ . '/vendor/autoload.php';

$db = new DB()->getInstance();

print "Reseting tables";

$db->exec("SET FOREIGN_KEY_CHECKS = 0;");
$db->exec("DROP TABLE posts;");
$db->exec("DROP TABLE categories;");
$db->exec("DROP TABLE category_posts;");

print "Creating tables";

$db->exec("create table posts
        (
            id          int auto_increment comment 'post ID'
                primary key,
            image       varchar(255) null comment 'image filename',
            title       varchar(255) not null,
            description tinytext     null,
            text        text         null,
            views       integer(6)   default 0 comment 'views counter',
            created_at  datetime   default CURRENT_TIMESTAMP comment 'created date'
        );");
$db->exec("create table categories
    (
        id          int auto_increment comment 'category ID'
            primary key,
        title       varchar(255) null,
        description text         null
    );");
$db->exec("create table category_posts
(
    category_id int not null,
    post_id     int not null
)
    comment 'pivot for category hasMany posts';");


$db->exec("SET FOREIGN_KEY_CHECKS = 1;");

echo "Tables trancated... Start seeding\n";

$categories = ['Category1', 'Category2', 'Category3', 'Category4'];
$description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";
$text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit. Donec et mollis dolor. Praesent et diam eget libero egestas mattis sit amet vitae augue. Nam tincidunt congue enim, ut porta lorem lacinia consectetur. Donec ut libero sed arcu vehicula ultricies a non tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut gravida lorem. Ut turpis felis, pulvinar a semper sed, adipiscing id dolor.';
$categoryIds = [];

$catStmt = $db->prepare("INSERT INTO categories (title, description) VALUES (?, ?)");

foreach ($categories as $category) {
    $catStmt->execute([$category, $description]);
    $categoryIds[] = $db->lastInsertId();
}

echo "Categories done.\n";

$postSql = $db->prepare("
    INSERT INTO posts (image, title, description, text, views, created_at) 
    VALUES (:image, :title, :description, :text, :views, :date)
");

$postsId = [];
foreach ($categoryIds as $cid) {
    $numberOfPosts = rand(4, 12) * 3;
    for ($i = 1; $i <= $numberOfPosts; $i++) {
        $postSql->execute([
            'image'  => 'post' . rand(1, 3) . '.jpg',
            'title'   => "Post $i in Category $cid",
            'description' => "This is a short description for post number $i." . $description,
            'text' => "This is a full description for post number $i. " . $text,
            'views'   => rand(0, 1000),
            'date'    => date('Y-m-d H:i:s', strtotime("-" . rand(0, 30) . " days"))
        ]);

        $postsId[$cid][] = $db->lastInsertId();
    }
}

echo "Posts done.\n";

foreach ($postsId as $cid => $ids) {
    foreach ($ids as $pid) {
        $db->prepare("INSERT IGNORE INTO category_posts (category_id, post_id) VALUES (?, ?)")
            ->execute([$cid, $pid]);
    }
}

echo "Relation Category-Posts done.\n";