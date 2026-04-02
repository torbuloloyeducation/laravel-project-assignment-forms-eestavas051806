<x-layout title="Form Test">
    <div class="space-y-12">
        <div class="border-b border-white/10">
            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 p-10 bg-gray-800 rounded-lg">
                <div class="sm:col-span-4">

                    {{-- Task 5: Flash messages --}}
                    @if (session('success'))
                        <p class="text-green-400 text-sm mb-2">{{ session('success') }}</p>
                    @endif
                    @if (session('error'))
                        <p class="text-red-400 text-sm mb-2">{{ session('error') }}</p>
                    @endif
                    @if (session('warning'))
                        <p class="text-yellow-400 text-sm mb-2">{{ session('warning') }}</p>
                    @endif

                    {{-- Task 2: Validation error display --}}
                    @error('email')
                        <p class="text-red-400 text-sm mb-2">{{ $message }}</p>
                    @enderror

                    <form method="POST" action="/formtest">
                        @csrf
                        <label for="email" class="block text-sm/6 font-medium text-white">Email</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="email" type="email" name="email" placeholder="juandelacruz@umindanao.edu.ph" class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-white placeholder:text-gray-500 focus:outline-none sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-x-6 justify-end">
                            <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                        </div>
                    </form>

                    {{-- Task 6: Show count / limit warning --}}
                    <div class="mt-3 p-5">
                        <h2 class="text-lg font-semibold text-white">Emails ({{ count($emails) }}/5)</h2>
                        <ul>
                            @foreach ($emails as $index => $email)
                                <li class="text-sm p-1 flex items-center gap-2">
                                    {{ $email }}
                                    {{-- Task 4: Delete button per email --}}
                                    <form method="POST" action="/delete-email" class="inline">
                                        @csrf
                                        <input type="hidden" name="index" value="{{ $index }}">
                                        <button type="submit" class="text-red-400 text-xs hover:underline">Delete</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        @if (count($emails) > 0)
                            <a href="/delete-emails" class="text-red-400 text-xs mt-2 inline-block hover:underline">Delete All</a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layout>
