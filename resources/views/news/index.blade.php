<x-app-layout>
    <x-slot name="header">
        <div class="toolbar" style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New list') }}
            </h2>

            <a href="{{ route('new.create') }}">Create New</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Start_at</th>
                                <th scope="col">End_at</th>
                                <th scope="col">Is_suspension</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $new)
                            <tr>
                                <th scope="row">{{ $new->id }}</th>
                                <td>{{ $new->name }}</td>
                                <td>{{ $new->start_at }}</td>
                                <td>{{ $new->end_at }}</td>
                                <td>{{ $new->is_suspension }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

