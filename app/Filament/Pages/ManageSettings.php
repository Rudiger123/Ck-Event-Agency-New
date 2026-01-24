<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\Setting;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Paramètres Généraux';
    protected static ?string $navigationGroup = 'Administration';
    protected static string $view = 'filament.pages.manage-settings';

    // Les données du formulaire
    public ?array $data = [];

    public function mount(): void
    {
        // Au chargement, on remplit le formulaire avec les valeurs de la BDD
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Coordonnées de l\'Agence')
                    ->description('Ces informations s\'afficheront dans le pied de page et la page contact.')
                    ->schema([
                        Forms\Components\TextInput::make('site_email')
                            ->label('Email de contact')
                            ->email()
                            ->required(),
                        
                        Forms\Components\TextInput::make('site_phone')
                            ->label('Numéro de téléphone')
                            ->required(),

                        Forms\Components\Textarea::make('site_address')
                            ->label('Adresse physique')
                            ->rows(2),
                    ])->columns(2),

                Forms\Components\Section::make('Réseaux Sociaux')
                    ->description('Laissez vide pour ne pas afficher l\'icône.')
                    ->schema([
                        Forms\Components\TextInput::make('url_facebook')
                            ->label('Lien Facebook')
                            ->url()
                            ->prefix('https://'),
                        
                        Forms\Components\TextInput::make('url_instagram')
                            ->label('Lien Instagram')
                            ->url()
                            ->prefix('https://'),

                        Forms\Components\TextInput::make('url_linkedin')
                            ->label('Lien LinkedIn')
                            ->url()
                            ->prefix('https://'),
                            
                        Forms\Components\TextInput::make('url_whatsapp')
                            ->label('Numéro WhatsApp Business')
                            ->helperText('Format international sans le + (ex: 237699000000)'),
                    ])->columns(2),
            ])
            ->statePath('data');
    } 

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Enregistrer les modifications')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // On sauvegarde chaque champ dans la table settings
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make() 
            ->success()
            ->title('Paramètres enregistrés')
            ->send();
    }
}