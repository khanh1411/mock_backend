<?php

use admin\libraries\Database;

// require_once "libraries/Database.php";

class Model extends Database
{
    public $connect;
    public $table;
    public $db_table_fields;

    public function __construct()
    {
        $db = new Database;
        $this->connect = $db->connection;
    }
    public function query($sql)
    {
        $result = $this->connect->query($sql);

        $this->confirm_query($result);

        return $result; 
    }

    private function confirm_query($result)
    {
        if(!$result){
            die("query failed".$this->connect->error);
        }
    }

    public function escape_string($string) // có thể thêm những trường có ký tự đặc biệt như dấu ', ví dụ: name = " 'home 123 ";
    {
        $escaped_string = $this->connect->real_escape_string($string);
        return $escaped_string;
    }

    public function the_insert_id() // lấy id cuối cùng, dùng để auto thêm id
    {
        return $this->connect->insert_id;
    }

    public function find_all()
    {
        $query = $this->query("SELECT * FROM ".$this->table." ");
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        // echo "<pre>";
        // print_r($data); die;
        return $data;
    }

    public function create()
    {
        $properties = $this->clean_properties();
        // echo "<pre>";
        // print_r($properties); die;
        $values = implode("','",array_values($properties)); // chú ý: ',' khác dấu ,
        // var_dump($values); die;

        $sql = "INSERT INTO ".$this->table." (".implode(",",array_keys($properties)).")"; // implode => chuyển arr sang string, ngăn cách by dấu ","
        $sql .= "VALUES ('".$values."')";
        // echo $sql; die;
        
        if($this->query($sql)){
            $this->id = $this->the_insert_id(); // trả về id được chèn cuối cùng của bảng
            return true;
        } else {
            return false;
        }
    }

    public function clean_properties()
    {
        $clean_properties = [];
        foreach($this->properties() as $key => $value){
            $clean_properties[$key] = $this->escape_string($value); // trả về chính mảng đó thôi nhưng mà clean $value

        }
        return $clean_properties;
    }

    public function properties()
    {
        $properties = [];

        foreach($this->db_table_fields as $db_field){
            if(property_exists($this, $db_field)){ // ví dụ: kiểm tra thuộc tính username của cái mảng db_table_fields có trong các thuộc tính của class user không.
                $properties[$db_field] = $this->$db_field; // => rat hay nha, ví dụ: array([username] => username, [password] => password) trong đó username value chính là $_POST['username']
            }
        }
        // echo "<pre>";
        // print_r($properties); die;
        return $properties;
    }

    public function update()
    {
        $properties = $this->clean_properties();
        $properties_pairs = [];

        foreach($properties as $key => $value){
            $properties_pairs[] = "$key = '$value' ";
        }
        // echo "<pre>";
        // print_r($properties_pairs); die;

        $sql = "UPDATE ".$this->table." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= ".$this->escape_string($this->id);

        // echo $sql; die();
        $this->query($sql);
    }

    public function delete()
    {
        $sql = "DELETE FROM ".$this->table." WHERE id =".$this->escape_string($this->id);
        $sql .= " LIMIT 1"; // nhớ thêm space trước limit
        // echo $sql; die();
        
        $this->query($sql);
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function find_by_id($id)
    {
        $query = $this->the_query("SELECT * FROM ".$this->table." WHERE id = $id");
        // print_r(array_shift($query)); die;
        // while ($row = $query->fetch_assoc()) {
        //     $data[] = $row;
        // }
        // echo "<pre>";
        // print_r($data); die;
        // return $data;
        // return $query;
        return isset($query) ? array_shift($query) : false; // trả về item bị loại ra khỏi array
    }

    public function the_query($sql)
    {
        $query = $this->query($sql);
        $the_object_array = [];

        while($row = $query->fetch_array()){
            $the_object_array[] = $this->instantation($row);
        }
        return $the_object_array;
    }

    public function instantation($the_record)
    {
        $calling_class = get_called_class();
        $the_object = new $calling_class; // cach 2: $the_object = new Post;
        
        // print_r($the_object); die;

        // $the_object->id = $found_user['id'];
        // $the_object->title = $found_user['title'];
        // $the_object->content = $found_user['content'];

        foreach($the_record as $the_attribute => $value){
            if($the_object->has_the_attribute($the_attribute)){ // kiểm tra các key trong mảng $the_record có tồn tại trong $the_object không 
                // print_r($the_object); die;
                $the_object->$the_attribute = $value;
            }
        }

        // print_r($the_object); die;
        return $the_object;
    }

    public function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this); // lấy các thuộc tính của đối tượng
        // echo "<pre>";
        // print_r($object_properties); die;
        return array_key_exists($the_attribute, $object_properties);  // kiểm tra key $rowthe_attribute có tồn tại trong mảng $object_properties không
       
    }

}
