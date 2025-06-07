<?php

namespace App\Http\Controllers;

use App\Actions\UploadRecommendationImageAction;
use App\Models\Property;
use App\Models\Recommendation;
use App\Models\RecommendationCategory;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecommendationController extends Controller
{
    public function __construct(protected UploadRecommendationImageAction $uploadImageAction) {}

    public function index(Property $property)
    {
        $user = auth()->user();

        $recommendations = $user->recommendations()->with('category')->get();
        $selected = $property->recommendations()->pluck('recommendations.id')->toArray();

        return view('recommendations.index', compact('property', 'recommendations', 'selected'));
    }

    public function create()
    {
        $categories = RecommendationCategory::all();

        return view('recommendations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
            'website_url' => 'nullable|url',
            'directions_url' => 'nullable|url',
            'category_id' => 'required|exists:recommendation_categories,id',
        ]);

        $recommendation = auth()->user()->recommendations()->create($validated);

        if ($request->hasFile('image')) {
            $this->uploadImageAction->execute($request->file('image'), $recommendation);
        }

        return redirect()->route('recommendations.index')->with('success', 'Recommendation created!');

    }

    public function edit(Recommendation $recommendation)
    {
        $this->authorize('update', $recommendation); // ✅ Optional: policy check

        $categories = RecommendationCategory::all();

        return view('recommendations.edit', compact('recommendation', 'categories'));
    }

    public function update(Request $request, Recommendation $recommendation)
    {
        $this->authorize('update', $recommendation);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
            'website_url' => 'nullable|url',
            'directions_url' => 'nullable|url',
            'category_id' => 'required|exists:recommendation_categories,id',
        ]);

        $recommendation->update($validated);

        if ($request->hasFile('image')) {
            $this->uploadImageAction->execute($request->file('image'), $recommendation);
        }

        return redirect()->route('recommendations.index')->with('success', 'Recommendation created!');

    }

    public function destroy(Recommendation $recommendation)
    {
        $this->authorize('delete', $recommendation);

        // Αν υπάρχει εικόνα, σβήστη από το Cloudinary
        if ($recommendation->image_public_id) {
            try {
                app(Cloudinary::class)->uploadApi()->destroy($recommendation->image_public_id);
            } catch (\Exception $e) {
                // Optional: log error
                \Log::error('Failed to delete recommendation image from Cloudinary', [
                    'id' => $recommendation->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $recommendation->properties()->detach();
        $recommendation->delete();

        return redirect()->back()->with('success', 'Recommendation deleted!');
    }

    public function deleteImage(Recommendation $recommendation)
    {
        $this->authorize('update', $recommendation);

        if ($recommendation->image_public_id) {
            try {
                app(Cloudinary::class)->uploadApi()->destroy($recommendation->image_public_id);
            } catch (\Exception $e) {
            }
        }

        $recommendation->update([
            'image_url' => null,
            'image_public_id' => null,
        ]);

        return back()->with('success', 'Image removed.');
    }

    public function syncPropertyRecommendations(Request $request, Property $property)
    {
        $this->authorize('update', $property);

        $validated = $request->validate([
            'recommendation_ids' => 'array',
            'recommendation_ids.*' => 'exists:recommendations,id',
        ]);

        $property->recommendations()->sync($validated['recommendation_ids'] ?? []);

        return redirect()->back()->with('success', 'Recommendations updated for this property!');
    }
}
