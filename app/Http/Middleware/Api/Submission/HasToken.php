<?php


namespace App\Http\Middleware\Api\Submission;


use App\Models\Eloquent\User;
use Closure;

class HasToken
{
    public function handle($request, Closure $next)
    {
        $allow_token = $request->token == config('services.bitlab.token');
        $user = User::first();
        if (!$allow_token || empty($user)) {
            return response()->json([
                    'success' => false,
                    'message' => 'Invalid token',
                ])
                ->setStatusCode(400);
        }
        $request->merge([
            'user' => $user
        ]);
        return $next($request);
    }
}
