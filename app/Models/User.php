<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Avatar;
use App\Models\Post;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
	/** @use HasFactory<\Database\Factories\UserFactory> */
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var list<string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'age',
		'gender',
		'is_admin',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var list<string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
			'is_admin' => 'boolean',
		];
	}

	public function canAccessPanel(Panel $panel): bool
	{
		return $this->is_admin && $this->hasVerifiedEmail();
	}

	public function getFilamentAvatarUrl(): ?string
	{
		if ($path = $this->avatar?->path) {
			return $path;
		}

		return asset('images/no-avatar.png');
	}

	public function posts():HasMany
	{
		return $this->hasMany(Post::class);
	}

	public function avatar():HasOne
	{
		return $this->hasOne(Avatar::class);
	}
}
