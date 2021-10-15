<?php


namespace App\Http\Middleware\Api\Submission;


use App\Models\Eloquent\User;
use Closure;

class HasToken
{
    public function handle($request, Closure $next)
    {
        $user = User::whereNotNull('remember_token')->where('remember_token', $request->input('token'))->first();
        if (empty($user)) {
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
