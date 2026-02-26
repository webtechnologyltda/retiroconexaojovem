<?php

namespace App\Filament\Resources\Participants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ParticipantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),

                ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),

                TextColumn::make('full_name')
                    ->label('Nome Completo'),

                TextColumn::make('cpf')
                    ->label('CPF'),

                TextColumn::make('birth_date')
                    ->label('Data de Nascimento')
                    ->date('d/m/Y'),

                TextColumn::make('sex')
                    ->label('Sexo')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'male' => 'Masculino',
                        'female' => 'Feminino',
                        default => '-',
                    }),

                TextColumn::make('community')
                    ->label('Comunidade')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->recordActions([
                EditAction::make('edit')
                    ->label('Editar'),
            ])
            ->toolbarActions([
            ])
            ->defaultSort('id', 'desc');
    }
}
