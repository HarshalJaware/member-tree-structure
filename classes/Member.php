<?php
class Member {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    // Recursive function to build tree structure
    public function createTree($parentId = null) {
        $sql = "SELECT * FROM members WHERE parent_id " . ($parentId ? "= :pid" : "IS NULL");
        $stmt = $this->pdo->prepare($sql);
        if ($parentId) $stmt->bindValue(':pid', $parentId, PDO::PARAM_INT);
        $stmt->execute();
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$members) return '';

        $html = "<ul>";
        foreach ($members as $m) {
            $html .= "<li data-id='{$m['id']}'>{$m['name']}";
            $html .= $this->createTree($m['id']); // recursion
            $html .= "</li>";
        }
        $html .= "</ul>";
        return $html;
    }

    public function addMember($name, $parentId = null) {
        $stmt = $this->pdo->prepare("INSERT INTO members (name, parent_id) VALUES (:name, :pid)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':pid', $parentId ?: null, PDO::PARAM_INT);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function getAllMembers() {
        $stmt = $this->pdo->query("SELECT id, name FROM members ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
