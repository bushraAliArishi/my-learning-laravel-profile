<x-layout title="{{ $title }}">
    <x-slot:heading>{{ $heading }}</x-slot:heading>
    <section
        class="pt-28 min-h-screen
         bg-gradient-to-b from-blue-50 to-white
         flex items-center justify-center text-center
         text-gray-900"
    >
        <div
            class="bg-gradient-to-br from-slate-900 to-gray-800 min-h-screen flex items-center justify-center text-white">
            <div class="bg-gray-900 rounded-2xl shadow-lg p-8 w-full max-w-md">
                <h1 class="text-3xl font-bold text-center mb-2">Contact Us</h1>
                <p class="text-sm text-gray-400 text-center mb-6">
                    Please fill the form below to reach out to us.
                </p>

                <form action="/submit-contact" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm text-gray-300 mb-1">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div>
                        <label for="email" class="block text-sm text-gray-300 mb-1">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <div>
                        <label for="message" class="block text-sm text-gray-300 mb-1">Message</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="4"
                            required
                            class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        ></textarea>
                    </div>

                    <div class="text-center">
                        <button
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 transition duration-200 text-white font-medium py-2 rounded-md"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>
