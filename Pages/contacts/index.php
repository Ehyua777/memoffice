<?php
$pageTitle='Contacts';
require ('../../LLibrary/lumbrera.required.php');
$subjectManager = new LLibrary\Models\BlogSubjectManager($db);
$commentManager = new LLibrary\Models\BlogCommentManager($db);
include('../../Templates/layout.php');
?>