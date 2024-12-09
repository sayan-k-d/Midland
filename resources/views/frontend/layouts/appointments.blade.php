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
                <input name="udate" type="date" id="udate" placeholder="mm/dd/yyyy"
                    value="{{ old('udate') }}">
                @error('udate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="st-form-field st-style1">
                <label>Department</label>
                <div class="st-custom-select-wrap">
                    <select name="udepartment" id="udepartment" class="form-select" data-placeholder="Select department"
                        required onchange="populateDoctors()">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
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
                    <select name="udoctor" class="form-select" id="udoctor" data-placeholder="Select doctor" required
                        disabled>
                        <option value="">Select Doctor</option>
                    </select>
                    <span id="doctor-error-message" class="text-danger"></span>
                    <div id="doctor-overlay"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; cursor: not-allowed;">
                    </div>
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

<script>
    const errorMessage = document.getElementById('doctor-error-message');
    const overlay = document.getElementById('doctor-overlay');

    overlay.addEventListener('click', function() {
        errorMessage.textContent = 'Please select a Department first.';
    });

    function populateDoctors() {
        var departmentId = document.getElementById('udepartment').value;
        if (departmentId) {
            // Enable the doctor dropdown and clear its previous options
            var doctorDropdown = document.getElementById('udoctor');
            doctorDropdown.disabled = false;
            overlay.style.display = 'none';
            errorMessage.textContent = '';
            doctorDropdown.innerHTML = '<option value="">Select Doctor</option>'; // Reset options

            // Fetch doctors based on the department selected
            fetch('/get-doctors/' + departmentId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // console.log(response);

                    return response.json();
                })
                .then(data => {
                    if (data && data.length > 0) {
                        data.forEach(doctor => {
                            var option = document.createElement('option');
                            option.value = doctor.doctor_name;
                            option.textContent = doctor.doctor_name;
                            doctorDropdown.appendChild(option);
                        });
                    } else {
                        var option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No doctors available';
                        doctorDropdown.appendChild(option);
                    }
                })
                .catch(error => {
                    console.error('Error fetching doctors:', error);
                });
        } else {
            // If no department is selected, disable the doctor dropdown
            var doctorDropdown = document.getElementById('udoctor');
            doctorDropdown.disabled = true;
            overlay.style.display = 'block';
            errorMessage.textContent = '';
            doctorDropdown.innerHTML = '<option value="">Select Doctor</option>';
        }
    }
</script>
