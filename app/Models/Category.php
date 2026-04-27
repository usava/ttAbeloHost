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

    public function getPosts(int $limit = 100)
    {
        $sql = $this->db()->prepare("
            SELECT * FROM posts AS p 
                WHERE p.id IN (SELECT post_id FROM category_posts WHERE category_id = :category_id)
                ORDER BY p.id DESC
                LIMIT :limit");

        $sql->setFetchMode(PDO::FETCH_CLASS, Post::class);
        $sql->execute([':category_id' => $this->id, ':limit' => $limit]);
        return $sql->fetchAll();
    }
}