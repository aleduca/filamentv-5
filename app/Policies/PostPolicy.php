<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
	public function export(User $user)
	{
		return $user->roles === 'super-admin';
	}
}
