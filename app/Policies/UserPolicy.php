<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
	public function delete(User $user, User $record)
	{
		$canDelete = $record->roles === 'user';

		if (!$canDelete) {
			return Response::deny('Can not delete this user');
		}

		return Response::allow();
	}

	public function bulkDelete(User $user, User $record)
	{
		return $record->roles === 'user';
	}
}
