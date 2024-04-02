
 <x-app-layout :assets="$assets ?? []">
    <div class="col-sm-12 col-lg-12">
        <div class="card">

            <div class="card-body">
                <form method="POST" action="{{ route('entities.store') }}" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter entities name">
                        <div class="invalid-feedback">
                            Please provide a name.
                        </div>
                    </div>
                    

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Add Entity</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
