<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Add New User</h2>

        @if ($errors->any())
    <div class="bg-red-500 text-white p-2 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Phone</label>
                <input type="text" name="phone" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Role</label>
                <select name="role" class="w-full border p-2 rounded" required>
                    <option value="admin">Admin</option>
                    <option value="office_manager">Office Manager</option>
                    <option value="worker">Worker</option>
                    <option value="client">Client</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Organization</label>
                <input type="text" name="organization_id" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white w-full p-2 rounded">Add User</button>
        </form>
    </div>
</body>
</html>
