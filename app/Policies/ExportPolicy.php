<?php

namespace App\Policies;

use App\Models\User;
use Filament\Actions\Exports\Models\Export;

class ExportPolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Export $export)
    {
        return $user->isAdmin();
    }
}
