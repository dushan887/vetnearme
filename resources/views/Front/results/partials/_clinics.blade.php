
    <div class="inner"
        id="gmap-data"
        data-coordinates="{{ $clinicsCoordinates ?? '' }}"
        data-usercoordinates="{{ $userCoordinates }}"
    >
        <ul class="list-unstyled">

            @foreach($clinics as $clinic)

            <?php $hours = json_decode($clinic->opening_hours) ?>

                <li class="item">
                    <div class="resault">
                        <div class="resault-logo">
                            <a href="#">
                                <img src="{{ $clinic->logo ?
                                    'img/logo/' . $clinic->logo :
                                    'http://via.placeholder.com/120x80'}}"
                                alt="{{ $clinic->name }} Logo">
                            </a>
                        </div>
                        <div class="reasault-info">
                            <div class="resault-title">
                                <h4>{{ $clinic->name }}</h4>
                            </div>
                            <div class="resault-description">
                                <p>{{ $clinic->description }}</p>
                                <a href="#">View more...</a>
                            </div>
                        </div>
                        <div class="resault-address">
                            <span>{{ $clinic->address }}</span><br />
                            <span>{{ $clinic->city }}</span><br />
                            <span>{{ $clinic->country . " " . $clinic->zip }}</span><br />
                        </div>
                    </div>
                    <div class="border-separator space-12"></div>
                    <div class="resault">
                        <div class="resault-phone">
                            <a href="tel:{{ preg_replace('/\D/', '', $clinic->phone_number) }}">
                                                <i class="fa fa-phone"></i>
                                                <span>{{ $clinic->phone_number }}</span>
                                            </a>
                        </div>
                        <div class="resault-email">
                            <a href="mailto:{{ $clinic->email }}">
                                                <i class="fa fa-envelope"></i>
                                                <span>{{ $clinic->email }}</span>
                                            </a>
                        </div>
                        <div class="resault-web">
                            <a href="{{ $clinic->url }}" target="_blank" rel="nofollow noopener noreferrer">
                                                <i class="fa fa-globe"></i>
                                                <span>{{ $clinic->url }}</span></a>
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
                            <a href="{{ $clinic->gmaps_link }}" target="_blank" rel="nofollow noopener noreferrer">
                                                <i class="fa fa-map-signs"></i>
                                                Get Directions
                                            </a>
                        </div>

                        @if(isClinicOpen($hours, $currentDay, $currentHour))
                        <div class="resault-open align-right">
                            <span class="checked"></span>
                        </div>
                        @else
                        <div class="resault-open align-right">
                            <span></span>
                        </div>
                        @endif
                    </div>

                </li>

            @endforeach

        </ul>

        {{ $clinics->links() }}