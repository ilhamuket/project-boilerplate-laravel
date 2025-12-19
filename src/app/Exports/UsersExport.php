<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return User::query()->select(['id', 'name', 'email', 'created_at']);
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Created At'];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            optional($user->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
