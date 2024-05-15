<!-- resources/views/audit_logs/index.blade.php -->

<x-app-layout :assets="$assets ?? []">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Audit Logs</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Description</th>
                                        <th>Event Type</th>
                                        <th>Business ID</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Loop through the audit logs data -->
                                    @foreach($auditLogs as $auditLog)
                                    <tr>
                                        <td>{{ $auditLog->id }}</td>
                                        <td>{{ $auditLog->user_id }}</td>
                                        <td>{{ $auditLog->description }}</td>
                                        <td>{{ $auditLog->event_type }}</td>
                                        <td>{{ $auditLog->business_id }}</td>
                                        <td>{{ $auditLog->date }}</td>
                                        <td>
                                            <!-- Add action buttons if needed -->
                                            <!-- Example: View Details button -->
                                            <a href="{{ route('audit_logs.show', $auditLog->id) }}" class="btn btn-primary btn-sm">View Details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
