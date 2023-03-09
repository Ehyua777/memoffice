<?php
$pageTitle='Blog';
require ('../../LLibrary/lumbrera.required.php');
$commentManager = new LLibrary\Models\BlogCommentManager($db);
$subjectManager = new LLibrary\Models\BlogSubjectManager($db);
include('../../Templates/layout.php');
?>