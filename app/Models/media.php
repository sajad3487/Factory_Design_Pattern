<?php
namespace App\Models;
require_once __DIR__ . "./../Database/MysqlDatabase.php";

use App\Database\MysqlDatabase;

class media
{
    public function createMedia($data)
    {
        return MysqlDatabase::insert('media',$data);
    }

    public function getMedia($id)
    {
        return MysqlDatabase::get_first('media','id',$id);
    }

    public function updateMedia($data,$id)
    {
        return MysqlDatabase::update('media',$data,$id);
    }
}