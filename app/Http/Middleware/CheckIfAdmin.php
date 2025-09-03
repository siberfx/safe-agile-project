<?php

namespace App\Http\Middleware;

use App\Helpers\Variable;
use Closure;
use Illuminate\Http\JsonResponse;

class CheckIfAdmin
{
    private function checkIfUserIsAdmin($user)
    {
        return ($user->hasAnyRole(Variable::ADMIN_ROLE));

    }

    /**
     * Answer to unauthorized access request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    private function respondToUnauthorizedRequest($request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('Not authorized'), JsonResponse::HTTP_UNAUTHORIZED);
        }

        return redirect()->guest(route('admin.login'));
    }

    /**
     * Answer to unauthorized access request.
     *
     * @param [type] $request [description]
     * @return [type] [description]
     */
    private function respondToBanned($request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('Not authorized'), JsonResponse::HTTP_FORBIDDEN);
        }
        abort(403, trans('Not authorized'));

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guest()) {
            return $this->respondToUnauthorizedRequest($request);
        }

        if (! $this->checkIfUserIsAdmin(auth()->user())) {
            return $this->respondToUnauthorizedRequest($request);
        }

        return $next($request);
    }
}
