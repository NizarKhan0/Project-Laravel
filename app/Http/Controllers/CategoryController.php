<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.category', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:categories|string|max:100',
            // Add more validation rules if needed
        ]);

        // Create a new category
        $category = new Category;
        $category->name = $request->name;
        // Set other attributes if needed

        // Save the category
        $category->save();

        // Redirect or respond as needed & Flash message
        return redirect()->route('categories')->with('success', 'New genre added successfully.');

    }

    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // For change slug name on update
        $category->slug = null;

        // Validate the request data
        $request->validate([
            // This is for if the user just clicks the update button but no data changes
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            // Add more validation rules as needed
        ]);

        // Update the category
        $category->update([
            'name' => $request->name,
            // Update other attributes as needed
        ]);

        // Redirect or respond as needed
        return redirect()->route('categories')->with('success', 'Genre updated successfully.');

    }

    public function softDelete($slug)
    {
        // Find the category by its slug
        $category = Category::where('slug', $slug)->first();

        // Check if the category exists
        if (!$category) {
            // Handle the case where the category is not found, e.g., redirect back with a message
            return redirect()->route('categories')->with('error', 'Category not found.');
        }

        // Soft delete the category
        $category->delete();

        // You can redirect back or to any other route after successful deletion
        return redirect()->route('categories')->with('status', 'Category soft deleted successfully.');

    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();

        if ($category) {
            $category->restore();
            return redirect()->route('categories')->with('status', 'Category restored successfully.');
        } else {
            return redirect()->route('categories')->with('error', 'Category not found for restoration.');
        }

    }
}