<?php

namespace App\Http\Controllers;

use App\Actions\OptimizeWebpImageAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PuppyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        return Inertia::render('puppies/index', [
           'puppies' => PuppyResource::collection(
               Puppy::query()
                   ->when($search, function ($query, $search) {
                       $query->where('name', 'like', "%{$search}%")
                           ->orWhere('trait', 'like', "%{$search}%");
                   })
                   ->with(['user', 'likedBy'])
                   ->latest()
                   ->paginate(6)
                   ->withQueryString()
           ),
            'likedPuppies' => $request->user() ? PuppyResource::collection($request->user()->likedPuppies) : [],
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function store(Request $request)
    {
        sleep(2);

        $request->validate([
           'name' => 'required|string|max:255',
           'trait' => 'required|string|max:255',
           'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $image_url = null;
        if ($request->hasFile('image')) {

            $optimized = (new OptimizeWebpImageAction())->handle($request->file('image'));

            $path = 'puppies/' . $optimized['fileName'];

            $stored = Storage::disk('public')->put($path, $optimized['webpString']);

            if (!$stored) {
                return back()->withErrors(['image' => 'Failed to upload image.']);
            }
            $image_url = Storage::url($path);
        }

        $request->user()->puppies()->create([
            'name' => $request->name,
            'trait' => $request->trait,
            'image_url' => $image_url,
        ]);

        return redirect()->route('home', ['page' => 1])->with('success', 'Puppy created successfully.');
    }

    public function destroy(Request $request, Puppy $puppy)
    {
        sleep(2);

        $imagePath = str_replace('/storage', '', $puppy->image_url);

        if ($request->user()->cannot('delete', $puppy)) {
            return back()
                ->withErrors(['error' => 'You do not have permission to delete this puppy.']);
        }

        $puppy->delete();

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()
            ->route('home', ['page' => 1])
            ->with('success', 'Puppy deleted successfully.');
    }

    public function update(Request $request, Puppy $puppy)
    {
        sleep(2);

        $request->validate([
            'name' => 'required|string|max:255',
            'trait' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        if ($request->hasFile('image')) {

            $oldImagePath = str_replace('/storage', '', $puppy->image_url);

            $optimized = (new OptimizeWebpImageAction())->handle($request->file('image'));

            $path = 'puppies/' . $optimized['fileName'];

            $stored = Storage::disk('public')->put($path, $optimized['webpString']);

            if (!$stored) {
                return back()->withErrors(['image' => 'Failed to upload image.']);
            }

            $puppy->image_url = Storage::url($path);

            if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }

        $puppy->name = $request->name;
        $puppy->trait = $request->trait;

        $puppy->save();

        return back()->with('success', 'Puppy updated successfully.');
    }

    public function like(Request $request, Puppy $puppy)
    {
        $puppy->likedBy()->toggle($request->user()->id);

        return back();
    }
}
