<?php
    require_once '../autoload.php';
    
    $member = new Member();
    echo $member->createTree();
?>