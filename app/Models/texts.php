<?php
namespace App\Models;
require_once __DIR__ . "./../Database/MysqlDatabase.php";

use App\Database\MysqlDatabase;

class texts
{

    public function createText($data)
    {
        return MysqlDatabase::insert('texts',$data);
    }

    public function getText($id)
    {
        return MysqlDatabase::get_first('texts','id',$id);
    }

    public function updateText($data,$id)
    {
        return MysqlDatabase::update('texts',$data,$id);
    }
}