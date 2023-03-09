<?php
namespace LLibrary\Entities
{
	class Modo extends Member
	{
		protected $pseudo2,
		$modoEmail;
		public function banish(Member $member)
		{
			$member->setRights(self::BANISHED);
		}
		//Reinsérer un membre
		public function reins(User $user)
		{
			$user->setRights(self::MEMBER);
		}
	}
}