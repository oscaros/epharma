<x-app-layout :assets="$assets ?? []">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Update entities</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('businesses.update', $entity->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Entity Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $entity->name }}" required>
                            </div>
                            
                           
                            <!-- Add other fields as needed -->
                            <button type="submit" class="btn btn-primary">Edit Entity</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>