<?php
namespace LLibrary\Interfaces;
interface iUser extends iCommon
{
	const BANISHED   = 0;
	const VISITOR    = 1;
	const MEMBER     = 2;
	const MODO       = 3;
	const OWNER      = 4;
	const ADMIN      = 5;
	const ALL_RIGHTS = 6;
}