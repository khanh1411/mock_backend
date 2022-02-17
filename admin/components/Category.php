<?php 

require_once "libraries/Model.php";

class Category extends Model
{
    public $table = "categories";
    public $db_table_fields = ['id','name'];
    public $id;
    public $name;

}
