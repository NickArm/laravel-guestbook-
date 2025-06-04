@extends('layouts.app')
@section('title', 'FAQs - Welcomy')

@section('content')
<div class="max-w-xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6 text-center text-primary">Frequently Asked Questions</h1>

    <div class="space-y-8">
        <div>
            <h2 class="text-xl font-semibold">What is Welcomy?</h2>
            <p class="text-gray-700 mt-1">Welcomy is a digital guestbook platform that helps property owners share useful information with guests through a modern mobile interface.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">What types of properties can I use it for?</h2>
            <p class="text-gray-700 mt-1">You can use Welcomy for apartments, villas, Airbnbs, studios, boats, and any type of short-term rental or hospitality offering.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Can I customize my guestbook?</h2>
            <p class="text-gray-700 mt-1">Yes! Each property can have custom colors (primary/secondary), logos, images, and dynamic sections like WiFi, Rules, FAQs, etc.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Is there a mobile app?</h2>
            <p class="text-gray-700 mt-1">No installation needed. Welcomy works as a mobile-first progressive web app (PWA) that guests can open with a simple link or QR code.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">How do I create a new property?</h2>
            <p class="text-gray-700 mt-1">After logging in, go to the dashboard and click “Create New Property.” You can then enter all relevant details and customize the sections.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">How do I upload my logo and photos?</h2>
            <p class="text-gray-700 mt-1">Welcomy integrates with Cloudinary. You can upload your logo and up to 10 gallery images per property through the admin panel.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Can I embed my Welcomy page on my website?</h2>
            <p class="text-gray-700 mt-1">Each property has a unique URL (e.g. <code>https://mydomain.com/mantouki</code>). You can embed that or use an iframe if needed.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Can guests leave reviews?</h2>
            <p class="text-gray-700 mt-1">Yes. Through the Reviews section, you can redirect guests to Airbnb, Booking, Google Maps, or any review platform of your choice.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Is my content secure?</h2>
            <p class="text-gray-700 mt-1">Yes. All user content is stored securely on our platform with proper authentication and authorization in place.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Who can I contact for support?</h2>
            <p class="text-gray-700 mt-1">You can use the <a href="{{ url('/contact') }}" class="text-primary underline">Contact page</a> to reach out or email us at <a href="mailto:armenisnick@gmail.com" class="text-primary underline">armenisnick@gmail.com</a>.</p>
        </div>
    </div>
</div>
@endsection
