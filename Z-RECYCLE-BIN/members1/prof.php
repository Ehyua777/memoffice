<div id="post">
<?php
$member = isset($_GET['m'])?(int) $_GET['m']:'';
$quero=$db->prepare('
SELECT member_id, member_pseudo, gr_members_info.info_name
FROM gr_members
INNER JOIN gr_members_info ON gr_members_info.member_id=gr_members.member_id
WHERE member_id=:member
');
$quero->bindValue(':member', $member, PDO::PARAM_INT);
$quero->execute();
$data=$quero->fetch();
echo $data['member_pseudo'];
echo '<br>--';
echo $data['info_name'];
$quero->CloseCursor();
?>
</div>