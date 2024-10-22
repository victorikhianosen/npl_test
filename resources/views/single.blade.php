@extends('layouts.app')

@section('main')
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Single Book Entry</h1>

        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                <p class="text-xl pb-6 flex items-center">
                    <i class="fas fa-list mr-3"></i> Book Upload Form
                </p>

                <div class="leading-loose">
                    <form class="p-10 bg-white rounded shadow-xl" action="{{ route('books.single') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf <!-- CSRF token for security -->

                        <!-- Book Name -->
                        <div class="pt-4">
                            <label class="block text-sm text-gray-600" for="name">Book Name</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name"
                                type="text" placeholder="Book Name" aria-label="Name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div class="pt-4">
                            <label class="block text-sm text-gray-600" for="author">Author</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="author" name="author"
                                type="text" placeholder="Author Name" aria-label="Author" value="{{ old('author') }}">
                            @error('author')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- ISBN -->
                        <div class="pt-4">
                            <label class="block text-sm text-gray-600" for="isbn">ISBN</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="isbn" name="isbn"
                                type="text" placeholder="ISBN Number" aria-label="ISBN" value="{{ old('isbn') }}">
                            @error('isbn')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Page Number -->
                        <div class="pt-4">
                            <label class="block text-sm text-gray-600" for="page_number">Page Number</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="page_number"
                                name="page_number" type="number" placeholder="Number of Pages" aria-label="Page Number"
                                value="{{ old('page_number') }}">
                            @error('page_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Publisher -->
                        <div class="pt-4">
                            <label class="block text-sm text-gray-600" for="publisher">Publisher</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="publisher"
                                name="publisher" type="text" placeholder="Publisher Name" aria-label="Publisher"
                                value="{{ old('publisher') }}">
                            @error('publisher')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Year Published -->
                        <div class="pt-4">
                            <label class="block text-sm text-gray-600" for="year_published">Year Published</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="year_published"
                                name="year_published" type="number" placeholder="Year Published"
                                aria-label="Year Published" value="{{ old('year_published') }}">
                            @error('year_published')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Book Cover Image Upload -->
                        <div class="pt-4">
                            <label class="block text-sm text-gray-600" for="image">Book Cover Image</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="image" name="image"
                                type="file" aria-label="Image" onchange="showFilePreview()">
                            @error('image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- PDF Upload -->
                        <div class="pt-4">
                            <label class="block text-sm text-gray-600" for="file">PDF File</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="file" name="file"
                                type="file" aria-label="file">
                            @error('file')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image and File preview section -->
                        <div class="pt-4">
                            <img id="image-preview" class="w-24 h-24 object-cover hidden" alt="Image Preview">
                            <p class="text-sm text-gray-600" id="file-name">No file chosen</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- File preview script -->
    <script>
        function showFilePreview() {
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');
            const fileInput = document.getElementById('file');
            const fileNameDisplay = document.getElementById('file-name');

            // Image preview
            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const fileType = file.type;

                if (fileType.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.classList.add('hidden');
                }
            } else {
                imagePreview.classList.add('hidden');
            }

            // File name display
            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = fileInput.files[0].name;
            } else {
                fileNameDisplay.textContent = 'No file chosen';
            }
        }
    </script>
@endsection
