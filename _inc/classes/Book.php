<?php

class Book {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function index() {
        $stmt = $this->db->prepare("SELECT * FROM ebooks");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title, $author, $price) {
        $stmt = $this->db->prepare("INSERT INTO ebooks (title, author, price) VALUES (:title, :author, :price)");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function show($id) {
        $stmt = $this->db->prepare("SELECT * FROM ebooks WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function edit($id, $title, $author, $price) {
        $stmt = $this->db->prepare("UPDATE ebooks SET title = :title, author = :author, price = :price WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function destroy($id) {
        $stmt = $this->db->prepare("DELETE FROM ebooks WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>