<?php

namespace App\Filament\Resources\Albums\Schemas;

use Asmit\FilamentUpload\Forms\Components\AdvancedFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Album')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                        ->columnSpan(1),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(false)
                            ->inline(false)
                        ->columnSpan(1),

                        AdvancedFileUpload::make('photos')
                            ->label('Fotos')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->directory('albums/photos')
                            ->visibility('public')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
