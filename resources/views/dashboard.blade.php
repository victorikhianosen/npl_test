@extends('layouts.app')

@section('main')
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Dashboard</h1>

        <div class="flex flex-wrap">
            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Latest Reports
                </p>
                <div class="bg-white overflow-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/7">Name</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/7">Author</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/7">ISBN</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/7">Page Number</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/7">Publisher</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/7">Year Published</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-1/7">Files</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-700">
                            @if ($books && count($books) > 0)
                                @foreach ($books as $book)
                                    <tr class="{{ $loop->even ? 'bg-gray-200' : '' }}">
                                        <td class="text-left py-3 px-4 w-1/7">{{ $book->name }}</td>
                                        <td class="text-left py-3 px-4 w-1/7">{{ $book->author }}</td>
                                        <td class="text-left py-3 px-4 w-1/7">{{ $book->isbn }}</td>
                                        <td class="text-left py-3 px-4 w-1/7">{{ $book->page_number }}</td>
                                        <td class="text-left py-3 px-4 w-1/7">{{ $book->publisher }}</td>
                                        <td class="text-left py-3 px-4 w-1/7">{{ $book->year_published }}</td>
                                        <td class="text-left py-3 px-4 w-1/7">
                                            @if ($book->file)
                                                @php
                                                    $files = json_decode($book->file, true); // Try decoding as JSON
                                                @endphp

                                                @if (json_last_error() === JSON_ERROR_NONE && is_array($files))
                                                    {{-- If it's a valid JSON array, loop through each file --}}
                                                    @foreach ($files as $file)
                                                        <a href="{{ asset($file) }}" class="text-blue-500 hover:underline" download>Download PDF</a><br>
                                                    @endforeach
                                                @else
                                                    {{-- If it's not JSON or it's a single string, display it as a single file --}}
                                                    <a href="{{ asset($book->file) }}" class="text-blue-500 hover:underline" download>Download PDF</a>
                                                @endif
                                            @else
                                                <span>No File</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-3">No books available.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
