<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit User</h2>

        @if(session('error'))
            <div class="bg-red-500 text-white p-2 mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" value="{{ $user->name }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name" class="w-full border p-2 rounded" value="{{ $user->last_name }}">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Phone</label>
                <input type="text" name="phone" class="w-full border p-2 rounded" value="{{ $user->phone }}">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" value="{{ $user->email }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Role</label>
                <select name="role" class="w-full border p-2 rounded" required>
                    <option value="worker" {{ $user->role == 'worker' ? 'selected' : '' }}>Worker</option>
                    @if(auth()->user()->role === 'admin')
                        <option value="office_manager" {{ $user->role == 'office_manager' ? 'selected' : '' }}>Office Manager</option>
                    @endif
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white w-full p-2 rounded">Update User</button>
        </form>

        <a href="{{ route('users.index') }}" class="block text-center bg-gray-500 text-white p-2 mt-4 rounded">Cancel</a>
    </div>
</body>
</html>
