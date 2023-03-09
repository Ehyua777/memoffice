<?php
namespace LLibrary\Models;
class ModoManager extends UserManager
{
	public function rightsManager(\LLibrary\Entities\User $member)
    {
		$sql='
		UPDATE l_users
		SET user_rights = :rights
		WHERE user_email = :email
		';
		$query=$this->db->prepare($sql);
		$query->bindValue(':rights', $member->rights());
		$query->bindValue(':email' , $member->email());
		$query->execute() or die(print_r($db->errorInfo()));
	}
}