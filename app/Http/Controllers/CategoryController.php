<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get category data and put in a variable
        $categories = Category::all();
        // direct user to category management main page
        return view('admin.categories.index', [
            // give all categories to view
            'categories' => $categories
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // directs user to create view when accessing the link
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data. 
        // The 'name' field is required, must be a string, and can be up to 225 characters.
        // The 'icon' field is required, must be an image, and must be one of the following types: png, jpg, svg.
        $validated = $request->validate([
            'name' => 'required|string|max:225',
            'icon' => 'required|image|mimes:png,jpg,svg',
        ]);
    
        // Begin a new database transaction. If any error occurs, 
        // the database operations within this block will be rolled back.
        DB::beginTransaction();
    
        try {
            // Check if an icon file was uploaded with the request.
            if ($request->hasFile('icon')) {
                // Store the uploaded icon in the 'category_icons' directory within the public disk.
                // The path of the stored file is then saved to the $iconPath variable.
                $iconPath = $request->file('icon')->store('category_icons', 'public');
                // Add the path of the stored icon to the validated data array.
                $validated['icon'] = $iconPath;
            }
    
            // Generate a URL-friendly slug from the 'name' field and add it to the validated data array.
            $validated['slug'] = Str::slug($request->name);
            
            // Create a new category in the database using the validated data.
            $newCategory = Category::create($validated);
    
            // Commit the transaction to save the data
            DB::commit();

            // If everything is successful, redirect the user to the categories index page.
            return redirect()->route('admin.categories.index');
    
        } catch (\Exception $e) {
            // If an exception occurs during the database transaction, this block will be executed.
            // Any database changes made so far will be rolled back to maintain data integrity.
            DB::rollBack();
        
            // Create a ValidationException object with a custom error message.
            // The error message includes 'System error!' along with the exception message ($e->getMessage()) for debugging.
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
        
            // The custom ValidationException is thrown to stop further execution and notify the user/system.
            throw $error;
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // direct user to category edit
        return view('admin.categories.edit', [
            // give all categories to view
            'category' => $category
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the incoming request data. 
        // The 'name' field is required, must be a string, and can be up to 225 characters.
        // The 'icon' field is required, must be an image, and must be one of the following types: png, jpg, svg.
        $validated = $request->validate([
            'name' => 'required|string|max:225',
            'icon' => 'sometimes|image|mimes:png,jpg,svg',
        ]);
    
        // Begin a new database transaction. If any error occurs, 
        // the database operations within this block will be rolled back.
        DB::beginTransaction();
    
        try {
            // Check if an icon file was uploaded with the request.
            if ($request->hasFile('icon')) {
                // Store the uploaded icon in the 'category_icons' directory within the public disk.
                // The path of the stored file is then saved to the $iconPath variable.
                $iconPath = $request->file('icon')->store('category_icons', 'public');
                // Add the path of the stored icon to the validated data array.
                $validated['icon'] = $iconPath;
            }
    
            // Generate a URL-friendly slug from the 'name' field and add it to the validated data array.
            $validated['slug'] = Str::slug($request->name);
            
            // Create a new category in the database using the validated data.
            $category->update($validated);
    
            // Commit the transaction to save the data
            DB::commit();

            // If everything is successful, redirect the user to the categories index page.
            return redirect()->route('admin.categories.index');
    
        } catch (\Exception $e) {
            // If an exception occurs during the database transaction, this block will be executed.
            // Any database changes made so far will be rolled back to maintain data integrity.
            DB::rollBack();
        
            // Create a ValidationException object with a custom error message.
            // The error message includes 'System error!' along with the exception message ($e->getMessage()) for debugging.
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
        
            // The custom ValidationException is thrown to stop further execution and notify the user/system.
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            //delete the selected category
            $category->delete();
            //go back to previous page
            return redirect()->back();
        } catch (\Exception $e) {
            // If an exception occurs during the database transaction, this block will be executed.
            // Any database changes made so far will be rolled back to maintain data integrity.
            DB::rollBack();
        
            // Create a ValidationException object with a custom error message.
            // The error message includes 'System error!' along with the exception message ($e->getMessage()) for debugging.
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
        
            // The custom ValidationException is thrown to stop further execution and notify the user/system.
            throw $error;
        }
    }
}
