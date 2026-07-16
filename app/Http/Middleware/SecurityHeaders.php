<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * SecurityHeaders Middleware
 * 
 * Menambahkan HTTP security headers pada setiap response untuk melindungi
 * website dari serangan umum seperti Clickjacking, XSS, MIME sniffing, dll.
 * 
 * Diterapkan berdasarkan OWASP Security Headers best practices.
 */
class SecurityHeaders
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Cegah Clickjacking: hanya izinkan iframe dari domain yang sama
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Cegah MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // XSS Protection untuk browser lama
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Referrer Policy: kirim origin saja ke external sites
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Cegah Flash/Silverlight cross-domain policy abuse
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        // Permissions Policy: batasi akses fitur browser sensitif
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=(), usb=(), magnetometer=(), accelerometer=()'
        );

        // HSTS (HTTP Strict Transport Security)
        // Paksa browser menggunakan HTTPS selama 1 tahun.
        // Catatan: header ini hanya efektif saat website sudah berjalan di HTTPS.
        // Untuk development lokal (HTTP), header ini diabaikan oleh browser.
        $response->headers->set(
            'Strict-Transport-Security',
            'max-age=31536000; includeSubDomains'
        );

        // Content Security Policy
        // Mengizinkan: self, font Google, CDN yang digunakan project ini
        // connect-src mencakup CDN untuk AJAX/fetch dari library eksternal
        $csp = implode('; ', [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://unpkg.com https://www.google.com https://www.gstatic.com",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net https://unpkg.com",
            "font-src 'self' https://fonts.gstatic.com https://cdn.jsdelivr.net data:",
            "img-src 'self' data: blob: https: http:",
            "media-src 'self' https: http:",
            "frame-src 'self' https://www.google.com https://www.youtube.com https://maps.google.com https://www.google.com/maps",
            "connect-src 'self' https://cdn.jsdelivr.net https://unpkg.com",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "upgrade-insecure-requests",
        ]);
        $response->headers->set('Content-Security-Policy', $csp);

        // Hapus header yang mengungkap teknologi server
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
