<x-app-layout>
    <x-slot name="header">
        <div class="toolbar" style="display: flex; justify-content:space-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('News List') }}
            </h2>
            <a href="{{ route('news.create') }}">Create new</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="form-search">
                <form action="{{ route('news.index')}}" method="get" class="form-control">
                    <input type="text" placeholder="Search by name" name="name" value="{{ request()->get('name')}}">
                    <button class="btn btn-primary">Search</button>
                </form>
            </div>
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr class="">
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Start_at</th>
                                <th scope="col">End_at</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $new)
                            <tr>
                            <th scope="row">{{ $new->id }}</th>
                            <td>{{ $new->name }}</td>
                            <td>{{ $new->start_at < now() ? 'Đang chờ đăng' : 'Đã đăng' }}</td>
                            <td>{{ $new->end_at < now() ? 'Đã hết hạn' : 'Còn hạn' }}</td>
                            <td>{{ $new->is_suspension == 1 ? 'Đã dừng' : 'Active' }}</td>
                            <td>
                                <a href="{{ route('news.edit', ['news' => $new->id]) }}">Edit</a>
                                <form method="POST" action="{{ route('news.destroy', ['news' => $new->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Xóa {{ $new->name }} ra khỏi danh sách ?')">Delete</button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tr>
                            <td colspan="5">{{ $news->links() }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
