<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Imagen de perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Actualice su avatar si desea') }}
        </p>
    </header>

    <form method="post" action="{{ route('picture.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mt-6" align="center">
            <div class="grid grid-cols-2">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Actual') }}
                    </p>
                    <img class="h-32 w-32 rounded-full mt-2" src="{{ $picture }}" alt="{{ $name }}">
                </div>
                <div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Nuevo') }}
                    </p>
                    <img id="preview" class="h-32 w-32 rounded-full m-2"
                        src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg" alt="{{ $name }}">
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2 mt-3">
                <div>
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
                <div>
                    <input
                        class="block max-w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" name="picture" id="file_input" type="file">
                    <x-input-error class="mt-2" :messages="$errors->get('picture')" />

                </div>
            </div>
        </div>
    </form>
</section>
