<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
 
</head>
<body class="bg-gray-100">
<div class="max-w-xl py-16">
        <h1 class="text-3xl font-bold mb-8">File Upload</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 py-3 px-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="container">
            <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data" class="mb-8">
                @csrf
            
                <div class="flex flex-col items-center mb-4 file-upload">
                    <input type="file" name="files[]" multiple accept=".jpg,.jpeg,.png,.pdf" class="py-2 px-4 border border-gray-300 rounded mb-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload</button>
                </div>
                @error('files')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </form>
        </div>

        <div class="file-container">
            @forelse ($files as $file)
                <div class="file-card">
                    @if (in_array(strtolower(pathinfo($file->path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ Storage::url($file->path) }}" alt="{{ $file->name }}">
                    @else
                        <div class="bg-gray-200 rounded-full flex items-center justify-center w-16 h-16 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-8 w-8 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                    @endif
                    <h3>{{ $file->name }}</h3>
                    <a href="{{ Storage::url($file->path) }}" target="_blank" class="text-blue-500 hover:underline">View File</a>
                    <form action="{{ route('files.destroy', $file) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                </div>
            @empty
                <p class="text-gray-700">No files uploaded yet.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
