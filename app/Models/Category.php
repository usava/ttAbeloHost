<?php

namespace App\Models;

use PDO;

class Category extends Model
{
    public int $id {
        get {
            return $this->id;
        }
    }
    public string $title {
        get {
            return $this->title;
        }
        set {
            $this->title = $value;
        }
    }
    public string $description {
        get {
            return $this->description;
        }
        set {
            $this->description = $value;
        }
    }

    public function get(int $id)
    {
        $hSql = $this->db()->prepare("SELECT * FROM categories WHERE id = :id");
        $hSql->setFetchMode(PDO::FETCH_CLASS, Category::class);
        $hSql->execute([':id' => $id]);
        return $hSql->fetch();
    }

    public function getAll()
    {
        $hSql = $this->db()->query("SELECT * FROM categories");
        return $hSql->fetchAll(PDO::FETCH_CLASS, Category::class);
    }

    public function getPosts(array $filter)
    {
        $prepare[':limit'] = isset($filter['limit']) ? (int) $filter['limit'] : $_ENV['POSTS_PAGE_LIMIT'];
        $prepare[':offset'] = isset($filter['page']) ? ((int) $filter['page'] - 1) * $_ENV['POSTS_PAGE_LIMIT'] : 0;
        $prepare[':category_id'] = $this->id;

        $orderBy = match($filter['sort']) {
            'views-asc' => 'p.views ASC',
            'views-desc' => 'p.views DESC',
            'created-asc' => 'p.created_at ASC',
            default => 'p.created_at DESC'
        };

        $sql = $this->db()->prepare("
            SELECT * FROM posts AS p 
                WHERE p.id IN (SELECT post_id FROM category_posts WHERE category_id = :category_id)
                ORDER BY $orderBy
                LIMIT :limit OFFSET :offset");

        $sql->setFetchMode(PDO::FETCH_CLASS, Post::class);
        $sql->execute($prepare);
        return $sql->fetchAll();
    }

    public function getPostsCount(array $filter): int
    {
        $prepare[':category_id'] = $this->id;

        $sql = $this->db()->prepare("
            SELECT COUNT(p.id) FROM posts AS p
            LEFT JOIN category_posts AS cp ON p.id = cp.post_id
            WHERE category_id = :category_id
            ");
        $sql->execute($prepare);
        return (int) $sql->fetch(PDO::FETCH_NUM)[0];
    }
}