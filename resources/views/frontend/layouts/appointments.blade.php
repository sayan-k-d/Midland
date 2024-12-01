<form method="POST" action="{{ route('appointment.store') }}" class="st-appointment-form">
    @csrf
    <div id="st-alert1"></div>

    <div class="row">
        <div class="col-lg-6">
            <div class="st-form-field st-style1">
                <label>Full Name</label>
                <input type="text" id="uname" name="uname" placeholder="John Doe" value="{{ old('uname') }}"
                    required>
                @error('uname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="st-form-field st-style1">
                <label>Email Address</label>
                <input type="email" id="uemail" name="uemail" placeholder="example@gmail.com"
                    value="{{ old('uemail') }}" required>
                @error('uemail')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="st-form-field st-style1">
                <label>Phone Number</label>
                <input type="text" id="unumber" name="unumber" placeholder="+00 141 23 234"
                    value="{{ old('unumber') }}" required>
                @error('unumber')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="st-form-field st-style1">
                <label>Booking Date</label>
                <input name="udate" type="text" id="udate" placeholder="mm/dd/yyyy"
                    value="{{ old('udate') }}">
                <div class="form-field-icon"><i class="fa fa-calendar"></i></div>
                @error('udate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="st-form-field st-style1">
                <label>Department</label>
                <div class="st-custom-select-wrap">
                    <select name="udepartment" id="udepartment" class="st_select1" data-placeholder="Select department"
                        required>
                        <option></option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->department_name }}"
                                {{ old('udepartment') == $department->department_name ? 'selected' : '' }}>
                                {{ $department->department_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('udepartment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="st-form-field st-style1">
                <label>Doctor</label>
                <div class="st-custom-select-wrap">
                    <select name="udoctor" class="st_select1" id="udoctor" data-placeholder="Select doctor" required>
                        <option></option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->doctor_name }}"
                                {{ old('udoctor') == $doctor->doctor_name ? 'selected' : '' }}>
                                {{ $doctor->doctor_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('udoctor')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="st-form-field st-style1">
                <label>Message</label>
                <textarea cols="30" rows="10" id="umsg" name="umsg" placeholder="Write something here...">{{ old('umsg') }}</textarea>
                @error('umsg')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-12">
            <button class="st-btn st-style1 st-color1 st-size-medium" type="submit" id="appointment-submit"
                name="submit">Appointment</button>
        </div>
    </div>
</form>
