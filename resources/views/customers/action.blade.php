<div class="flex align-items-center list-business-action">

 <!-- View Action -->
    <a class="btn btn-sm btn-icon btn-info" data-bs-toggle="tooltip" title="View Customer" href="{{ route('customers.show', $id) }}">
        <span class="btn-inner">
            <!-- Eye Icon SVG -->
            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9431 2.5C17.2261 2.5 21.9431 10 21.9431 10C21.9431 10 17.2261 17.5 11.9431 17.5C6.66006 17.5 1.94306 10 1.94306 10C1.94306 10 6.66006 2.5 11.9431 2.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9431 14.5C10.4221 14.5 9.18806 13.266 9.18806 11.745C9.18806 10.224 10.4221 9 11.9431 9C13.4641 9 14.6981 10.234 14.6981 11.755C14.6981 13.276 13.4641 14.5 11.9431 14.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <circle cx="11.9431" cy="11.75" r="2.25" fill="currentColor"></circle>
            </svg>
            <!-- End of Eye Icon SVG -->
        </span>
       
        <span style="font-size: 10px;">
        view
        </span>
    </a>






    {{-- @if (Auth::user()->role->permissions->contains('name', 'Edit Customers')) --}}

    <!-- Edit Action -->
    <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" title="Edit Business" href="{{ route('customers.edit', $id) }}">
        <span class="btn-inner">
            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
       
        <span style="font-size: 10px;">edit</span>
    </a>
    {{-- @endif --}}

    <!-- Delete Action -->
    {{-- @if (Auth::user()->role->permissions->contains('name', 'Delete Customers')) --}}
    <a class="btn btn-sm btn-icon btn-danger" onclick="confirmDelete('{{ $id }}')" data-bs-toggle="tooltip" title="Delete Customer" href="#">
        <span class="btn-inner">
            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
      
        <span style="font-size: 10px; padding-bottom: 5px">delete</span>
    </a>
    {{-- @endif --}}

    <form action="{{ route('customers.destroy', $id) }}" id="Customer-delete-{{ $id }}" method="post">
        @method('delete')
        @csrf
    </form>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('customer-delete-' + id).submit();
                }
            });
        }
    </script>



    </a>

    <form action="{{ route('customers.destroy', $id) }}" id="customer-delete-{{$id}}" method="post">
        @method('delete')
        @csrf
    </form>


</div>