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


                         {{-- add check if role == 1 --}}
                         @if(auth()->user()->role_id == 1)

                        <div class="mb-4">
                            <label for="entity_id" class="block text-sm font-medium text-gray-700">Business:</label>
                            <select class="select2 form-select mt-1 block w-full" id="entity_id" name="entity_id" required>
                                <option value="">Select a Business</option>
                                @foreach($entities as $entity)
                                    <option value="{{ $entity->id }}" {{ $user->entity_id == $entity->id ? 'selected' : '' }}>{{ $entity->EntityName }}</option>
                                @endforeach
                            </select>
                        </div>


                        @endif  

                        <div class="mb-4">
                            <label for="department_id" class="block text-sm font-medium text-gray-700">Service Point:</label>
                            <select class="select2 form-select mt-1 block w-full" id="department_id" name="department_id" required>
                                <option value="">Select a Service Point</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
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


{{-- select2 script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{-- select2 css --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        $('#role_id').select2();
        $('#entity_id').select2();
        $('#department_id').select2();
    });
</script>

