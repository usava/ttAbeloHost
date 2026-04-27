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
        $prepare[':limit'] = isset($filter['limit']) ? (int) $filter['limit'] : 10;
        $prepare[':offset'] = isset($filter['page']) ? ((int) $filter['page'] - 1) * 10 : 0;
        $prepare[':category_id'] = $this->id;

        $orderBy = match($filter['sort']) {
            'views-desc' => 'p.views DESC',
            'views-asc' => 'p.views ASC',
            'created-desc' => 'p.created_at DESC',
            'created-asc' => 'p.created_at ASC',
            default => 'p.views DESC'
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
}