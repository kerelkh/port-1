<div class="w-full bg-slate-100 mt-10">
    <div class="w-full sm:w-4/6 mx-auto px-2 sm:px-8 py-10">
        <h2 class="text-2xl sm:text-3xl font-semibold mb-3">Get in touch.</h2>
        <p class="mb-10 text-lg sm:text-xl">For business inquire, please contact me below.</p>
        @if(session('send-message'))
        <x-message-notice type="message" :value="session('send-message')"></x-message-notice>
        @endif
        <div class="bg-white shadow-lg rounded-lg grid grid-cols-1 sm:grid-cols-2">
            <div class="col-span-1 h-full p-5">
                <h3 class="text-lg font-semibold mb-5">Send me a Message</h3>
                <form action="{{ route('send-message') }}" method="POST">
                    @csrf
                    <div class="flex flex-col space-y-1 mb-2">
                        <label for="email" class="text-sm text-gray-800 font-semibold">Email</label>
                        <input type="email" name="email" id="email" placeholder="example@gmail.com" class="rounded-lg outline-none bg-transparent border border-gray-400 p-2 placeholder:italic">
                    </div>
                    <div class="flex flex-col space-y-1 mb-5">
                        <label for="message" class="text-sm text-gray-800 font-semibold">Message</label>
                        <textarea name="message" id="message" cols="30" rows="10" style="resize: none" class="rounded-lg outline-none p-2 border border-gray-400 placeholder:italic" placeholder="Write your message here..."></textarea>
                    </div>
                    <button type="submit" class="w-full sm:w-fit px-4 py-2 rounded bg-blue-500 hover:bg-blue-600 text-gray-100">Send Message</button>
                </form>
            </div>
            <div class="col-span-1 h-full p-5 bg-[#183153] text-gray-100">
                <h3 class="text-2xl w-full sm:w-3/4 mx-auto font-semibold mb-5">Contact Information.</h3>
                <div class="flex flex-col justify-start sm:justify-center w-full sm:w-3/4 mt-10 sm:mt-24 mx-auto">
                    <p class="text-base sm:text-lg mb-3 capitalize"><i class="fa-solid fa-location-pin"></i> {{ auth()->user()->address ?? '-' }}</p>
                    <p class="text-base sm:text-lg mb-3"><i class="fa-solid fa-envelope"></i> {{ auth()->user()->email ?? '-'}}</p>
                    <p class="text-base sm:text-lg mb-3"><i class="fa-solid fa-phone"></i> +{{ auth()->user()->phone ?? '-' }}</p>
                </div>
            </div>
        </div>
</div>
