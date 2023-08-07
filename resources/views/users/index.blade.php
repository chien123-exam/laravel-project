<x-app-layout>
    <x-slot name="header">
       <div class="toolbar" style="display: flex; justify-content: space-between;">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User list') }}
            </h2>

            <a href="{{ route('user.create') }}">Create new</a>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="form-search">
                    <form action="{{ route('user.index') }}" method="get">
                        <select name="family_id">
                            <option value=""></option>
                            @foreach( $families as $family)
                                <option value="{{ $family->id }}" {{ $family->id == request()->get('family_id') ? 'selected' : ''}}>{{ $family->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" placeholder="Your keyword" name="keyword" value="{{ request()->get('keyword') }}" />
                        <button class="btn-primary btn">Search</button>
                    </form>
                </div>
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Family Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userPaginate->items() as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    @if (!empty($user->avatar))
                                        <img src="{{ asset('storage/' . $user->avatar) }}" width="50" alt="Avatar">
                                    @else
                                        No avatar
                                    @endif
                                </td>
                                </td>
                                <td>{{ $user->user_type }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->family->name ?? null }}</td>
                                <td>{{ $user->gender_label }}</td>
                                <td>
                                    <a href="{{ route('user.edit', ['user' => $user->id]) }}">Edit</a> |
                                    <a href="{{ route('user.destroy', ['user' => $user->id]) }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <br />
                    <div>
                        {{ $userPaginate->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

