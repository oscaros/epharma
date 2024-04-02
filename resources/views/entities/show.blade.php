<x-app-layout :assets="$assets ?? []">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Entity Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Entity Name:</strong> {{ $entity->name }}
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
