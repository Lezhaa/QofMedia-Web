<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Kiri: Logo -->
            <div class="footer-logo">
                @php
                    $logoPath = \App\Models\Setting::where('key', 'site_logo')->value('value');
                    $logoFullPath = $logoPath ? public_path('storage/' . $logoPath) : null;
                @endphp
                
                @if($logoPath && file_exists($logoFullPath))
                    <img src="{{ asset('storage/' . $logoPath) }}" alt="QofMedia">
                @else
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="bi bi-camera-reels-fill" style="color: var(--accent-teal-glow, #4EB8CC); font-size: 1.5rem;"></i>
                        <span style="color: white; font-weight: 600; font-size: 1.1rem;">QofMedia</span>
                    </div>
                @endif
            </div>
            
            <!-- Tengah: Copyright (Bisa diedit dari Settings) -->
            <div class="footer-copyright">
                {{ \App\Models\Setting::where('key', 'footer_copyright')->value('value') ?: 'Copyright © ' . date('Y') . ' QofMedia | Powered by QofMedia' }}
            </div>
            
            <!-- Kanan: Social Media Icons -->
            <div class="footer-social">
                @php
                    $socials = \App\Models\Setting::whereIn('key', ['facebook', 'instagram', 'twitter', 'tiktok', 'youtube'])
                        ->pluck('value', 'key');
                @endphp
                
                @if(!empty($socials['facebook']))
                    <a href="{{ $socials['facebook'] }}" target="_blank" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                @endif
                
                @if(!empty($socials['instagram']))
                    <a href="{{ $socials['instagram'] }}" target="_blank" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                @endif
                
                @if(!empty($socials['twitter']))
                    <a href="{{ $socials['twitter'] }}" target="_blank" title="Twitter/X">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                @endif
                
                @if(!empty($socials['tiktok']))
                    <a href="{{ $socials['tiktok'] }}" target="_blank" title="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                @endif
                
                @if(!empty($socials['youtube']))
                    <a href="{{ $socials['youtube'] }}" target="_blank" title="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</footer>