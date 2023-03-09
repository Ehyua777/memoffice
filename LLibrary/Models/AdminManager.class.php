<?php
namespace LLibrary\Models;
class AdminManager extends ModoManager
{
	public function setModoList($debut = -1, $limite = -1)
	{
		try
		{
			$sql='
			SELECT sm_id smID, member_id memberID, member_rollCode rollCode, 
			member_heading heading, member_speciality speciality, promoter_id promoter, 
			user_pseudo memberPseudo
			FROM l_staff_members
			INNER JOIN l_users ON l_staff_members.member_id = l_users.user_id
			';
			if ($debut != -1 || $limite != -1)
			{
				$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
			}
			$query = $this->db->query($sql);
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Admin');
			$modoList = $query->fetchAll();
			return $modoList;
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
	public function addAModo(\LLibrary\Entities\Member $member)
	{
		try
		{
			$sql='
			INSERT INTO l_staff_members (member_id, member_rollCode, member_heading, 
			member_speciality, promoter_id)
			VALUES (:member, :rollCode, :heading, :speciality, :promoter)
			';
			$query = $this->db->prepare($sql);
			$query->bindValue(':member', $member->id());
			$query->bindValue(':rollCode', $member->roll());
			$query->bindValue(':heading', $member->heading());
			$query->bindValue(':function', $member->speciality());
			$query->bindValue(':function', $member->promoter());
			$query->execute() or die(print_r($db->errorInfo()));
		}
		catch (\Exception $err)
		{
			die ('error['.$err->getCode().'] '.$err->getMessage());
		}
	}
}