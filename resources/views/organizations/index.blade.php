<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizations List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Organizations List</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">Name</th>
                    <th class="border border-gray-300 p-2">Description</th>
                    <th class="border border-gray-300 p-2">City</th>
                    <th class="border border-gray-300 p-2">Address</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($organizations as $organization)
                    <tr class="text-center">
                        <td class="border border-gray-300 p-2">{{ $organization->name }}</td>
                        <td class="border border-gray-300 p-2">{{ $organization->description ?? 'N/A' }}</td>
                        <td class="border border-gray-300 p-2">{{ $organization->city }}</td>
                        <td class="border border-gray-300 p-2">{{ $organization->address }}</td>
                        <td class="border border-gray-300 p-2">
                            @if(auth()->user()->role === 'admin' || auth()->user()->organization_id === $organization->id)
                                <a href="{{ route('organizations.edit', $organization->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                            @endif
                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('dashboard') }}" class="block text-center bg-blue-500 text-white p-2 mt-4 rounded">Back to Dashboard</a>
    </div>
</body>
</html>
