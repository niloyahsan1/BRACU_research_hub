<x-app-layout>
    <x-slot name="header">
       
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('admin Dashboard') }}
        </h2>



    <div class="py-6 px-4">
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border">
            <thead>
                <tr>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Role</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">
                            <form method="POST" action="{{ route('admin.users.updateRole', $user) }}">
                                @csrf
                                <select name="role" onchange="this.form.submit()" class="border rounded p-1">
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="researcher" {{ $user->role === 'researcher' ? 'selected' : '' }}>Researcher</option>
                                    <option value="reviewer" {{ $user->role === 'reviewer' ? 'selected' : '' }}>Reviewer</option>
                                </select>
                            </form>
                        </td>
                        <td class="border p-2" style="text-align: center;">
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class=" text-black px-3 py-1 rounded" style="background-color: red;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-2">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    </x-slot>
</x-app-layout>

