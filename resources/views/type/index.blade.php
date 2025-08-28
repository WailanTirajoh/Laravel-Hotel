@extends('template.master')
@section('title', 'Room Types')
@section('content')
    <div class="container-fluid">
        <!-- Add Type Button -->
        <div class="row mb-4">
            <div class="col-12">
                <button id="add-button" type="button" class="add-type-btn">
                    <i class="fas fa-plus"></i>
                    Add New Type
                </button>
            </div>
        </div>

        <!-- Professional Table Container -->
        <div class="professional-table-container">
            <!-- Table Header -->
            <div class="table-header">
                <h4><i class="fas fa-home me-2"></i>Room Type Management</h4>
                <p>Manage different room types and their information</p>
            </div>

            <!-- Professional Table -->
            <div class="table-responsive">
                <table id="type-table" class="professional-table table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">
                                <i class="fas fa-hashtag me-1"></i>#
                            </th>
                            <th scope="col">
                                <i class="fas fa-tag me-1"></i>Name
                            </th>
                            <th scope="col">
                                <i class="fas fa-info-circle me-1"></i>Information
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
                <h3><i class="fas fa-home me-2"></i>Room Types</h3>
            </div>
        </div>
    </div>
@endsection
