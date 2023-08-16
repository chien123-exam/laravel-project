<x-app-layout>
    <x-slot name="header">
        <div class="toolbar" style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New list') }}
            </h2>

            <a href="{{ route('new.index') }}">Back New</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form method="post" action="{{ route('new.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="start_at" :value="__('Start_at')" />
                        <x-text-input id="start_at" name="start_at" type="text" class="mt-1 block w-full" :value="old('start_at')" />
                        <x-input-error class="mt-2" :messages="$errors->get('start_at')" />
                    </div>

                    <div>
                        <x-input-label for="end_at" :value="__('End_at')" />
                        <x-text-input id="end_at" name="end_at" type="text" class="mt-1 block w-full" :value="old('end_at')" />
                        <x-input-error class="mt-2" :messages="$errors->get('end_at')" />
                    </div>

                    <div>
                        <x-input-label for="is_suspension" :value="__('Is_suspension')" />
                        <x-text-input id="is_suspension" name="is_suspension" type="text" class="mt-1 block w-full" :value="old('is_suspension')" />
                        <x-input-error class="mt-2" :messages="$errors->get('is_suspension')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

