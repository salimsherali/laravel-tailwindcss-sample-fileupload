<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('upload', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'files.required' => 'Please select at least one file.',
            'files.*.mimes' => 'Only JPG, JPEG, PNG, and PDF files are allowed.',
            'files.*.max' => 'The file size must not exceed 2MB.',
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
                $path = $file->store('public/uploads');
             


                File::create([
                    'name' => $name,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('files.index')->with('success', 'Files uploaded successfully.');
    }

    public function destroy(File $file)
    {
        Storage::delete($file->path);
        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully.');
    }
}