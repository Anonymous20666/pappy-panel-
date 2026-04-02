<?php

namespace App\Services\Users;

use App\Contracts\Repository\UserRepositoryInterface;
use App\Exceptions\Model\DataValidationException;
use App\Models\User;
use App\Notifications\AccountCreated;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class UserCreationService
{
    /**
     * UserCreationService constructor.
     */
    public function __construct(
        private ConnectionInterface $connection,
        private Hasher $hasher,
        private PasswordBroker $passwordBroker,
        private UserRepositoryInterface $repository,
    ) {}

    /**
     * Create a new user on the system.
     *
     * @throws \Exception
     * @throws DataValidationException
     */
    public function handle(array $data): User
    {
        if (array_key_exists('password', $data) && ! empty($data['password'])) {
            $data['password'] = $this->hasher->make($data['password']);
        }

        $this->connection->beginTransaction();
        if (! isset($data['password']) || empty($data['password'])) {
            $generateResetToken = true;
            $data['password'] = $this->hasher->make(Str::random(30));
        }

        /** @var User $user */
        $user = $this->repository->create(array_merge($data, [
            'uuid' => Uuid::uuid4()->toString(),
        ]), true, true);

        if (isset($generateResetToken)) {
            $token = $this->passwordBroker->createToken($user);
        }

        $this->connection->commit();

        try {
            $user->notify(new AccountCreated($user, $token ?? null));
        } catch (\Exception $exception) {
            \Log::error($exception);

            // If this was a verification/setup email (token present), we should not move forward.
            if (! empty($token)) {
                throw $exception;
            }
        }

        return $user;
    }
}
