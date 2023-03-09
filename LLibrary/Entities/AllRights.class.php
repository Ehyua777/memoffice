<?php
namespace LLibrary\Entities;
class AllRights extends Admin
{
	public function addAmin(Modo $moderator)
	{
		$moderator->setRights(self::ADMIN);
	}
}