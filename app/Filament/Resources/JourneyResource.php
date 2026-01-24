<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JourneyResource\Pages;
use App\Filament\Resources\JourneyResource\RelationManagers;
use App\Models\Journey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JourneyResource extends Resource
{
    protected static ?string $model = Journey::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Mon Parcours';


    public static function form(Form $form): Form {
        return $form->schema([
            Forms\Components\TextInput::make('year')->required()->numeric(),
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Select::make('icon')
                ->options([
                    'star' => 'Étoile (Marquant)',
                    'briefcase' => 'Travail',
                    'academic-cap' => 'Études',
                    'trophy' => 'Récompense',
                ])->default('star'),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
            Forms\Components\TextInput::make('order')->numeric()->default(0),
        ]);
    }
    
    public static function table(Table $table): Table {
        return $table->columns([
            Tables\Columns\TextColumn::make('year')->sortable()->weight('bold'),
            Tables\Columns\TextColumn::make('title'),
            Tables\Columns\TextColumn::make('icon'),
        ])->defaultSort('year', 'desc'); // Du plus récent au plus vieux
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJourneys::route('/'),
            'create' => Pages\CreateJourney::route('/create'),
            'edit' => Pages\EditJourney::route('/{record}/edit'),
        ];
    }
}
