<x-app-layout :assets="$assets ?? []">
    <!-- Create Role Form -->
   <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1">
            <div class="col-span-1 md:col-span-3">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name<span class="text-red-500">*</span></label>
                                <input type="text" class="form-input mt-1 block w-full" id="name" name="name" required placeholder="Enter role name">
                                <div class="invalid-feedback">
                                    Please provide a name.
                                </div>
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <input type="text" class="form-input mt-1 block w-full" id="description" name="description" placeholder="Enter role description">
                                <div class="invalid-feedback">
                                    Please provide a description.
                                </div>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Permissions</label>
                                <!--permissions-->
                                <ul>
                                    @foreach ($roles as $key => $value)
                                    <li style="padding-left: 20px;"> <!-- Adjust padding as needed -->
                                        <input type="checkbox" name="permissions_menu[]" id="" value="{{ $key }}" <?= in_array($key, $permissions) ? "checked" : "" ?>>
                                        <span class="font-bold text-lg">{{ $key }}</span>
                                        @if (is_array($value) && !empty($value))
                                        <ul>
                                            @foreach ($value as $key1 => $value1)
                                            <li style="padding-left: 20px;"> <!-- Adjust padding as needed -->
                                                <input type="checkbox" name="permissions_menu[]" id="" value="{{ $key1 }}" <?= in_array($key, $permissions) ? "checked" : "" ?>>
                                                <span class="font-bold text-base">{{ $key1 }}</span>
                                                @if (is_array($value1) && count($value1))
                                                <ul>
                                                    @foreach ($value1 as $item)
                                                    <li style="padding-left: 20px;"> <!-- Adjust padding as needed -->
                                                        <input type="checkbox" name="permissions_menu[]" id="" value="{{ $item }}" <?= in_array($key, $permissions) ? "checked" : "" ?>>
                                                        <span>{{ $item }}</span><br>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                <!--permissions-->
                            </div>
                            <div class="col-span-2">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" type="submit">Add Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create Role Form -->
</x-app-layout>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>


<script>
    // jQuery Code starts from here

    $(function() {
        $("input[type='checkbox']").change(function() {
            $(this).siblings('ul')
                .find("input[type='checkbox']")
                .prop('checked', this.checked);

        });
    });
</script>
