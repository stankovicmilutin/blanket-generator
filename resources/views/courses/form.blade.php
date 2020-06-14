<div class="row">
    <div class="form-group col-md-4">
        <label>Course Name</label>
        <input type="text"
               placeholder="Name..."
               class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
               value="{{ old('name') ?? $course->name }}"
               name="name">
        @include('layouts.partials.form-error', ['field' => 'name'])
    </div>

    <div class="form-group col-md-4">
        <label>Module</label>
        <select id="module" class="form-control {{ $errors->has('module_id') ? ' is-invalid' : '' }}" name="module_id">
            <option value="" selected disabled>Select Module</option>
            @foreach($modules as $module)
                <option value="{{ $module->id }}" {{ ($course->module_id === $module->id || old('module_id') === $module->id) ? ' selected' : '' }} >{{ $module->name }}</option>
            @endforeach
        </select>
        @include('layouts.partials.form-error', ['field' => 'module_id'])
    </div>

    <div class="form-group col-md-4">
        <label>Department</label>
        <select id="department" class="form-control {{ $errors->has('department_id') ? ' is-invalid' : '' }}" name="department_id">
            <option value="" selected disabled>Select Department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ ($course->department_id === $department->id || old('department_id') === $department->id) ? ' selected' : '' }} >{{ $department->name }}</option>
            @endforeach
        </select>
        @include('layouts.partials.form-error', ['field' => 'department_id'])
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4">
        <label>Course Domains</label>

        <div id="domains">
            @forelse($course->domains as $domain)
                <p class="well">{{$loop->iteration}} - {{ $domain->name }}</p>
            @empty
                <input type="text"
                       placeholder="Domain name ..."
                       class="form-control my-2 {{ $errors->has('domains.0.name') ? ' is-invalid' : '' }}"
                       value=""
                       name="domains[]">
                @if($errors->has('domains.0.name'))
                    <div class="invalid-feedback">
                        Domain name is required
                    </div>
                @endif
            @endforelse
        </div>

        <span id="addDomain" class="btn btn-outline-primary">Add domain</span>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-fill btn-primary text-white btn-block">{{ $buttonText }}</button>
    </div>
</div>

@push('js')
    <script>
        (function () {
            $('#department').select2();
            $('#module').select2();

            $("#addDomain").click(() => {
                let html = `<input type="text"
                   placeholder="Domain name ..."
                   class="form-control my-2"
                   value=""
                   name="domains[]">`;

                $("#domains").append(html);
            });
        })();


    </script>
@endpush
