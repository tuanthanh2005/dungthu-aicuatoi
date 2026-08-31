<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['superadmin_1', 'sieusuperadmin', 'blog_editor'], true)) {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập!');
        }

        $user = auth()->user();
        $method = strtoupper($request->getMethod());
        $routeName = $request->route() ? $request->route()->getName() : null;

        // 1. Phân quyền cho Blog Editor
        if ($user->role === 'blog_editor') {
            if (!$routeName || !\Illuminate\Support\Str::is('admin.blogs*', $routeName)) {
                return redirect()->route('admin.blogs')
                    ->with('error', 'Tài khoản này chỉ được cấp quyền quản lý Blog.');
            }

            return $next($request);
        }

        // 2. SieuSuperAdmin: Toàn quyền tối cao 100% không bị bất kỳ giới hạn nào
        if ($user->role === 'sieusuperadmin' || $user->role === 'admin') {
            return $next($request);
        }

        // 3. Superadmin_1 (Quản lý web con): Chặn các khu vực hạ tầng, bảo mật, và cấu hình nâng cao
        if ($user->role === 'superadmin_1' && $routeName) {
            $restrictedRoutePatterns = [
                'admin.menu-settings*',
                'admin.buff.*',
                'admin.proxies.*',
                'admin.card-exchanges*',
                'admin.customer-durations*',
                'admin.banned-ips*',
                'admin.suspicious-ips*',
                'admin.affiliates*',
                'admin.seo-keywords*',
                'admin.system-notifications*',
                'admin.google-indexing*',
                'admin.commissions.update*',
            ];

            foreach ($restrictedRoutePatterns as $pattern) {
                if (\Illuminate\Support\Str::is($pattern, $routeName)) {
                    abort(403, "Quyền hạn của bạn không đủ để truy cập tính năng này.");
                }
            }
        }

        return $next($request);
    }
}
