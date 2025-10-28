<?php

namespace App\Database\Eloquent;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Models\User as EloquentUser;

class EloquentUserRepository implements UserRepositoryInterface
{
    private function toDomainEntity(EloquentUser $eloquent): User
    {
        return new User(
            $eloquent->id,
            $eloquent->username,
            $eloquent->email,
            $eloquent->password,
            $eloquent->active,
            $eloquent->last_login ? new \DateTimeImmutable($eloquent->last_login) : null
        );
    }

    private function toEloquentModel(User $domainUser): EloquentUser
    {
        return new EloquentUser([
            'id' => $domainUser->id(),
            'username' => $domainUser->getUserName(),
            'email' => $domainUser->getEmail(),
            'password' => $domainUser->getPasswordHash(),
            'active' => $domainUser->isActive(),
            'last_login' => $domainUser->getLastLogin()?->format('Y-m-d H:i:s'),
        ]);
    }

    public function findById(int $id): ?User
    {
        $eloquent = EloquentUser::find($id);
        return $eloquent ? $this->toDomainEntity($eloquent) : null;
    }

    public function save(User $user): ?int
    {
        $model = $user->id()
            ? (EloquentUser::find($user->id()) ?? new EloquentUser())
            : new EloquentUser();

        $model->username = $user->getUserName();
        $model->email = (string) $user->getEmail();
        if ($user->getPasswordHash()) {
            $model->password = $user->getPasswordHash();
        }
        $model->active = (bool) $user->isActive();
        $model->last_login_at = $user->getLastLogin()
            ? $user->getLastLogin()->format('Y-m-d H:i:s')
            : null;

        $model->save();
        return $model->id;
    }

    public function findByUsername(string $username): ?User
    {
        $eloquent = EloquentUser::where('username', $username)->first();
        return $eloquent ? $this->toDomainEntity($eloquent) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $eloquent = EloquentUser::where('email', $email)->first();
        return $eloquent ? $this->toDomainEntity($eloquent) : null;
    }

    public function delete(User $user): bool
    {
        $eloquentUser = EloquentUser::find($user->id());
        if ($eloquentUser->delete()){
            return true;
        } else {
            return false;
        }
    }
}
