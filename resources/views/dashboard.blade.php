<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-96 text-center">
        <h2 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h2>

        @if(auth()->user()->role === 'office_manager' && !auth()->user()->organization_id)
            <div class="bg-red-500 text-white p-2 mb-4 text-center">
                You must <a href="{{ route('organizations.create') }}" class="underline">create an organization</a> before adding users.
            </div>
        @endif

        @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'office_manager' && auth()->user()->organization_id))
            <a href="{{ route('users.create') }}" class="bg-blue-500 text-white w-full p-2 rounded block mb-4 text-center">Add New User</a>
        @else
            <button class="bg-gray-400 text-white w-full p-2 rounded block mb-4 text-center cursor-not-allowed opacity-50" disabled>Add New User</button>
        @endif

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'office_manager')
            <a href="{{ route('users.index') }}" class="bg-green-500 text-white w-full p-2 rounded block mb-4 text-center">View all users</a>
        @endif

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'office_manager')
            <a href="{{ route('organizations.create') }}" class="bg-green-500 text-white w-full p-2 rounded block mb-4 text-center">Create Organization</a>
        @endif

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'office_manager')
            <a href="{{ route('organizations.index') }}" class="bg-purple-500 text-white w-full p-2 rounded block mb-4 text-center">View Organizations</a>
        @endif

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white w-full p-2 rounded">Logout</button>
        </form>
    </div>
</body>
</html>
