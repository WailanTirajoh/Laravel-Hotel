<form id="form-save-type" class="row g-3" method="POST" action="{{ route('type.update', ['type' => $type->id]) }}">
    @method('PUT')
    @csrf
    <div class="col-md-12">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ $type->name }}">
        @error('name')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
        <div id="error_name" class="text-danger error"></div>
    </div>
    <div class="col-md-12">
        <label for="information" class="form-label">Information</label>
        <textarea class="form-control" id="information" name="information" rows="3">{{ $type->information }}</textarea>
        @error('information')
            <div class="text-danger mt-1">
                {{ $message }}
            </div>
        @enderror
        <div id="error_information" class="text-danger error"></div>
    </div>
</form>
