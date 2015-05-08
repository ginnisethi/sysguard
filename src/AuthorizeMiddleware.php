<?php namespace Ifaniqbal\Sysguard;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Ifaniqbal\Sysguard\Sysguard;

class AuthorizeMiddleware {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The Sysguard implementation.
     *
     * @var Sysguard
     */
    protected $authorize;

    /**
     * Redirect route for unauthorized request.
     *
     * @var Sysguard
     */
    protected $redirect = '/';

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth, Sysguard $authorize)
    {
        $this->auth = $auth;
        $this->authorize = $authorize;
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
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest($this->redirect);
            }
        } else {
            if (!$this->authorize->authorize()) {
                return response('Unauthorized.', 401);
            }
        }

        return $next($request);
    }

}
