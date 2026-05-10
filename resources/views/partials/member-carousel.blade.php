<div class="container">
    <div class="swiper member-swiper" id="{{ $id }}">
        <div class="swiper-wrapper">
            @foreach($members as $member)
                <div class="swiper-slide">
                    <div class="member-photo">
                        @php
                            $photoPath = 'images/team/' . ($member['photo'] ?? '');
                            $hasPhoto = !empty($member['photo']) && file_exists(public_path($photoPath));
                        @endphp
                        @if($hasPhoto)
                            <img src="{{ asset($photoPath) }}" alt="{{ $member['name'] }}">
                        @else
                            <div class="member-photo-placeholder">
                                {{ strtoupper(substr($member['nickname'], 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="member-name">{{ $member['name'] }}</div>
                    <div class="member-nickname">{{ $member['nickname'] }}</div>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>