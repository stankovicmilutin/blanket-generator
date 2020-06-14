<div class="form-group col-12">
    <label>Name</label>
    <input type="text"
           placeholder="Name"
           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
           value="{{ $user->name ?? old('name') }}"
           name="name">
    @include('layouts.partials.form-error', ['field' => 'name'])
</div>

<div class="form-group col-12">
    <label>Email</label>
    <input type="email"
           placeholder="Email"
           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
           value="{{  $user->email ?? old('email') }}"
           name="email">
    @include('layouts.partials.form-error', ['field' => 'email'])
</div>

<div class="form-group col-12">
    <label>Password</label>
    <input type="password"
           placeholder="Password"
           class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
           value=""
           name="password">
    @include('layouts.partials.form-error', ['field' => 'password'])
</div>

@php $courseIds = $user->courses->pluck('id'); @endphp

<div class="form-group col-12">
    <label>Courses</label>
    <select id="course" class="form-control {{ $errors->has('course_id') ? ' is-invalid' : '' }}" name="courses[]" multiple="multiple">
        @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ $courseIds->contains($course->id) ? 'selected' : '' }}>{{ $course->name }}</option>
        @endforeach
    </select>
</div>


<div class="form-group col-12">
    <button type="submit" class="btn btn-outline-primary">{{ $buttonText }}</button>
</div>


@push('js')
    <script>
        (function () {
            $('#course').select2({
                closeOnSelect: false,
                placeholder: 'Select courses'
            });
        })();
    </script>
@endpush

