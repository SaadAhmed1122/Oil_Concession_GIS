<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConcessionResource\Pages;
use App\Filament\Resources\ConcessionResource\RelationManagers;
use App\Models\Concession;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConcessionResource extends Resource
{
    protected static ?string $model = Concession::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('concession_name')->label('Concession Name'),
                Hidden::make('geometry'),
            Map::make('map_geometry')
            ->mapControls([
                'mapTypeControl'    => true,
                'scaleControl'      => true,
                'streetViewControl' => true,
                'rotateControl'     => true,
                'fullscreenControl' => true,
                'searchBoxControl'  => false,
                'zoomControl'       => false,
            ])
            ->height(fn () => '400px')
            ->defaultZoom(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConcessions::route('/'),
            'create' => Pages\CreateConcession::route('/create'),
            'edit' => Pages\EditConcession::route('/{record}/edit'),
        ];
    }
}
