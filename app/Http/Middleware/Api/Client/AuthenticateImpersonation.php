<?php

namespace App\Http\Middleware\Api\Client;

use App\Models\ApiKey;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthenticateImpersonation
{
    public const IMPERSONATING_USER_ATTRIBUTE = 'impersonating_user';

    public function handle(Request $request, Closure $next): mixed
    {
        /** @var \App\Models\User|null $caller */
        $caller = $request->user();

        if (!$caller) {
            return $next($request);
        }

        $token = $caller->currentAccessToken();

        if (!($token instanceof ApiKey) || $token->key_type !== ApiKey::TYPE_APPLICATION) {
            return $next($request);
        }

        // Application API keys MUST specify which user they are acting as.
        $executionUserId = $request->header('X-Execution-User');
        if (empty($executionUserId)) {
            throw new BadRequestHttpException(
                'Application API keys must include the X-Execution-User header to access Client API endpoints.'
            );
        }

        // Only root admins are permitted to impersonate users.
        if (!$caller->root_admin) {
            throw new AccessDeniedHttpException(
                'You do not have permission to perform user impersonation.'
            );
        }

        // Resolve the target user by integer ID or UUID.
        $targetUser = User::query()
            ->where(is_numeric($executionUserId) ? 'id' : 'uuid', $executionUserId)
            ->first();

        if (!$targetUser) {
            throw new NotFoundHttpException(
                'The user specified in X-Execution-User could not be found.'
            );
        }

        // Preserve the original admin for auditing.
        $request->attributes->set(self::IMPERSONATING_USER_ATTRIBUTE, $caller);

        $request->setUserResolver(fn () => $targetUser);

        return $next($request);
    }
}
