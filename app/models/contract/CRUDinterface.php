<?php
namespace App\Models\Contract;

interface CRUDinterface{
    public function insert($data):int;
    public function delete($where):int;
    public function update($newData , $where):int;
    public function get($where):object;
}