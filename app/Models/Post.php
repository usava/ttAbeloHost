<?php

namespace App\Models;

class Post extends Model
{
    private int $id {
        get => $this->id;
    }
    private string $image {
        get {
            return $this->image;
        }
        set {
            $this->image = $value;
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
    private string $text {
        get {
            return $this->text;
        }
        set {
            $this->text = $value;
        }
    }
    private string $views {
        get {
            return $this->views;
        }
        set {
            $this->views = $value;
        }
    }

    public function getPost(int $id)
    {
        $hSql = $this->db()->prepare("SELECT * FROM posts WHERE id = :id");
        $hSql->execute([':id' => $id]);
        return $hSql->fetch();
    }

}