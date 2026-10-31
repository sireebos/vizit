<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        try {
            // Manual validation to return JSON on failure
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:20480',
            ], [
                'image.max' => 'The image must not be larger than 20MB.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first('image'),
                ], 422);
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                
                // Check if file is valid
                if (!$file->isValid()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'File upload failed: ' . $file->getErrorMessage(),
                    ], 400);
                }
                
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
                
                // Store in public/uploads directory
                $path = $file->storeAs('uploads', $filename, 'public');
                
                if (!$path) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to save file to storage',
                    ], 500);
                }
                
                return response()->json([
                    'success' => true,
                    'url' => '/storage/' . $path,
                    'path' => $path,
                    'filename' => $filename,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No file uploaded',
            ], 400);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload error: ' . $e->getMessage(),
            ], 500);
        }
    }
}

