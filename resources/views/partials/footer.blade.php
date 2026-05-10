<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Kiri: Logo -->
            <div class="footer-logo">
                @php
                    $logoPath = setting('site_logo', 'images/logo/logo-qof-light.png');
                    $logoFullPath = public_path($logoPath);
                @endphp
                
                @if(file_exists($logoFullPath) && !empty($logoPath))
                    <img src="{{ asset($logoPath) }}" alt="QofMedia">
                @else
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="bi bi-camera-reels-fill" style="color: #6366f1; font-size: 1.5rem;"></i>
                        <span style="color: white; font-weight: 600; font-size: 1.1rem;">QofMedia</span>
                    </div>
                @endif
            </div>
            
            <!-- Tengah: Copyright -->
            <div class="footer-copyright">
                Copyright © {{ date('Y') }} QofMedia | Powered by QofMedia
            </div>
            
            <!-- Kanan: Social Media Icons -->
            <div class="footer-social">
                @php
                    $socials = \App\Models\Setting::whereIn('key', ['facebook', 'instagram', 'twitter', 'tiktok', 'youtube'])
                        ->pluck('value', 'key');
                @endphp
                
                @if($socials['facebook'] ?? false)
                    <a href="{{ $socials['facebook'] }}" target="_blank" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                @endif
                
                @if($socials['instagram'] ?? false)
                    <a href="{{ $socials['instagram'] }}" target="_blank" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                @endif
                
                @if($socials['twitter'] ?? false)
                    <a href="{{ $socials['twitter'] }}" target="_blank" title="Twitter/X">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                @endif
                
                @if($socials['tiktok'] ?? false)
                    <a href="{{ $socials['tiktok'] }}" target="_blank" title="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                @endif
                
                @if($socials['youtube'] ?? false)
                    <a href="{{ $socials['youtube'] }}" target="_blank" title="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</footer>