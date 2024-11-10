<?php

namespace Core\DB;

require_once __DIR__ . "/../../vendor/autoload.php";

use PDO;

class QueryBuilder {

    protected PDO $pdo;
    protected $table;
    protected $model;
    protected $condition=1;

    public function __construct() {
        $this->pdo = Connection::getConnection();
    }

    public function execute($sql) {
        return $this->pdo->query($sql);
    }

    public function setTable($table) {
        $this->table = $table;
        return $this;
    }

    public function setModel($model) {
        $this->model = $model;
        return $this;
    }

    public function where($condition) {
        $this->condition = $condition;
        return $this;
    }

    public function whereIn($column, $condition) {
        $this->condition = $condition == "" ? 0 : "`$column` IN ($condition)";
        return $this;
    }

    public function insert($names){
        $this->pdo->query("INSERT INTO `{$this->table}` SET $names");
        $this->reset();
        return $this->pdo->lastInsertId();
    }

    public function get(){
        if ($this->condition == "()")
            $result = [];
        else
            $result = $this->pdo->query("SELECT * FROM `{$this->table}` WHERE {$this->condition}")->fetchAll(PDO::FETCH_CLASS, $this->model);
        $this->reset();
        return $result;
    }

    public function all(){
        if ($this->condition == "()")
            $result = [];
        else
            $result = $this->pdo->query("SELECT * FROM `{$this->table}` WHERE {$this->condition}")->fetchAll(PDO::FETCH_CLASS, $this->model);
        $this->reset();
        return $result;
    }

    public function first(){
        $result = $this->pdo->query("SELECT * FROM `{$this->table}` WHERE {$this->condition} LIMIT 1")->fetchAll(PDO::FETCH_CLASS, $this->model)[0] ?? null;
        $this->reset();
        return $result;
    }

    public function find($id){
        $result = $this->pdo->query("SELECT * FROM `{$this->table}` WHERE `id` = $id")->fetchAll(PDO::FETCH_CLASS, $this->model)[0] ?? null;
        $this->reset();
        return $result;
    }

    public function count(){
        if ($this->condition == "()")
            $result = 0;
        else
            $result = $this->pdo->query("SELECT COUNT(*) AS cnt FROM `{$this->table}` WHERE {$this->condition}")->fetch(PDO::FETCH_ASSOC)['cnt'];
        $this->reset();
        return $result;
    }

    public function latest($limit=5) {
        if ($this->condition == "()")
            $result = [];
        else
            $result = $this->pdo->query("SELECT * FROM `{$this->table}` WHERE {$this->condition} ORDER BY 'created_at' DESC LIMIT {$limit}")->fetchAll(PDO::FETCH_CLASS, $this->model);
        $this->reset();
        return $result;
    }

    public function delete(){
        $result = $this->pdo->query("DELETE FROM `{$this->table}` WHERE {$this->condition}")->rowCount();
        $this->reset();
        return $result;
    }

    public function update($data){
        $result = $this->pdo->query("UPDATE `{$this->table}` SET $data WHERE {$this->condition}");
        $this->reset();
        return $result;
    }

    protected function reset() {
        $this->table = null;
        $this->model = null;
        $this->condition = 1;
    }
}
