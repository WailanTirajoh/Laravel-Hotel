@extends('template.master')
@section('title', 'Room Management')
@section('content')
    <div class="container-fluid">
        <!-- Add Room Button -->
        <div class="row mb-4">
            <div class="col-12">
                <button id="add-button" type="button" class="add-room-btn">
                    <i class="fas fa-plus"></i>
                    Add New Room
                </button>
            </div>
        </div>

        <!-- Table Container -->
        <div class="professional-table-container">
            <!-- Table Header -->
            <div class="table-header">
                <h4><i class="fas fa-bed me-2"></i>Room Management</h4>
                <p>Manage your hotel rooms, types, and availability status</p>
            </div>

            <!-- Filters Section -->
            <div class="filters-section">
                <div class="filters-title">
                    <i class="fas fa-filter"></i>
                    Filter Rooms
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-toggle-on me-1"></i>Status
                            </label>
                            <select id="status" class="form-select" aria-label="Choose status">
                                <option selected>All</option>
                                @forelse ($roomStatuses as $roomStatus)
                                    <option value="{{ $roomStatus->id }}">{{ $roomStatus->name }}</option>
                                @empty
                                    <option value="">No room status available</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="mb-3">
                            <label for="type" class="form-label">
                                <i class="fas fa-home me-1"></i>Type
                            </label>
                            <select id="type" class="form-select" aria-label="Choose type">
                                <option selected>All</option>
                                @forelse ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @empty
                                    <option value="">No room type available</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table id="room-table" class="professional-table table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">
                                <i class="fas fa-hashtag me-1"></i>Room Number
                            </th>
                            <th scope="col">
                                <i class="fas fa-home me-1"></i>Type
                            </th>
                            <th scope="col">
                                <i class="fas fa-users me-1"></i>Capacity
                            </th>
                            <th scope="col">
                                <i class="fas fa-dollar-sign me-1"></i>Price / Day
                            </th>
                            <th scope="col">
                                <i class="fas fa-info-circle me-1"></i>Status
                            </th>
                            <th scope="col">
                                <i class="fas fa-cog me-1"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTable will populate this -->
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="table-footer">
                <h3><i class="fas fa-bed me-2"></i>Room Inventory</h3>
            </div>
        </div>
    </div>
@endsection
