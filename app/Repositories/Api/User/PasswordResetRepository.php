<?php

namespace App\Repositories\Api\User;

use App\Models\Access\PasswordReset\PasswordReset;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionRepository.
 */
class PasswordResetRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = PasswordReset::class;

    /**
     * Get token by email.
     *
     * @return mixed
     */
    public function getByEmail($email)
    {
        return $this->query()->where('email', $email)->get()->toArray();
    }

    /**
     * Check if given email exist or not.
     *
     * @return mixed
     */
    public function checkUser($data)
    {
        return $this->query()->where('email', $data['email'])->where('token', $data['token'])->get()->toArray();
    }

    /**
     * Create password reset entry.
     *
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->query()->insert($attributes);
    }

    /**
     * If token exist for same user then update.
     *
     * @return mixed
     */
    public function update($attributes)
    {
        $token = ['token' => $attributes['token']];

        return $this->query()->where('email', $attributes['email'])->update($attributes);
    }

    /**
     * Delete entry after reseting the password.
     *
     * @return mixed
     */
    public function delete($data)
    {
        return $this->query()->where('email', $data['email'])->where('token', $data['token'])->delete();
    }
}
