<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Filament\Forms\Components\TinyEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\ToolbarButtonGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Select::make('user_id')
					->relationship('user', 'name')
					->required(),
				Select::make('category_id')
				->relationship('category', 'name')
				->required(),
				TextInput::make('title')
				->live(onBlur:true)
				->afterStateUpdated(function (Set $set, $state) {
					$set('slug', Str::slug($state));
				})
					->required(),
				TextInput::make('slug')
					->readonly()
					->unique('posts', 'slug', ignoreRecord:true)
					->required(),
				// RichEditor::make('content')
				// ->toolbarButtons([
				// 	['bold', 'italic', 'underline', 'highlight'],
				// 	['textColor', 'attachFiles'], [ToolbarButtonGroup::make('Paragraph', ['paragraph', 'h1', 'h2', 'h3'])],
				// 	[ToolbarButtonGroup::make('Alignment', ['alignStart', 'alignCenter', 'alignEnd', 'alignJustify'])],
				// 	['codeBlock', 'bulletList', 'orderedList'],
				// 	['undo', 'redo'],
				// ])
				// ->resizableImages()
				// ->fileAttachmentsDisk('public')
				// ->fileAttachmentsDirectory('attachments')
				// ->fileAttachmentsVisibility('public')
				// 			->textColors([
				// 				'#ef4444' => 'Red',
				// 				'#10b981' => 'Green',
				// 				'#0ea5e9' => 'Sky',
				// 			])
				// // ->floatingToolbars([
				// // 	'paragraph' => [
				// // 		'bold', 'italic', 'underline', 'strike', 'subscript', 'superscript',
				// // 	],
				// // 	'heading' => [
				// // 		'h1', 'h2', 'h3',
				// // 	],
				// // 	'table' => [
				// // 		'tableAddColumnBefore', 'tableAddColumnAfter', 'tableDeleteColumn',
				// // 		'tableAddRowBefore', 'tableAddRowAfter', 'tableDeleteRow',
				// // 		'tableMergeCells', 'tableSplitCell',
				// // 		'tableToggleHeaderRow', 'tableToggleHeaderCell',
				// // 		'tableDelete',
				// // 	],
				// // ])
				// 	->extraAttributes([
				// 		'style' => 'min-height: 300px',
				// 	])
				TinyEditor::make('content')
				->required()
				->columnSpanFull(),
				Toggle::make('published')
					->required(),
			]);
	}
}
