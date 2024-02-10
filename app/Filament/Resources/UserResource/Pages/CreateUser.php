<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data["email_verified_at"] = Carbon::now();
        /**
         * @var User $user
         */
        $user = parent::handleRecordCreation($data); // TODO: Change the autogenerated stub
        $user->assignRole("admin");
        return $user;
    }
}