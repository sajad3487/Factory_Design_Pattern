<?php

namespace App\Models;
require_once __DIR__ . "./../Database/MysqlDatabase.php";

use App\Database\MysqlDatabase;

class polls
{
    public function createPoll($data)
    {
        return MysqlDatabase::insert('polls',$data);
    }

    public function getPoll($id)
    {
        return MysqlDatabase::get_first('polls','id',$id);
    }

    public function updatePoll($data,$id)
    {
        return MysqlDatabase::update('polls',$data,$id);
    }
}