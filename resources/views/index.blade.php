<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<body>
    <header
        class='flex shadow-md py-4 px-4 sm:px-10 bg-white font-[sans-serif] min-h-[70px] tracking-wide relative z-50'>
        <div class='flex flex-wrap items-center justify-between gap-5 w-full'>
            <div class="italic">
               <a href="{{ route('home') }}"> NLP</a>
            </div>
       


            <div class='flex max-lg:ml-auto space-x-3'>
                <a href="{{ route('login') }}"
                    class='px-4 py-2 text-sm rounded-full font-bold text-white border-2 border-[#007bff] bg-[#007bff] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#007bff]'>Login</a>
                <a href="{{ route('register') }}"
                    class='px-4 py-2 text-sm rounded-full font-bold text-white border-2 border-[#007bff] bg-[#007bff] transition-all ease-in-out duration-300 hover:bg-transparent hover:text-[#007bff]'>Sign
                    up</a>

         
            </div>
        </div>
    </header>




 <div class="font-[sans-serif] bg-gray-100">
    <div class="p-4 mx-auto lg:max-w-7xl sm:max-w-full">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-12">Book Collection</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 max-xl:gap-4 gap-6">
            @if ($books && $books->isNotEmpty())
                @foreach ($books as $book)
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full" src="{{ asset($book->image) }}" alt="{{ $book->name }}">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $book->name }}</div>
                            <p class="text-gray-700 text-base mb-1"><strong>Author:</strong> {{ $book->author }}</p>
                            <p class="text-gray-700 text-base mb-1"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                            <p class="text-gray-700 text-base mb-1"><strong>Pages:</strong> {{ $book->page_number }}</p>
                            <p class="text-gray-700 text-base mb-1"><strong>Publisher:</strong> {{ $book->publisher }}</p>
                            <p class="text-gray-700 text-base mb-1"><strong>Year Published:</strong> {{ $book->year_published }}</p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <a href="{{ asset($book->file) }}" target="_blank" class="inline-block bg-blue-500 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2 hover:bg-blue-700">
                                View Book
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No books available.</p>
            @endif
        </div>
    </div>
</div>







</body>

</html>
