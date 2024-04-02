<x-app-layout :assets="$assets ?? []">
    <!-- Edit User Form -->
     <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="col-span-1 lg:col-span-2">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold">Edit User</h5>
                    </div>
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" class="form-input mt-1 block w-full" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                            <input type="email" class="form-input mt-1 block w-full" id="email" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number:</label>
                            <input type="text" class="form-input mt-1 block w-full" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="role_id" class="block text-sm font-medium text-gray-700">Role:</label>
                            <select class="form-select mt-1 block w-full" id="role_id" name="role_id" required>
                                <option value="">Select a role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Edit User Form -->
</x-app-layout>
