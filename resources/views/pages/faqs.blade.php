@extends('layouts.main')

@section('title', 'FAQs - Welcomy')
@section('meta_description', 'Contact')

@section('content')
<div class="flex grow">
    <div class="wrapper flex grow flex-col">
        @include('partials.header')
        @include('partials.navbar')

        <main class="grow content pt-5" id="content" role="content">
            <div class="container mx-auto py-12 max-w-2xl">
                <h1 class="text-3xl font-bold mb-6 text-center text-primary mb-4">Frequently Asked Questions</h1>

                <div class="space-y-4 divide-y divide-gray-200">
                    @php
                            $faqs = [
                                [
                                    'question' => 'What is Welcomy?',
                                    'answer' => 'Welcomy is a digital guestbook platform designed for hosts to provide personalized, mobile-friendly property guides to their guests.',
                                ],
                                [
                                    'question' => 'What types of properties can I use it for?',
                                    'answer' => 'Welcomy works for any type of short-term rental: apartments, villas, studios, Airbnbs, hotels, and even boats.',
                                ],
                                [
                                    'question' => 'What can guests see on my Welcomy page?',
                                    'answer' => 'Each property has its own guest page with sections like Welcome Message, Check-in/out instructions, WiFi, Amenities, House Rules, Local Recommendations, FAQs, and more — fully customizable.',
                                ],
                                [
                                    'question' => 'How do I create and manage my properties?',
                                    'answer' => 'Once you log in, you can create and manage properties from your dashboard. Each section is editable, and changes are saved instantly.',
                                ],
                                [
                                    'question' => 'How does the design customization work?',
                                    'answer' => 'You can define primary/secondary colors, upload your property logo, and choose which sections are enabled or hidden per property.',
                                ],
                                [
                                    'question' => 'Can I upload photos or a gallery?',
                                    'answer' => 'Yes, Welcomy supports a logo and up to 10 gallery images per property via our Cloudinary integration.',
                                ],
                                [
                                    'question' => 'Can I link to external content like reviews?',
                                    'answer' => 'Yes. The Reviews section lets you link to Google, Airbnb, Booking, or any external platform.',
                                ],
                                [
                                    'question' => 'Is there a mobile app?',
                                    'answer' => 'No app installation needed — Welcomy is a PWA (Progressive Web App) and works perfectly on all modern browsers and mobile devices.',
                                ],
                                [
                                    'question' => 'Can I use a custom domain or subdomain?',
                                    'answer' => 'Yes! Each property has a unique URL (e.g., `mantouki.welcomy.net` or `welcomy.net/mantouki`) which you can share via link or QR code.',
                                ],
                                [
                                    'question' => 'Can I embed my Welcomy page on my website?',
                                    'answer' => 'Absolutely. You can embed the guest view in your own site via iframe or direct URL.',
                                ],
                                [
                                    'question' => 'Is my data secure?',
                                    'answer' => 'Yes. We enforce authentication and authorization rules, and data is securely stored on our servers.',
                                ],
                                [
                                    'question' => 'Can I control which sections are visible?',
                                    'answer' => 'Yes, every optional section (WiFi, Rules, FAQs, etc.) can be enabled or disabled independently per property.',
                                ],
                                [
                                    'question' => 'How do I get started?',
                                    'answer' => 'Just sign up or log in, click "Create Property", and begin adding your content. It’s fast and intuitive!',
                                ],
                                [
                                    'question' => 'I need help. Who do I contact?',
                                    'answer' => 'Visit our <a href="' . url('/contact') . '" class="text-primary underline">Contact page</a> or email us at <a href="mailto:armenisnick@gmail.com" class="text-primary underline">armenisnick@gmail.com</a>.',
                                ],
                            ];
                    @endphp

                    <div class="space-y-4">
                        @foreach($faqs as $index => $faq)
                            <details class="bg-white border rounded shadow-sm p-4" @if($index === 0) open @endif>
                                <summary class="cursor-pointer font-medium text-lg text-gray-800">{{ $faq['question'] }}</summary>
                                <div class="mt-2 text-gray-600 leading-relaxed">{!! $faq['answer'] !!}</div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </div>
</div>
@endsection
