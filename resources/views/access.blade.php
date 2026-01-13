<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <div class="bg-white shadow-sm rounded-xl px-6 py-8">

            <h2 class="text-2xl font-semibold text-center text-gray-800">
                Access Gate
            </h2>

            <p class="mt-2 text-sm text-gray-500 text-center">
                Masukkan kode akses untuk masuk ke aplikasi
            </p>

            <form
                method="POST"
                action="{{ route('access.check') }}"
                class="mt-6 space-y-4"
            >
                @csrf

                <div>
                    <label for="code" class="sr-only">
                        Access Code
                    </label>

                    <input
                        id="code"
                        type="text"
                        name="code"
                        required
                        autofocus
                        placeholder="Access Code"
                        class="block w-full rounded-lg border-gray-300
                               focus:border-blue-500 focus:ring-blue-500"
                    />

                    @error('code')
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <br>
                   
                 
                <x-primary-button
                    type="submit"
                    class="w-full justify-center text-center"
                >
                    Masuk
                </x-primary-button>

            </form>

        </div>
    </div>
</x-guest-layout>
