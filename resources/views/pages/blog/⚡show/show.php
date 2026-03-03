<?php

use Livewire\Component;
use App\Models\Post;

new class extends Component {
	public Post $post;

	public function render()
	{
		return $this->view()->layout('layouts::blog')->title('Post - ' . $this->post->slug);
	}
};
