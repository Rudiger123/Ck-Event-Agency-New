<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMessage extends EditRecord
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // --- AJOUTER CETTE MÉTHODE ---
    public function mount(int | string $record): void
    {
        parent::mount($record); // On laisse Filament charger la page normalement

        // Si le message est "non lu", on le passe en "lu"
        if ($this->record->status === 'unread') {
            $this->record->update(['status' => 'read']);
            
            // On rafraîchit les données du formulaire pour que le sélecteur affiche "Lu"
            $this->fillForm();
        }
    }
}