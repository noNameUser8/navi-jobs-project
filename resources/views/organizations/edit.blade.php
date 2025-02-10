<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Organization</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit Organization</h2>

        @if(session('error'))
            <div class="bg-red-500 text-white p-2 mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('organizations.update', $organization->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" value="{{ $organization->name }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" class="w-full border p-2 rounded">{{ $organization->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">City</label>
                <input type="text" name="city" class="w-full border p-2 rounded" value="{{ $organization->city }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Address</label>
                <input type="text" name="address" class="w-full border p-2 rounded" value="{{ $organization->address }}" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white w-full p-2 rounded">Update Organization</button>
        </form>

        <a href="{{ route('organizations.index') }}" class="block text-center bg-gray-500 text-white p-2 mt-4 rounded">Cancel</a>
    </div>
</body>
</html>
