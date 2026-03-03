<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

new #[Title('Blog')] class extends Component {
	use WithPagination;

	#[Url(as: 'q')]
	public string $searched = '';

	protected string $paginationTheme = 'tailwind-light';

	// public function paginationView()
	// {
	// 	return 'vendor.livewire.tailwind-light';
	// }

	public function search()
	{
		$this->resetPage();
	}

	#[Computed()]
	public function posts()
	{
		return Post::where('title', 'like', '%' . $this->searched . '%')
			->with('user')
			->paginate(10);
	}

	public function render()
	{
		return $this->view()->layout('layouts::blog');
	}
};
