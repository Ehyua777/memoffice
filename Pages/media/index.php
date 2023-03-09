<?php
$pageTitle='Media+';
require ('../../LLibrary/lumbrera.required.php');
$videoManager = new LLibrary\Models\VideoManager($db);
$videoCommentManager = new LLibrary\Models\VideoCommentManager($db);
include('../../Templates/layout.php');
?>