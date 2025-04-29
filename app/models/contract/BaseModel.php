<?php

namespace App\Models\Contract;
abstract class BaseModel implements CRUDinterface
{
    protected $attrs = [];
    protected $table;
    protected $pageSize = 10;
    protected $primaryKey = "id";
    protected $curPage = 1;
    protected $lastPage;

    public function getAttrs()
    {
        return $this->attrs;
    }
    public function getAttr($key)
    {
        return $this->attrs[$key];
    }

    public function setAttrs($key, $value)
    {
        $this->attrs[$key] = $value;

    }
    public function __get($name)
    {
        return $this->attrs[$name];
    }
    public function __set($name, $value)
    {
        $this->attrs[$name] = $value;
    }
}