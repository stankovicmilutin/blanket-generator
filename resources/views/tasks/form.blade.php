<script src="/js/ckeditor/ckeditor.js"></script>

<div class="form-group col-12">
    <label>Choose task domain</label>
    <select class="form-control {{ $errors->has('domain_id') ? ' is-invalid' : '' }}" name="domain_id">
        <option value="" selected disabled>Select Domain</option>
        @foreach($domains as $domain)
            <option value="{{ $domain->id }}" {{ ($task->domain_id == $domain->id || old('domain_id') === $domain->id) ? ' selected' : '' }} >
                {{ $domain->name }}
            </option>
        @endforeach
    </select>
    @include('layouts.partials.form-error', ['field' => 'domain_id'])
</div>

<div class="form-group col-12">
    <label>Choose task type</label>
    <select name="type" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}">
        <option value="" selected disabled>Select Task Type</option>
            <option value="theory"   {{ ($task->type == 'theory' || old('type') === 'theory') ? ' selected' : '' }}>Theory</option>
            <option value="practice" {{ ($task->type  == 'practice' || old('type') === 'practice') ? ' selected' : '' }}>Practice</option>
    </select>
    @include('layouts.partials.form-error', ['field' => 'type'])
</div>

<div class="form-group col-12">
    <label>Task body</label>
    <textarea
            placeholder="Task body..."
            class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}"
            name="body">{{ old('body') ?? $task->body }}</textarea>
    @include('layouts.partials.form-error', ['field' => 'body'])
</div>

<div class="form-group col-12">
    <button type="submit" class="btn btn-outline-primary">{{ $buttonText }}</button>
</div>


@push('js')
<script>
   CKEDITOR.replace('body');
</script>
@endpush
