<?php

namespace App\Filament\Resources\Users\Tables\Actions;

use App\Mail\AdminContactMail;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Mail;

class EmailAction
{
	public static function make()
	{
		return Action::make('email')
					->label('E-mail')
					->icon(Heroicon::Envelope)
					->modalIcon(Heroicon::EnvelopeOpen)
					->modalHeading(function ($record) {
						return 'Send e-email to ' . $record->name;
					})
					->modalDescription('Send e-mail to user')
					// ->modalSubmitActionLabel('Send e-mail')
					// ->modalCancelActionLabel('Do not send e-mail')
					->modalFooterActions(function ($action) {
						return [
							$action->getModalSubmitAction()->label('Send e-mail'),
							$action->getModalCancelAction()->color('danger')->label('Do not send e-mail'),
						];
					})
					->slideOver()
					->action(function ($data, $record) {
						try {
							Mail::to($record->email)->send(new AdminContactMail(
								subject: $data['subject'],
								body: $data['body']
							));

							Notification::make()->success()->title('Email sent')->send();
						} catch (\Throwable $th) {
							Notification::make()->danger()->title('Email not sent')->send();
							dd($th->getMessage());
						}

						// $action->halt();
					})
					->schema([
						TextInput::make('subject')->required()->minLength(5),
						RichEditor::make('body')->minLength(10)->required()->extraInputAttributes(['style' => 'min-height: 10rem; max-height: 10vh; overflow-y: auto;']),
					]);
		// ->closeModalByClickingAway(false)
		// ->closeModalByEscaping(false),
	}
}
