<?php

namespace App\Filament\Resources\Barangs\Schemas;

use App\Models\Gudang;
use Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_barang')
                    ->required(),
                TextInput::make('nama_barang')
                    ->required(),
                TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
                Select::make('gudang_id')
                    ->label('Gudang')
                    ->options(Gudang::query()->pluck('nama', 'id'))
                    ->required()
                    ->disabled(fn() => Auth::user()?->hasRole('admin') === false)
                    ->visible(fn() => Auth::user()?->hasRole('admin')),
            ])->columns(2);
    }
}
