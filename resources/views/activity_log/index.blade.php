@extends('template.master')
@section('title', 'User')
@section('content')
    <div class="container">
        <h1>User Activity Log</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>By</th>
                    <th>Logged At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->causer->name ?? 'System' }}</td>
                        <td>{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Custom pagination links with only Previous, Next, and Numbers -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Previous Link -->
                @if ($activities->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $activities->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                @endif

                <!-- Pagination Numbers -->
                @for ($i = 1; $i <= $activities->lastPage(); $i++)
                    <li class="page-item {{ $i == $activities->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $activities->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <!-- Next Link -->
                @if ($activities->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $activities->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </nav>

        <!-- Option to view all logs -->
        <a href="{{ route('activity-log.all') }}" class="btn btn-primary">See All</a>
    </div>
@endsection
