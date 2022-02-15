<?php
require_once "libraries/Model.php";

class Image extends Model
{
    public $table = "images";
    public $db_table_fields = ['id','name','filename','post_id','created_at'];
    public $id;
    public $name;
    public $post_id;
    public $created_at;

    public $filename;
    public $tmp_path;
    public $upload_directory = "images";
    public $errors = [];

    // passing $_FILES['uploaded_file'] as an argument
    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "there was no fle uploaded here";
            return false;
        } else if ($file['error'] != 0) {
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
        }
    }

    public function save()
    {
        if($this->id){
            $this->update();
        } else {
            if(!empty($this->errors)){ // kiểm tra nếu mảng errors có giá trị thì return luôn. EMPTY va ISSET khac nhau nha.
                return false;
            }
            
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "the file was not available";
                return false;
            }

            $target_path = SITE_ROOT.DS.$this->upload_directory.DS.$this->filename;
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
}
