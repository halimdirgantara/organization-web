<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserService
{
    public function storeUser($user)
    {
        try {
            DB::beginTransaction();
            $userStored = User::create([
                'name' => $user->name,
                'nip' => $user->nip,
                'nik' => $user->nik,
                'phone' => $user->phone,
                'address' => $user->address,
                'email' => $user->email,
                'password' => bcrypt($user->password),
                'organization_id' => $user->organization_id,
                'is_active' => true,
                'profile_photo_path' => $user->profile_photo_path,
            ]);
            DB::commit();
            return $userStored;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function updateUser($request, $user)
    {
        try {
            DB::beginTransaction();
            $userUpdated = $user->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'organization_id' => $request->organization_id,
                'is_active' => $request->is_active,
                'profile_photo_path' => $request->profile_photo_path,
            ]);
            DB::commit();
            return $userUpdated;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function updateUserPassword($request, $user)
    {
        try {
            DB::beginTransaction();
            $userUpdated = $user->update([
                'password' => bcrypt($request->password),
            ]);
            DB::commit();
            return $userUpdated;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }
}
