<?php 
require_once "libraries/Model.php";

class Post extends Model
{
    public $table = "posts";
    public $db_table_fields = ['id','title','content','type_id','created_at'];
    public $id;
    public $title;
    public $content;
    public $type_id;
    public $created_at;
    
    function getImage()
    {
        $sql = "SELECT i.filename
                FROM posts p
                INNER JOIN images i on i.post_id = p.id";
        $query = $this->query($sql);
        while($row = $query->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }

    public function delete_post()
    {
        return $this->delete();
    }

}
