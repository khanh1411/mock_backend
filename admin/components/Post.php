<?php 
require_once "libraries/Model.php";

class Post extends Model
{
    public $table = "posts";
    public $db_table_fields = ['id','title','content','image_url','category_id','public_time'];
    public $id;
    public $title;
    public $content;
    public $image_url;
    public $category_id;
    public $public_time;

    public $tmp_path;
    public $upload_directory = "images";
    public $errors = [];
    public $image_empty = "http://placehold.it/200x200&text=image";
    
    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "there was no fle uploaded here";
            return false;
        } else if ($file['error'] != 0) {
            return false;
        } else {
            $this->image_url = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
        }
    }

    public function save_image()
    {
        if($this->id){
            $this->update();
        } else {
            if(!empty($this->errors)){ // kiểm tra nếu mảng errors có giá trị thì return luôn. EMPTY va ISSET khac nhau nha.
                return false;
            }
            
            if(empty($this->image_url) || empty($this->tmp_path)){
                $this->errors[] = "the file was not available";
                return false;
            }
    
            $target_path = SITE_ROOT.DS.$this->upload_directory.DS.$this->image_url;
            // echo $target_path; die;
            if(file_exists($target_path)){ //check file existed
                $this->errors[] = "the file $this->filename already exists";
                return false;
            }
    
            if(move_uploaded_file($this->tmp_path, $target_path)){
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "the file directory probably does not have permission";
                return false;
            }
        }

        
       
    }

    public function image_path() // nếu bài post ko có ảnh thì in ra ảnh rỗng này
    { 
        return empty($this->image_url) ? $this->image_empty : $this->upload_directory.DS.$this->image_url; 
    }

    public function delete_post()
    {
        return $this->delete();
    }

    public function pagination()
    {
        $sp_tungtrang = 4;
        if(!isset($_GET['trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }
        $tung_trang = ($trang-1)*$sp_tungtrang;

        $sql = "SELECT * FROM posts ORDER BY id ASC LIMIT $tung_trang,$sp_tungtrang"; // bắt đầu với $tung_trang và có 4 bài post trong 1 trang
        $post_all = $this->the_query($sql);
        return $post_all; 
    }

}
