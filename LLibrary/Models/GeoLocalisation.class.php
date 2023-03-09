<?php
namespace LLibrary\Models;
class GeoLocalisation extends DBFactory
{
	public function visitorRegister(\LLibrary\Entities\Visitor $visitor)
	{
		$maxTime = time() - (60 * 5);
		$sql1 = '
		INSERT INTO l_whosonline
		VALUES(:id, :ip, :page, :time)
		ON DUPLICATE KEY UPDATE online_id = :id, online_page = :page, 
		online_connectionTime = :time
		';
		$sql2 = '
		DELETE FROM l_whosonline
		WHERE online_connectionTime < :maxtime
		';
		$query = $this->db->prepare($sql1);
		$query->bindValue(':id', $visitor->id());
		$query->bindValue(':ip', $visitor->ip());
		$query->bindValue(':page', $visitor->page());
		$query->bindValue(':time', $visitor->connectionTime());
		//$query->execute() or die(print_r($db->errorInfo()));
		$query = $this->db->prepare($sql2);
		$query->bindValue(':maxtime', $maxTime, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
	}
	public function countVisitors()
	{
		$sql1 = '
		SELECT COUNT(*) AS visitorsNumber
		FROM l_whosonline
		';
		$query = $this->db->prepare($sql1);
		$query->execute() or die(print_r($db->errorInfo()));
		$counter = $query->fetch(\PDO::FETCH_ASSOC);
		return new \LLibrary\Entities\Visitor(array(
		'visitorsNumber' => $counter['visitorsNumber']
		));
	}
	public function countMembers($x=0)
	{
		$sql1 = '
		SELECT COUNT(*) AS membersNumber
		FROM l_whosonline
		WHERE online_id <> :n
		';
		$query = $this->db->prepare($sql1);
		$query->bindValue(':n', (int) $x, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$counter = $query->fetch(\PDO::FETCH_ASSOC);
		return new \LLibrary\Entities\Visitor(array(
		'membersNumber' => $counter['membersNumber']
		));
	}
	public function countNoMembers($x=0)
	{
		$sql1 = '
		SELECT COUNT(*) AS noMembersNumber
		FROM l_whosonline
		WHERE online_id = :n
		';
		$query = $this->db->prepare($sql1);
		$query->bindValue(':n', (int) $x, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$counter = $query->fetch(\PDO::FETCH_ASSOC);
		return new \LLibrary\Entities\Visitor(array(
		'noMembersNumber' => $counter['noMembersNumber']
		));
	}
	public function nowPageVisitors($pageTitle)
	{
		$sql1 = '
		SELECT COUNT(*) AS page
		FROM l_whosonline
		WHERE online_page = :p
		';
		$query = $this->db->prepare($sql1);
		$query->bindValue(':p', $pageTitle, \PDO::PARAM_STR);
		$query->execute() or die(print_r($db->errorInfo()));
		$counter = $query->fetch(\PDO::FETCH_ASSOC);
		return new \LLibrary\Entities\Visitor(array(
		'page' => $counter['page']
		));
	}
	public function whosOnline($id)
	{
		$sql = '
		SELECT online_id id, online_ip ip, user_pseudo pseudo
		FROM l_whosonline
		INNER JOIN l_users ON l_whosonline.online_id = l_users.user_id
		WHERE online_id = :id
		';
		$query = $this->db->prepare($sql);
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->execute() or die(print_r($db->errorInfo()));
		$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
		'\LLibrary\Entities\Visitor');
		$whosOnline = $query->fetchAll();
		return $whosOnline;
	}
}