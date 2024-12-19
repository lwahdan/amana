@extends('layouts.app')

@section('title', 'Provider Registration')
@section('breadcrumb-title', 'Provider Registration')
@section('breadcrumb-subtitle', 'Create Your Account')

@section('content')
    {{-- Progress Timeline start --}}
    <div class="progress-container">
        <div class="step active">
            <span class="step-number">1</span><br>
            <span class="step-title">Personal Information</span>
        </div>
        <div class="step">
            <span class="step-number">2</span><br>
            <span class="step-title">Professional Information</span>
        </div>
        <div class="step">
            <span class="step-number">3</span><br>
            <span class="step-title">Work Details</span>
        </div>
        <div class="step">
            <span class="step-number">4</span><br>
            <span class="step-title">Verification Details</span>
        </div>
    </div>
    {{-- progress Timeline end --}}
    <!-- Registration Form start -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-provider text-white text-center">
                        <h2>Provider Registration</h2>
                    </div>
                    <div class="card-body">
                        <form id="registration-form" method="POST" action="{{ route('provider_register_submit') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Section 1: Personal Information -->
                            <div class="form-section active" id="section-1">
                                <div class="row mb-3">
                                    <!-- Name -->
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required placeholder="example@example.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" required
                                            pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}"
                                            title="Password must be at least 8 characters long, include a letter, a number, and a special character.">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            required>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Gender -->
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-select @error('gender') is-invalid @enderror"
                                            required>
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="mb-3 col-md-6">
                                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                                        <input id="date_of_birth" type="date" name="date_of_birth"
                                            class="form-control @error('date_of_birth') is-invalid @enderror"
                                            value="{{ old('date_of_birth') }}" max="{{ now()->toDateString() }}" required>
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Phone -->
                                    <div class="mb-3 col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input id="phone" type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            pattern="^[0-9\s\-\+\(\)]*$"
                                            title="Phone number can only contain numbers, spaces, +, -, and ()"
                                            value="{{ old('phone') }}" required>
                                        <div id="phone-error" class="text-danger"></div>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Profile Picture -->
                                    <div class="mb-3 col-md-6">
                                        <label for="profile_picture" class="form-label">Profile Picture</label>
                                        <input id="profile_picture" type="file" name="profile_picture"
                                            class="form-control @error('profile_picture') is-invalid @enderror"
                                            accept="image/jpeg,image/png,image/jpg">
                                        @error('profile_picture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input id="address" type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address') }}" required>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Section 2: Professional Information -->
                            <div class="form-section" id="section-2">
                                <div class="row mb-3">
                                    <!-- Years of Experience -->
                                    <div class="col-md-6">
                                        <label for="years_of_experience" class="form-label">Years of Experience</label>
                                        <input id="years_of_experience" type="number" name="years_of_experience"
                                            class="form-control @error('years_of_experience') is-invalid @enderror"
                                            value="{{ old('years_of_experience') }}" min="0" required>
                                        @error('years_of_experience')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Education -->
                                    <div class="col-md-6">
                                        <label for="education" class="form-label">Education</label>
                                        <input id="education" type="text" name="education"
                                            class="form-control @error('education') is-invalid @enderror"
                                            value="{{ old('education') }}" required>
                                        @error('education')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Certifications -->
                                    <div class="col-md-6">
                                        <label for="certifications" class="form-label">Certifications (Optional)</label>
                                        <textarea id="certifications" name="certifications" rows="3"
                                            class="form-control @error('certifications') is-invalid @enderror">{{ old('certifications') }}</textarea>
                                        @error('certifications')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Skills -->
                                    <div class="col-md-6">
                                        <label for="skills" class="form-label">Skills (Comma-separated)</label>
                                        <input id="skills" type="text" name="skills"
                                            class="form-control @error('skills') is-invalid @enderror"
                                            value="{{ is_array(old('skills')) ? implode(', ', old('skills')) : old('skills') }}"
                                            placeholder="Enter skills separated by commas (e.g., Communication, Leadership)."
                                            required>
                                        @error('skills')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Work Details -->
                            <div class="form-section" id="section-3">
                                <div class="row mb-3">
                                    <!-- Hourly Rate -->
                                    <div class="col-md-6">
                                        <label for="hourly_rate" class="form-label">Hourly Rate (in JOD)</label>
                                        <input id="hourly_rate" type="number" name="hourly_rate"
                                            class="form-control @error('hourly_rate') is-invalid @enderror"
                                            value="{{ old('hourly_rate') }}" min="0" step="0.01" required>
                                        @error('hourly_rate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Work Shifts -->
                                    <div class="col-md-6" id="work-shifts-container">
                                        <label class="form-label d-block">Work Shifts</label>

                                        <!-- Morning Shift -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="shift-morning"
                                                name="work_shifts[]" value="morning"
                                                {{ in_array('morning', old('work_shifts', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="shift-morning">
                                                Morning (8:00 AM - 8:00 PM)
                                            </label>
                                        </div>

                                        <!-- Night Shift -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="shift-night"
                                                name="work_shifts[]" value="night"
                                                {{ in_array('night', old('work_shifts', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="shift-night">
                                                Night (8:00 PM - 8:00 AM)
                                            </label>
                                        </div>

                                        <!-- Stay-in Shift -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="shift-stay-in"
                                                name="work_shifts[]" value="stay-in"
                                                {{ in_array('stay-in', old('work_shifts', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="shift-stay-in">
                                                Stay-in (24 hours)
                                            </label>
                                        </div>
                                        @error('work_shifts')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Work Locations -->
                                    <div class="col-md-6">
                                        <label for="work_locations" class="form-label">Work Locations</label>
                                        <textarea id="work_locations" name="work_locations" rows="3"
                                            class="form-control @error('work_locations') is-invalid @enderror" required
                                            placeholder="Enter locations separated by commas (e.g., Amman, Irbid, Aqaba).">
                                            {{ is_array(old('work_locations')) ? implode(', ', old('work_locations')) : old('work_locations') }}</textarea>
                                        @error('work_locations')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Availability -->
                                    <div class="col-md-6">
                                        <label for="availability" class="form-label">Availability</label>
                                        <textarea id="availability" name="availability" rows="3"
                                            class="form-control @error('availability') is-invalid @enderror" required
                                            placeholder="Specify days you are available (e.g., Mon-Fri).">
                                            {{ is_array(old('availability')) ? implode(', ', old('availability')) : old('availability') }}</textarea>
                                        @error('availability')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section 4: Verification Details -->
                            <div class="form-section" id="section-4">
                                <!-- Bio -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="bio" class="form-label">Bio</label>
                                        <textarea id="bio" name="bio" rows="4" class="form-control @error('bio') is-invalid @enderror"
                                            required>{{ old('bio') }}</textarea>
                                        <small class="text-muted">Provide a brief introduction about yourself (max 500
                                            characters).</small>
                                        @error('bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Background Check -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="background_checked"
                                                name="background_checked" value="1" required>
                                            <label class="form-check-label" for="background_checked">
                                                I confirm I agree on a background check.
                                            </label>
                                        </div>
                                        @error('background_checked')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Languages Spoken -->
                                <div class="col-md-6">
                                    <label for="languages_spoken" class="form-label">Languages Spoken</label>
                                    <textarea id="languages_spoken" name="languages_spoken" rows="3"
                                        class="form-control @error('languages_spoken') is-invalid @enderror" required
                                        placeholder="Enter languages separated by commas (e.g., English, Arabic, French).">{{ is_array(old('languages_spoken')) ? implode(', ', old('languages_spoken')) : old('languages_spoken') }}</textarea>
                                    @error('languages_spoken')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <!-- Navigation Buttons -->
                            <div class="form-navigation">
                                <button type="button" id="prev-btn" class="btn btn-secondary">Previous</button>
                                <button type="button" id="next-btn" class="btn btn-provider ">Next</button>
                                <button type="submit" id="submit-btn" class="btn btn-success"
                                    style="display: none;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
