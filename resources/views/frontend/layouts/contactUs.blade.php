<form action="{{ route('contact.store') }}" method="POST" class="row st-contact-form st-type1">
    @csrf
    <div class="col-lg-6">
        <div class="st-form-field st-style1">
            <label>Full Name</label>
            <input type="text" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div><!-- .col -->
    <div class="col-lg-6">
        <div class="st-form-field st-style1">
            <label>Email Address</label>
            <input type="email" id="email" name="email" placeholder="example@gmail.com" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div><!-- .col -->
    <div class="col-lg-6">
        <div class="st-form-field st-style1">
            <label>Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Write subject" value="{{ old('subject') }}" required>
            @error('subject')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div><!-- .col -->
    <div class="col-lg-6">
        <div class="st-form-field st-style1">
            <label>Phone</label>
            <input type="text" id="phone" name="phone" placeholder="+00 376 12 465" value="{{ old('phone') }}" required>
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div><!-- .col -->
    <div class="col-lg-12">
        <div class="st-form-field st-style1">
            <label>Your Message</label>
            <textarea cols="30" rows="10" id="msg" name="msg" placeholder="Write something here..." required>{{ old('msg') }}</textarea>
            @error('msg')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div><!-- .col -->
    <div class="col-lg-12">
        <div class="text-center">
            <div class="st-height-b10 st-height-lg-b10"></div>
            <button class="st-btn st-style1 st-color1 st-size-medium" type="submit" id="submit" name="submit">Send message</button>
        </div>
    </div><!-- .col -->
</form>
