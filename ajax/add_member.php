<?php
    require_once '../autoload.php';

    if (!empty($_POST['name'])) {
        $member = new Member();

        //removed white space
        $name = trim($_POST['name']);
        $parent = $_POST['parent_id'] ?: null;

        $id = $member->addMember($name, $parent);

        echo json_encode(['status' => 'success', 'id' => $id, 'name' => htmlspecialchars($name)]);
    } else {
        echo json_encode(['status' => 'error']);
    }
?>