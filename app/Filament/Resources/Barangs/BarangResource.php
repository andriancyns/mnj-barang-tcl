<?php

namespace App\Filament\Resources\Barangs;

use App\Filament\Resources\Barangs\Pages\CreateBarang;
use App\Filament\Resources\Barangs\Pages\EditBarang;
use App\Filament\Resources\Barangs\Pages\ListBarangs;
use App\Filament\Resources\Barangs\Pages\ViewBarang;
use App\Filament\Resources\Barangs\Schemas\BarangForm;
use App\Filament\Resources\Barangs\Schemas\BarangInfolist;
use App\Filament\Resources\Barangs\Tables\BarangsTable;
use App\Models\Barang;
use Auth;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;
    protected static ?string $navigationLabel = 'Manajemen Barang';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        $user = auth()->user();
        
        return BarangForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BarangInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BarangsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user  = Auth::user();

        if ($user?->hasRole('admin')) return $query;

        // staff & viewer hanya lihat data gudang-nya
        return $query->where('gudang_id', $user->gudang_id);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBarangs::route('/'),
            'create' => CreateBarang::route('/create'),
            'view' => ViewBarang::route('/{record}'),
            'edit' => EditBarang::route('/{record}/edit'),
        ];
    }
}
