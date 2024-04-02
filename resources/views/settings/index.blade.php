@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
<x-app-layout :assets="$assets ?? []">
   <div>
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">{{ $pageTitle ?? 'List'}}</h4>
                  </div>
                  <div class="card-action">
                     {!! $headerAction ?? '' !!}
                  </div>

               </div>
               <div class="card-body px-4">
                  <div class="table-responsive">
                     {{ $dataTable->table() }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>