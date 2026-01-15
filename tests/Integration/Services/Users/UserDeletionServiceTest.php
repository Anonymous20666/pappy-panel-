<?php

namespace App\Tests\Integration\Services\Users;

use App\Models\User;
use App\Exceptions\DisplayException;
use App\Services\Users\UserDeletionService;
use App\Tests\Integration\IntegrationTestCase;

class UserDeletionServiceTest extends IntegrationTestCase
{
    public function testExceptionReturnedIfUserAssignedToServers(): void
    {
        $server = $this->createServerModel();

        $this->expectException(DisplayException::class);
        $this->expectExceptionMessage(__('admin/user.exceptions.user_has_servers'));

        $this->app->make(UserDeletionService::class)->handle($server->user);

        $this->assertModelExists($server->user);
    }

    public function testUserIsDeleted(): void
    {
        $user = User::factory()->create();

        $this->app->make(UserDeletionService::class)->handle($user);

        $this->assertModelMissing($user);
    }
}
