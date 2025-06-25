@extends('layouts.pdf')

@section('content')
    {{-- Cover Page --}}
    <div class="cover-page">
        <div class="cover-hero">
            <div class="cover-content">
                @if($property->logo_url)
                    <img src="{{ $property->logo_url }}" alt="Property Logo" class="logo-cover">
                @endif

                <div class="cover-welcome">WELCOME</div>
                <div class="cover-subtitle">Your Guide</div>
                <div class="cover-property-name">{{ $property->name }}</div>
                <div class="cover-address">{{ $property->address }}</div>
            </div>
            <div class="cover-decoration"></div>
        </div>
    </div>

        {{-- Welcome Message Page --}}
        <div class="page welcome-page" style="page-break-after: always;">
            <div class="page-header">
                <div class="page-subtitle">About the</div>
                <div class="page-title">HOST</div>
                <div class="page-divider"></div>
            </div>

            <div class="welcome-content">
                <h3 style="font-size: 24px; margin-bottom: 20px; color: #2d3748;">
                    {!! $property->welcome_title ?: 'Hello and welcome!' !!}
                </h3>
                <div style="font-size: 15px; color: #4a5568; line-height: 1.7;">
                    {!! $property->welcome_message ?: 'My name is your host and I\'m beyond excited to welcome you to this beautiful space. We hope you have an incredible stay and create wonderful memories here.' !!}
                </div>
                <div style="margin-top: 20px; color: #2d3748; font-weight: bold;">
                    - Your Host
                </div>
            </div>
        </div>

        {{-- Check-in & Check-out Page --}}
        <div class="page" style="page-break-after: always;">
            <div class="page-header">
                <div class="page-subtitle">Arrival &</div>
                <div class="page-title">CHECK IN</div>
                <div class="page-divider"></div>
            </div>

            <div class="info-grid">
                <div class="info-section">
                    <div class="info-icon"></div>
                    <div class="info-label">Check In</div>
                    <div class="info-value">{{ $property->checkin ?: '3:00PM' }}</div>
                    <div class="info-description">{{ $property->checkin_instructions ?: "Complete your online check-in and you'll receive detailed instructions via email." }}</div>
                </div>

                <div class="info-section">
                    <div class="info-icon"></div>
                    <div class="info-label">Check Out</div>
                    <div class="info-value">{{ $property->checkout ?: '11:00AM' }}</div>
                    <div class="info-description">{{ $property->checkout_instructions ?: 'Simply lock up and drop the key in the designated area. Thank you for staying with us!' }}</div>
                </div>
            </div>
        </div>

        {{-- Location Page --}}
        <div class="page" style="page-break-after: always;">
            <div class="page-header">
                <div class="page-subtitle">Things to</div>
                <div class="page-title">KNOW</div>
                <div class="page-divider"></div>
            </div>

            <div class="location-card">
                <h3 style="font-size: 24px; margin-bottom: 30px; color: #2d3748;">Location Details</h3>

                @if($property->location_area || $property->location_country)
                <div class="info-grid">
                    <div class="info-section">
                        <div class="info-label">Area</div>
                        <div class="info-description">{{ $property->location_area }}</div>
                    </div>

                    <div class="info-section">
                        <div class="info-label">Country</div>
                        <div class="info-description">{{ $property->location_country }}</div>
                    </div>
                </div>
                @endif

                @if($property->location_description)
                    <div style="margin: 30px 0; padding: 30px; background: #f7fafc; border-radius: 12px;">
                        <p style="color: #4a5568; line-height: 1.7; font-size: 15px; margin: 0;">
                            {{ $property->location_description }}
                        </p>
                    </div>
                @endif
            </div>
        </div>


        @if($property->amenities_description)
            <div class="page" style="page-break-after: always;">
                <div style="margin-top: 50px;">
                    <div class="page-header">
                        <div class="page-subtitle">Features &</div>
                        <div class="page-title">Amenities</div>
                    </div>
                    <div style="background: #f7fafc; padding: 30px; border-radius: 12px;">
                        <div style="color: #4a5568; line-height: 1.7; font-size: 14px; text-align: left;">
                            {!! $property->amenities_description !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif


        {{-- Rules Page --}}
        @if($property->rules && $property->rules->count())
            <div class="page" style="page-break-after: always;">
                <div class="page-header">
                    <div class="page-subtitle">House</div>
                    <div class="page-title">RULES</div>
                    <div class="page-divider"></div>
                </div>
                <div style="margin-top: 20px;">
                    @foreach($property->rules as $index => $rule)
                        <div style="margin-bottom: 20px; padding: 20px; background: #f7fafc; border-left: 4px solid #4299e1;">
                            @if($rule->title)
                                <div style="font-weight: bold; font-size: 16px; color: #2d3748;">{{ $rule->title }}</div>
                            @endif
                            @if($rule->description)
                                <div style="font-size: 14px; color: #4a5568; margin-top: 8px;">{{ $rule->description }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- FAQ Page --}}
        @if($property->faqs && $property->faqs->count())
            <div class="page" style="page-break-after: always;">
                <div class="page-header">
                    <div class="page-subtitle">Questions &</div>
                    <div class="page-title">ANSWERS</div>
                    <div class="page-divider"></div>
                </div>
                <div style="margin-top: 20px;">
                    @foreach($property->faqs as $faq)
                        <div style="margin-bottom: 20px; padding: 20px; background: #f7fafc; border-left: 4px solid #38b2ac;">
                            <div style="font-weight: bold; font-size: 15px; color: #2c7a7b;">Q: {{ $faq->question }}</div>
                            <div style="margin-top: 8px; font-size: 14px; color: #4a5568;">A: {{ $faq->answer }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


@endsection
