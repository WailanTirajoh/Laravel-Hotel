<form id="form-save-roomstatus" class="row g-3" method="POST"
    action="{{ route('roomstatus.update', ['roomstatus' => $roomstatus->id]) }}">
    @method('PUT')
    @csrf
    <div class="col-md-12">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
            name="name" value="{{ $roomstatus->name }}">
        @error('name')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
        <div id="error_name" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="code" class="form-label">Code</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror"
            id="code" name="code" value="{{ $roomstatus->code }}">
        @error('code')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
        <div id="error_code" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="information" class="form-label">Information</label>
        <textarea class="form-control" id="information" name="information" rows="3">{{ $roomstatus->information }}</textarea>
        @error('information')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
        <div id="error_information" class="text-danger error"></div>
    </div>
</form>
