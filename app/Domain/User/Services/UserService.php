<?php

namespace App\Domain\User\Services;

use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Morilog\Jalali\Jalalian;

class UserService extends BaseService
{
    public function __construct(
        private readonly UserRepositoryInterface $users
    ) {}

    public function hashPassword(string $password): string
    {
        return Hash::make($password); // Laravel hashing (configurable: bcrypt/argon2)
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return Hash::check($password, $hash);
    }

    /**
     * Attempts login, updates last_login_at, and returns API payload.
     *
     * @param  array        $credentials  e.g. ['email' => '...', 'password' => '...']
     * @param  Request|null $request      to read remember/ip/ua (optional)
     * @return array
     */
    public function login(array $credentials, ?Request $request = null): array
    {
        $remember = (bool)($request?->boolean('remember'));

        $logPath = storage_path('logs/user_logins.log');

        try {
            if (!Auth::attempt($credentials, $remember)) {
                $logContent = sprintf(
                    "[%s] local.WARNING: LOGIN FAILED: username=%s | ip=%s\n",
                    now()->format('Y-m-d H:i:s'),
                    $credentials['username'] ?? 'unknown',
                    $request?->ip() ?? 'N/A'
                );
                File::append($logPath, $logContent);

                return [
                    'success' => false,
                    'message' => 'Invalid credentials',
                ];
            }

            /** @var User $eloquent */
            $eloquent = Auth::user();

            $domainUser = $this->users->findById((string)$eloquent->id);
            if ($domainUser) {
                $domainUser->recordLogin();
                $this->users->save($domainUser);
            }

            $token = $eloquent->createToken('api')->plainTextToken;

            $logContent = sprintf(
                "[%s] local.INFO: LOGIN SUCCESS: user_id=%s | username=%s | email=%s | ip=%s\n",
                now()->format('Y-m-d H:i:s'),
                $eloquent->id,
                $eloquent->username,
                $eloquent->email,
                $request?->ip() ?? 'N/A'
            );
            File::append($logPath, $logContent);

            return [
                'success' => true,
                'message' => 'Logged in successfully',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id' => $eloquent->id,
                        'username' => $eloquent->username,
                        'email' => $eloquent->email,
                        'active' => (bool)$eloquent->active,
                        'lastLogin' => Jalalian::fromDateTime($domainUser->getLastLogin())->format('Y/m/d H:i'),
                    ],
                ],
            ];

        } catch (\Exception $e) {
            File::append(
                $logPath,
                sprintf("[%s] local.ERROR: LOGIN ERROR:: %s\n", now()->format('Y-m-d H:i:s'), $e->getMessage())
            );

            return [
                'success' => false,
                'message' => 'Login failed due to an internal error.',
            ];
        }
    }
    /**
     * Revokes current token. Return array for controller success().
     */
    public function logout(Request $request): array
    {
        $user = $request->user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
            return ['loggedOut' => true];
        }

        return ['loggedOut' => false];
    }

    public function show()
    {
        $query = User::query();
        $query->select(['id', 'username', 'email', 'active', 'last_login_at']);

        $users = $query->get();

        foreach ($users as $user) {
            if ($user->last_login_at) {
                $user->last_login_at = Jalalian::fromDateTime($user->last_login_at)->format('Y/m/d H:i');
            }
        }

        return $users->toArray();
    }

}
