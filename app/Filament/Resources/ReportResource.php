<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $label = 'Laporan';

    protected static ?string $slug = 'laporan';

    protected static ?string $navigationLabel = 'Laporan';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $activeNavigationIcon = 'heroicon-s-folder';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference_number')
                    ->label('Nomor Surat')
                    ->unique(ignoreRecord: true)
                    ->hidden(),
                Section::make('Reporter')
                    ->label('Pelapor')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Pelapor')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required()
                            ->maxLength(16),
                        Forms\Components\Select::make('citizen')
                            ->label('Kewarganegaraan')
                            ->options([
                                'WNI' => 'WNI',
                                'WNA' => 'WNA',
                            ])
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('birthplace')
                            ->label('Tempat Lahir')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->label('Alamat')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('birthdate')
                            ->label('Tanggal Lahir')
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'male' => 'Laki-laki',
                                'female' => 'Perempuan',
                            ])
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('profession')
                            ->label('Pekerjaan')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Report')
                    ->label('Laporan')
                    ->schema([
                        Forms\Components\TextInput::make('police_station')
                            ->label('Kepolisian')
                            ->required(),
                        Forms\Components\TextInput::make('reference_police_number')
                            ->label('Nomor Surat Polisi')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('report_date_time')
                            ->label('Tanggal Laporan Kepolisian')
                            ->required(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Isi Laporan')
                            ->disableToolbarButtons([
                                'link',
                                'blockquote',
                                'codeBlock',
                                'attachFiles',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('reference_number')
                    ->label('Nomor Surat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Pelapor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('reference_police_number')
                    ->label('Nomor Surat Polisi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('police_station')
                    ->label('Kepolisian')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Staff')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('report_date_time')
                    ->label('Tanggal Laporan Kepolisian')
                    ->date()
                    ->sortable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('Staff')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
                DateRangeFilter::make('created_at'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('pdf')
                        ->label('PDF')
                        ->color('success')
                        ->icon('heroicon-o-document-arrow-down')
                        ->url(fn (Report $report) => route('pdf', $report))
                        ->openUrlInNewTab(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make('table')
                                ->askForFilename(date('dmY').'_export_report')
                                ->withColumns([
                                    Column::make('reference_number')->heading('Nomor Surat'),
                                    Column::make('address')->heading('Alamat Pelapor'),
                                    Column::make('phone')->heading('Telepon'),
                                    Column::make('name')->heading('Nama Pelapor'),
                                    Column::make('reference_police_number')->heading('Nomor Surat Polisi'),
                                    Column::make('police_station')->heading('Kepolisian'),
                                    Column::make('user.name')->heading('Staff'),
                                    Column::make('report_date_time')
                                        ->heading('Tanggal Laporan Kepolisian')
                                        ->formatStateUsing(fn ($state) => date('d/m/Y H:i', strtotime($state))),
                                    Column::make('created_at')
                                        ->heading('Tanggal Laporan')
                                        ->formatStateUsing(fn ($state) => date('d/m/Y H:i', strtotime($state))),
                                ]),
                        ])->hidden(! auth()->user()->isAdmin()),
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
