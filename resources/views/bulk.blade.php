@extends('layouts.app')

@section('main')
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Bulk Book Entry</h1>

        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                <p class="text-xl pb-6 flex items-center">
                    <i class="fas fa-list mr-3"></i> Book Upload Form
                </p>

                <div class="leading-loose">
                    <form class="p-10 bg-white rounded shadow-xl" action="{{ route('bulk') }}" method="POST"
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
                        <!-- PDF Upload -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="file">PDF Files</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="file" name="file[]"
                                type="file" aria-label="file" multiple required>
                            @error('file.*')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="block text-sm text-gray-600" for="image">Image Files (Optional)</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="image" name="image[]"
                                type="file" aria-label="image" multiple>
                            @error('image.*')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- File and Image Preview -->
                        <div class="pt-4">
                            <div id="file-previews" class="flex flex-wrap mb-2"></div>
                            <p class="text-sm text-gray-600" id="file-name">No files chosen</p>
                        </div>

                        <div class="pt-4">
                            <div id="image-previews" class="flex flex-wrap mb-2"></div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- File preview script -->
    <script>
        function showFilePreview() {
            const fileInput = document.getElementById('file');
            const fileNameDisplay = document.getElementById('file-name');
            const filePreviews = document.getElementById('file-previews');
            const imageInput = document.getElementById('image');
            const imagePreviews = document.getElementById('image-previews');

            // Clear previous previews
            filePreviews.innerHTML = '';
            imagePreviews.innerHTML = '';

            // File previews
            if (fileInput.files.length > 0) {
                for (let i = 0; i < fileInput.files.length; i++) {
                    const file = fileInput.files[i];
                    const para = document.createElement('p');
                    para.textContent = file.name;
                    filePreviews.appendChild(para);
                }
                fileNameDisplay.textContent = fileInput.files.length + " files chosen";
            } else {
                fileNameDisplay.textContent = 'No files chosen';
            }

            // Image previews
            if (imageInput.files.length > 0) {
                for (let i = 0; i < imageInput.files.length; i++) {
                    const file = imageInput.files[i];
                    const fileType = file.type;

                    if (fileType.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList = 'w-24 h-24 object-cover m-2'; // Add some margin
                            imagePreviews.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        }

        document.getElementById('file').addEventListener('change', showFilePreview);
        document.getElementById('image').addEventListener('change', showFilePreview);
    </script>
@endsection
