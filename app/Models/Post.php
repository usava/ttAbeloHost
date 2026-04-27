<?php

namespace App\Models;

use PDO;

class Post extends Model
{
    public int $id {
        get => $this->id;
    }
    public string $image {
        get {
            return $this->image;
        }
        set {
            $this->image = $value;
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
    public string $text {
        get {
            return $this->text;
        }
        set {
            $this->text = $value;
        }
    }
    public string $views {
        get {
            return $this->views;
        }
        set {
            $this->views = $value;
        }
    }

    public string $created_at {
        get {
            return $this->created_at;
        }
        set {
            $this->created_at = $value;
        }
    }

    public function get(int $id)
    {
        $hSql = $this->db()->prepare("SELECT * FROM posts WHERE id = :id");
        $hSql->setFetchMode(PDO::FETCH_CLASS, Post::class);
        $hSql->execute([':id' => $id]);
        return $hSql->fetch();
    }

    public function getPosts(array $filter = [])
    {
        $prepare[':limit'] = isset($filter['limit']) ? (int) $filter['limit'] : 10;

        $join = $where = '';
        if(isset($filter['categoryId'])) {
            $join = "LEFT JOIN category_posts AS cp ON p.id = cp.post_id";
            $where = "AND cp.category_id = :category_id";
            $prepare[':category_id'] = $this->id;
        }

        $sql = $this->db()->prepare("
            SELECT * FROM posts AS p 
            $join
            WHERE 1  $where
            ORDER BY p.id DESC
            LIMIT :limit");

        $sql->execute($prepare);

        return $sql->fetchAll();
    }

    public function getCategory(): Category
    {
        $sql = $this->db()->prepare("
            SELECT category_id FROM category_posts AS cp
            WHERE post_id = :post_id LIMIT 1");
        $sql->execute([':post_id' => $this->id]);
        $cid = (int) $sql->fetch(PDO::FETCH_NUM)[0];
        return new Category()->get($cid);
    }
}