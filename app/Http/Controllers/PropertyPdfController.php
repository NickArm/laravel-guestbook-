<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Barryvdh\DomPDF\Facade\Pdf;

class PropertyPdfController extends Controller
{
    public function generate(Property $property)
    {
        $property->load([
            'settings',
            'wifi',
            'faqs',
            'rules',
            'transportation',
            'images',
            'beforeYouGoNotes',
        ]);

        $pdf = Pdf::loadView('pdf.property-brochure', [
            'property' => $property,
        ]);

        return $pdf->stream("{$property->slug}-preview.pdf");
    }

    public function preview(Property $property)
    {
        $property->load([
            'settings', 'wifi', 'faqs', 'rules',
            'transportation', 'images', 'beforeYouGoNotes',
        ]);

        return view('pdf.property-brochure', compact('property'));
    }
}
