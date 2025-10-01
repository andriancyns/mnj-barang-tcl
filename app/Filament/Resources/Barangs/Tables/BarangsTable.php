<?php

namespace App\Filament\Resources\Barangs\Tables;

use App\Models\Gudang;
use Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BarangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_barang')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_barang')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('gudang.nama')
                    ->label('Gudang')
                    ->sortable(),
            ])
            ->filters([
                // Admin bisa filter by gudang; staff/viewer otomatis ter-filter lewat query di bawah
                SelectFilter::make('gudang_id')
                    ->label('Gudang')
                    ->options(fn() => Gudang::pluck('nama','id')->all())
                    ->visible(fn() => Auth::user()?->hasRole('admin')),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    ->visible(fn() => Auth::user()->hasRole('admin')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
