<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    public string $defaultSortColumn = 'sort';
    public string $defaultSortDirection = 'asc';
    public bool $reorderEnabled = true;
    public bool $showSearch = false;
    public bool $filtersEnabled = false;

    public function mount(): void
    {
        $this->enableReordering();
    }
    public function columns(): array
    {
        return [
            Column::make('Sort'),
            Column::make('Name'),
            Column::make('E-mail', 'email'),
            Column::make('Verified', 'email_verified_at'),
        ];
    }

    public function query(): Builder
    {
        return User::query();
    }

    public function reorder(array $items): void
    {
        foreach ($items as $item) {
            $user = User::find((int)$item['value']);
                $user->sort = (int)$item['order'];
                $user->save();
        }
    }
}
