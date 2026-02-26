<?php

namespace App\Filament\Resources\Participants\Schemas;

use App\Models\ShirtSize;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ParticipantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados pessoais')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->disk('public')
                            ->directory('participants/photos')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),

                        TextInput::make('full_name')
                            ->label('Nome completo')
                            ->required()
                            ->maxLength(255),

                        DatePicker::make('birth_date')
                            ->label('Data de nascimento')
                            ->required()
                            ->native(false)
                            ->maxDate(now()),

                        Select::make('sex')
                            ->label('Sexo')
                            ->options([
                                'male' => 'Masculino',
                                'female' => 'Feminino',
                            ])
                            ->required(),

                        TextInput::make('cpf')
                            ->label('CPF')
                            ->required()
                            ->maxLength(14)
                            ->mask('999.999.999-99')
                            ->rule('regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/')
                            ->unique(ignoreRecord: true),

                        TextInput::make('community')
                            ->label('Comunidade')
                            ->maxLength(255),

                        Select::make('shirt_size_id')
                            ->relationship('shirtSize', 'label')
                            ->label('Tamanho camisa')
                            ->live()
                            ->searchable()
                            ->preload(),

                        TextInput::make('custom_shirt_size')
                            ->label('Outro tamanho de camisa')
                            ->maxLength(20)
                            ->visible(function (Get $get): bool {
                                $shirtSizeId = $get('shirt_size_id');

                                if (! $shirtSizeId) {
                                    return false;
                                }

                                return ShirtSize::query()
                                    ->whereKey($shirtSizeId)
                                    ->where('label', 'Other')
                                    ->exists();
                            })
                            ->required(function (Get $get): bool {
                                $shirtSizeId = $get('shirt_size_id');

                                if (! $shirtSizeId) {
                                    return false;
                                }

                                return ShirtSize::query()
                                    ->whereKey($shirtSizeId)
                                    ->where('label', 'Other')
                                    ->exists();
                            }),
                    ])
                    ->columns(3),

                Section::make('Endereco')
                    ->relationship('address')
                    ->schema([
                        TextInput::make('zip_code')
                            ->label('CEP')
                            ->required()
                            ->maxLength(20),

                        TextInput::make('street')
                            ->label('Rua')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('number')
                            ->label('Numero')
                            ->required()
                            ->maxLength(30),

                        TextInput::make('complement')
                            ->label('Complemento')
                            ->maxLength(255),

                        TextInput::make('district')
                            ->label('Bairro')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('city')
                            ->label('Cidade')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('state')
                            ->label('Estado')
                            ->required()
                            ->maxLength(10),
                    ])
                    ->columns(3),

                Section::make('Responsaveis')
                    ->schema([
                        Repeater::make('guardians')
                            ->relationship()
                            ->defaultItems(1)
                            ->minItems(1)
                            ->reorderableWithButtons()
                            ->addActionLabel('Adicionar responsavel')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nome do responsavel')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('priority')
                                    ->label('Prioridade')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(10),

                                Repeater::make('phones')
                                    ->label('Telefones')
                                    ->relationship()
                                    ->defaultItems(1)
                                    ->minItems(1)
                                    ->addActionLabel('Adicionar telefone')
                                    ->schema([
                                        TextInput::make('number')
                                            ->label('Numero de telefone')
                                            ->required()
                                            ->maxLength(30),

                                        Toggle::make('is_whatsapp')
                                            ->label('E WhatsApp?')
                                            ->default(false),
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),

                Section::make('Saude')
                    ->relationship('healthProfile')
                    ->schema([
                        Toggle::make('has_dietary_restrictions')
                            ->label('Possui restricoes alimentares?')
                            ->dehydrated(false)
                            ->live(),

                        Textarea::make('dietary_restrictions')
                            ->label('Restricoes alimentares')
                            ->rows(2)
                            ->required(fn (Get $get): bool => (bool) $get('has_dietary_restrictions'))
                            ->visible(fn (Get $get): bool => (bool) $get('has_dietary_restrictions'))
                            ->columnSpanFull(),

                        Toggle::make('has_medications')
                            ->label('Toma medicacoes?')
                            ->dehydrated(false)
                            ->live(),
                        Textarea::make('medications')
                            ->label('Medicacoes')
                            ->rows(2)
                            ->required(fn (Get $get): bool => (bool) $get('has_medications'))
                            ->visible(fn (Get $get): bool => (bool) $get('has_medications'))
                            ->columnSpanFull(),

                        Toggle::make('has_medication_frequency')
                            ->label('Informar frequencia das medicacoes?')
                            ->dehydrated(false)
                            ->live(),
                        Textarea::make('medication_frequency')
                            ->label('Frequencia das medicacoes')
                            ->rows(2)
                            ->required(fn (Get $get): bool => (bool) $get('has_medication_frequency'))
                            ->visible(fn (Get $get): bool => (bool) $get('has_medication_frequency'))
                            ->columnSpanFull(),

                        Toggle::make('has_allergies')
                            ->label('Possui alergias?')
                            ->dehydrated(false)
                            ->live(),
                        Textarea::make('allergies')
                            ->label('Alergias')
                            ->rows(2)
                            ->required(fn (Get $get): bool => (bool) $get('has_allergies'))
                            ->visible(fn (Get $get): bool => (bool) $get('has_allergies'))
                            ->columnSpanFull(),

                        Toggle::make('pcd')
                            ->label('Pessoa com deficiencia?')
                            ->live(),
                        Textarea::make('pcd_details')
                            ->label('Observacoes')
                            ->rows(2)
                            ->visible(fn (Get $get): bool => (bool) $get('pcd'))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Termo de uso')
                    ->relationship('consent')
                    ->schema([
                        Toggle::make('accepted')
                            ->label('Aceito os termos de uso')
                            ->accepted()
                            ->required()
                            ->inline(false)
                            ->live(),
                        DateTimePicker::make('accepted_at')
                            ->seconds(false)
                            ->default(now())
                            ->required(fn (Get $get): bool => (bool) $get('accepted')),
                    ])
                    ->columns(2),
            ]);
    }
}
