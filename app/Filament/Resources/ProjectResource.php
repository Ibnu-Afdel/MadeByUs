<?php

namespace App\Filament\Resources;

use App\Enums\ProjectStatus;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Tables\Actions\Action ;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->minLength(5)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(ProjectStatus::class),
                Forms\Components\Toggle::make('is_featured'),
                SpatieTagsInput::make('tags'),
                // Forms\Components\TextInput::make('slug')
                //     ->required(),
                // Forms\Components\TextInput::make('view_count')
                //     ->numeric()
                //     ->default(0),
                // Forms\Components\DateTimePicker::make('published_at'),
                Forms\Components\Toggle::make('is_priority'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->boolean(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('user.name')->label('Author'),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        ProjectStatus::PENDING => 'warning',
                        ProjectStatus::APPROVED => 'success',
                        ProjectStatus::REJECTED => 'danger',
                    }),
                SpatieTagsColumn::make('tags')->limitList(2),
                TextColumn::make('view_count')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_priority')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('submission_type')
                    ->label('Submission Type')
                    ->badge()
                    ->getStateUsing(function (Project $project) {
                        if ($project->status === ProjectStatus::PENDING) {
                            return $project->created_at->eq($project->updated_at)
                                ? 'New'
                                : 'Edited';
                        }
                        return null;
                    })
                    ->color(fn($state) => match($state){
                        'New' => 'success',
                        'Edited' => 'warning',
                        default => 'gray',
                    }),
                    
            ])
            ->filters([
                SelectFilter::make('status')
                ->options(ProjectStatus::class)
                ->default('pending'),
            ])
            ->actions([
                Action::make('approve')
                ->label('Approve')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(function (Project $project){
                    $project->update([
                        'status' => ProjectStatus::APPROVED,
                        'published_at' => now()
                    ]);
                })
                ->visible(fn (Project $project) => $project->status === ProjectStatus::PENDING)
                ->authorize('approve projects'),

                Action::make('reject')
                ->label('Reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->action(function(Project $project){
                    $project->update([
                        'status' => ProjectStatus::REJECTED,
                    ]);
                })
                ->visible(fn(Project $project) => $project->status === ProjectStatus::PENDING)
                ->authorize('approve projects'),

                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->orderByDesc('is_priority') 
        ->orderBy('created_at', 'desc'); 
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
