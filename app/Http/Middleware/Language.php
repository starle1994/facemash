<?php namespace App\Http\Middleware;

use Closure, Config, App, Redirect;

class Language  {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Make sure current locale exists.
        $locale = $request->segment(1);
        if ( ! in_array($locale, Config('app.locales'))) {
            $segments = $request->segments();
            $segments[0] = Config('app.fallback_locale');
            return redirect(implode('/', $segments));
        }
        
        App::setLocale($locale);
        return $next($request);
    }

}