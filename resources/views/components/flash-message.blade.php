    <div>
        @if (session('success'))
            <div class="fixed top-4 right-4 bg-green-500 text-white p-4 rounded shadow-lg transition-transform transform"
                id="flash-message" role="alert" style="display: none;">
                {{ session('success') }}
                <button class="close-btn text-white" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="fixed top-4 right-4 bg-red-500 text-white p-4 rounded shadow-lg transition-transform transform"
                id="flash-message" role="alert" style="display: none;">
                {{ session('error') }}
                <button class="close-btn text-white" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        <style>
            /* CSS for flash messages */
            #flash-message {
                opacity: 0;
                animation: slide-in 0.5s forwards;
            }

            @keyframes slide-in {
                from {
                    transform: translateY(-100%);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const flashMessage = document.querySelector('#flash-message');
                if (flashMessage) {
                    flashMessage.style.display = 'block'; // Show the message
                    // Automatically hide the flash message after 5 seconds
                    setTimeout(() => {
                        flashMessage.style.display = 'none';
                    }, 5000); // Adjust time as needed (5000ms = 5 seconds)
                }
            });
        </script>
    </div>