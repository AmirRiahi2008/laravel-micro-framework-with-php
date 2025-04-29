<?php
namespace App\Models\Contract;

use Medoo\Medoo;
use PDOException;
class MySqlBaseModel extends BaseModel
{
    private $connection;
    public function __construct($id = null)
    {
        try {
            $this->connection = new Medoo(
                [
                    'type' => 'mysql',
                    'host' => $_ENV["HOST"],
                    'database' => $_ENV["DB"],
                    'username' => $_ENV["USER"],
                    'password' => $_ENV["PASS"],


                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_general_ci',
                    'port' => 3306,

                    'logging' => true,

                    'error' => \PDO::ERRMODE_SILENT,
                    'option' => [
                        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
                    ],

                    'command' => [
                        'SET SQL_MODE=ANSI_QUOTES'
                    ]
                ]
            );

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if (!is_null($id))
            $this->find($id);
    }

    public function insert($data): int
    {
        $this->connection->insert($this->table, $data);
        return (int) $this->connection->id();
    }
    public function delete($where): int
    {
        $this->connection->delete($this->table, $where);
        return (int) $this->connection->id();
    }
    public function update($newData, $where): int
    {
        $this->connection->update($this->table, $newData, $where);
        return (int) $this->connection->id();
    }
    public function get($where): object
    {
        $this->curPage = isset($_GET["page"]) && is_numeric($_GET["page"]) ? $_GET["page"] : 1;
        $this->lastPage = (round($this->countAll() / $this->pageSize));
        if ($this->curPage > $this->lastPage) {
            $this->curPage = $this->lastPage;
        }
        $start = ($this->curPage - 1) * $this->pageSize;
        $where['LIMIT'] = [$start, $this->pageSize];

        return $this->connection->select($this->table, ["*"], $where);
    }
    public function countAll(): int
    {
        return $this->connection->count($this->table) ?? 0;
    }

    public function find($id)
    {
        $res = $this->connection->get($this->table, "*", [$this->primaryKey => $id]);
        if (is_null($res)) {
            return (object) null;
        }

        foreach ($res as $key => $value) {
            $this->setAttrs($key, $value);
        }
        return $this;
    }

    public function save()
    {
        $recordId = $this->{$this->primaryKey};
        $this->update($this->attrs, [$this->primaryKey => $recordId]);
        return $this;
    }
}