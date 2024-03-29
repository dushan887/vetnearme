@foreach($clinics as $clinic)

<?php $hours = json_decode($clinic->opening_hours) ?>

    <li
        id="clinic-{{ $count }}"
        data-marker={{ $clinic->marker ?? 'none' }}
        class="item clinic"
        data-id="{{ $clinic->cid }}"
        data-item-url="/vet-clinic/{{ strtolower(str_replace(' ', '-', $clinic->name)) }}">

        <div class="resault">
            <div class="resault-logo">
                <a href="/vet-clinic/{{ strtolower(str_replace(' ', '-', $clinic->name)) }}">
                    <img src="{{ $clinic->logo ?
                        'img/logo/' . $clinic->logo :
                        'http://via.placeholder.com/120x80'}}"
                    alt="{{ $clinic->name }} Logo">
                </a>
            </div>
            <div class="reasault-info">
                <div class="resault-title">
                    <h4>
                        <a href="/vet-clinic/{{ strtolower(str_replace(' ', '-', $clinic->name)) }}">{{ $clinic->name }}</a>
                    </h4>
                </div>
                <div class="resault-description">
                    <p>{{ str_limit($clinic->description, $limit = 60, $end = '...') }} </p>
                    <a href="/vet-clinic/{{ strtolower(str_replace(' ', '-', $clinic->name)) }}">View more...</a>
                </div>
            </div>
            <div class="resault-address">
                <span>{{ $clinic->address }}</span><br />
                <span>{{ $clinic->city  . " " . $clinic->zip . ", " . $clinic->state}}</span><br />
                <span>{{ str_replace('Commonwealth of ', '', $clinic->country) }}</span><br />
            </div>
        </div>
        <div class="border-separator space-12"></div>
        <div class="resault">
            <div class="resault-phone">
                <a id="clinic_phone" href="tel:{{ preg_replace('/\D/', '', $clinic->phone_number) }}">
                                    <i class="fa fa-phone"></i>
                                    <span>{{ $clinic->phone_number }}</span>
                                </a>
            </div>
            <div class="resault-email">
                <a id="mailto" href="mailto:{{ $clinic->email }}">
                                    <i class="fa fa-envelope"></i>
                                    <span>Email Address</span>
                                </a>
            </div>
            <div class="resault-web">
                <a id="clinic_web_site" href="{{ $clinic->url }}" target="_blank"
                    rel="nofollow noopener noreferrer"
                    onclick="trackOutboundLink('{{ $clinic->url }}'); return false">
                    <i class="fa fa-globe"></i>
                    <span class="resault-web-address">
                        Website
                    </span>
                </a>
            </div>
        </div>
        <div class="border-separator space-12"></div>
        <div class="resault">
            <div class="rasault-rating">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
            </div>
            <div class="resault-directions">
                <a id="clinic_direction" href="https://www.google.com/maps/dir/{{ strtolower(str_replace([':', '"', '{', '}', 'lat', 'lng', ']', '['], '', $userCoordinates)) }}/{{ $clinic->lat }},{{ $clinic->lng }}" target="_blank" rel="nofollow noopener noreferrer">
                    <i class="fa fa-map-signs"></i>
                    Get Directions
                </a>
            </div>
            <div class="resault-book">
                <a id="clinic_book" href="{{ $clinic->bookmark_url }}" target="_blank" rel="nofollow noopener noreferrer">
                    <i class="fas fa-calendar-alt"></i>
                    Book Now
                </a>
            </div>

            @php
                $workingHours = isClinicOpen($hours, $clinic->timezone);
            @endphp

            @if($workingHours['open'])
                <div class="resault-open align-right">
                    <!-- <span class="checked"></span> -->
                    <span class="checked">{{ $workingHours['until'] }}</span>
                </div>
            @else
                <div class="resault-open align-right">
                    <!-- <span></span> -->
                    <span>{{ $workingHours['until'] }}</span>
                </div>
            @endif
        </div>

    </li>
    @php
        $count++;
    @endphp
@endforeach
