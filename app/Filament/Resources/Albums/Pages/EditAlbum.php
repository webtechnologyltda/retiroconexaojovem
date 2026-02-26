<?php

namespace App\Filament\Resources\Albums\Pages;

use App\Filament\Resources\Albums\AlbumResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAlbum extends EditRecord
{
    protected static string $resource = AlbumResource::class;
    protected function getCreateFormActionLabel(): string
    {
        return 'Salvar';
    }

    protected function getCancelFormActionLabel(): string
    {
        return 'Cancelar';
    }
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make('delete')->label('Excluir Álbum'),
            CreateAction::make( 'create')->label('Criar Novo Álbum'),
        ];
    }
}
