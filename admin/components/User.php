<?php 

// use admin\libraries\Model;
require_once "libraries/Model.php";

class User extends Model
{
    public $table = "users";
    public $db_table_fields = ['id','username','password','first_name','last_name','role'];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $role;
    public $key = "mock_project";

    public function verify_user($username, $password)
    {
        $username = $this->escape_string($username);
        $password = $this->escape_string(md5($this->key).md5($password));

        $sql = "SELECT * FROM " .$this->table. " WHERE ";
        $sql .= "username = '$username' ";
        $sql .= "AND password = '$password' ";
        $sql .= "LIMIT 1";

        $query = $this->query($sql);
        while($row = $query->fetch_assoc()){
            $data[] = $row;
        }
        if(empty($data)){
            return false;
        }
        return $data[0];
    }

    public function delete_user()
    {
        return $this->delete();
    }
}
$user = new User;