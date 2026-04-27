<?php

namespace App\Models;

use App\Models\Model;

class Category extends Model
{
    private int $id {
        get {
            return $this->id;
        }
    }
    private string $title {
        get {
            return $this->title;
        }
        set {
            $this->title = $value;
        }
    }
    private string $description {
        get {
            return $this->description;
        }
        set {
            $this->description = $value;
        }
    }

    public function getPosts(int $limit = 100)
    {
        return $this->db()->query("
            SELECT * FROM posts AS p 
                LEFT JOIN category_posts AS cp ON p.id = cp.post_id
                WHERE cp.category_id = :category_id
                ORDER BY p.id DESC
                LIMIT :limit",
            [':category_id' => $this->id, ':limit' => $limit]);
    }
}