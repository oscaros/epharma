<x-app-layout :assets="$assets ?? []">
    <!-- Create Role Form -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}" class="row g-3 needs-validation" novalidate>
                            @csrf
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name*</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                placeholder="enter role name"
                                >
                                <div class="invalid-feedback">
                                    Please provide a name.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" 
                                name="description"
                                placeholder="enter role description"
                                >
                                <div class="invalid-feedback">
                                    Please provide a description.
                                </div>
                            </div>

                            {{-- choose a branch --}}
                            <div class="col-md-6">
                                <label for="branch_id" class="form-label">Entity</label>
                                <select class="form-select" id="entity_id" name="entity_id" required>
                                    <option value="" selected disabled>Select Entity</option>
                                    @foreach($entities as $entity)
                                    <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select an entity.
                                </div>
                            </div>

                            
                            <div class="col-md-12">
                                <label class="form-label">Permissions</label>
                                <!--permissions-->
                                <ul>
                                    @foreach ($roles as $key => $value)
                                    <li>
                                        <input type="checkbox" name="persmissions_menu[]" id="" value="{{ $key }}" <?= in_array($key, $permissions) ? "checked" : "" ?>>
                                        <span style="font-size:19px; font-weight:bold"><?= $key ?></span>
                                        @if (is_array($value) && !empty($value))
                                        <ul>

                                            @foreach ($value as $key1 => $value1)
                                            <li>
                                                <input type="checkbox" name="persmissions_menu[]" id="" value="{{ $key1 }}" <?= in_array($key, $permissions) ? "checked" : "" ?>>
                                                <span style="font-size:14px; font-weight:bold"><?= $key1 ?></span>
                                                @if (is_array($value) && count($value1))
                                                <ul>
                                                    @foreach ($value1 as $item)
                                                    <input type="checkbox" name="persmissions_menu[]" id="" value="{{ $item }}" <?= in_array($key, $permissions) ? "checked" : "" ?>>
                                                    <span style="font-size:14px;"><?= $item ?></span>
                                                    <br />
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
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Add Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create Role Form -->
</x-app-layout>


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