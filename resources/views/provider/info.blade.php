@extends('provider.dashboard')

@section('dashboard-content')
    <form class="container" action="{{ route('provider.info.update') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="container section-1">
            <h4 class="provider-primary">Personal Information</h4>
            <div class="row">
                <!-- Name -->
                <div class="form-group col-md-4">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $provider->name) }}" required>
                </div>

                <!-- Email -->
                <div class="form-group col-md-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $provider->email) }}" required>
                </div>

                <!-- Gender -->
                <div class="form-group col-md-4">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="male" {{ old('gender', $provider->gender) == 'male' ? 'selected' : '' }}>Male
                        </option>
                        <option value="female" {{ old('gender', $provider->gender) == 'female' ? 'selected' : '' }}>Female
                        </option>
                    </select>
                </div>

            </div>
            <div class="row">
                <!-- Date of Birth -->
                <div class="form-group col-md-4">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control"
                        value="{{ old('date_of_birth', $provider->date_of_birth ? \Carbon\Carbon::parse($provider->date_of_birth)->format('Y-m-d') : '') }}">
                </div>
                <!-- Phone -->
                <div class="form-group col-md-4">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                        value="{{ old('phone', $provider->phone) }}">
                </div>

                <!-- Address -->
                <div class="form-group col-md-4">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" class="form-control">{{ old('address', $provider->address) }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                {{-- current password --}}
                <div class="col-md-4">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input id="current_password" type="password" name="current_password"
                        class="form-control @error('current_password') is-invalid @enderror" required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="profile_picture">Image</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
                    @if ($provider->profile_picture)
                        <img src="{{ asset('storage/' . $provider->profile_picture) }}" alt="{{ $provider->name }}" class="img-thumbnail mt-2" width="150">
                    @endif
                </div>
            </div>
        </div>

        <div class="container section-2">
            <h4 class="provider-primary">Professional Information</h4>
            <div class="row">
                <!-- Years of Experience -->
                <div class="col-md-6">
                    <label for="years_of_experience">Years of Experience</label>
                    <input id="years_of_experience" type="number" name="years_of_experience"
                        class="form-control @error('years_of_experience') is-invalid @enderror"
                        value="{{ old('years_of_experience', $provider->years_of_experience) }}" min="0" required>
                    @error('years_of_experience')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Education -->
                <div class="form-group col-md-6">
                    <label for="education">Education</label>
                    <input type="text" name="education" id="education" class="form-control"
                        value="{{ old('education', $provider->education) }}">
                </div>
            </div>

            <div class="row">
                <!-- Certifications -->
                <div class="form-group col-md-6">
                    <label for="certifications">Certifications</label>
                    <textarea name="certifications" id="certifications" class="form-control">{{ old('certifications', $provider->certifications) }}</textarea>
                </div>

                <!-- Skills -->
                <div class="col-md-6">
                    <label for="skills" class="form-label">Skills (Comma-separated)</label>
                    <input id="skills" type="text" name="skills"
                        class="form-control @error('skills') is-invalid @enderror"
                        value="{{ old('skills', implode(', ', json_decode($provider->skills ?? '[]'))) }}"
                        placeholder="Enter skills separated by commas (e.g., Communication, Leadership)." required>
                    @error('skills')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="container section-3">
            <h4 class="provider-primary">Work Details</h4>
            <div class="row">
                <!-- Work Shifts -->
                <div class="col-md-6" id="work-shifts-container">
                    <label class="form-label d-block">Work Shifts</label>
                    <!-- Morning Shift -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="shift-morning" name="work_shifts[]"
                            value="morning"
                            {{ in_array('morning', old('work_shifts', json_decode($provider->work_shifts ?? '[]'))) ? 'checked' : '' }}>
                        <label class="form-check-label" for="shift-morning">
                            Morning (8:00 AM - 8:00 PM)
                        </label>
                    </div>

                    <!-- Night Shift -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="shift-night" name="work_shifts[]"
                            value="night"
                            {{ in_array('night', old('work_shifts', json_decode($provider->work_shifts ?? '[]'))) ? 'checked' : '' }}>
                        <label class="form-check-label" for="shift-night">
                            Night (8:00 PM - 8:00 AM)
                        </label>
                    </div>

                    <!-- Stay-in Shift -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="shift-stay-in" name="work_shifts[]"
                            value="stay-in"
                            {{ in_array('stay-in', old('work_shifts', json_decode($provider->work_shifts ?? '[]'))) ? 'checked' : '' }}>
                        <label class="form-check-label" for="shift-stay-in">
                            Stay-in (24 hours)
                        </label>
                    </div>
                    @error('work_shifts')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Hourly Rate -->
                <div class="col-md-6">
                    <label for="hourly_rate" class="form-label">Hourly Rate (in JOD)</label>
                    <input id="hourly_rate" type="number" name="hourly_rate"
                        class="form-control @error('hourly_rate') is-invalid @enderror"
                        value="{{ old('hourly_rate', $provider->hourly_rate) }}" min="0" step="0.01" required>
                    @error('hourly_rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Availability -->
                <div class="col-md-6">
                    <label for="availability" class="form-label">Availability</label>
                    <textarea id="availability" name="availability" rows="3"
                        class="form-control @error('availability') is-invalid @enderror" required
                        placeholder="Specify days you are available separated by commas (e.g., Mon-Fri).">{{ old('availability', implode(', ', json_decode($provider->availability ?? '[]'))) }}</textarea>
                    @error('availability')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Work Locations -->
                <div class="col-md-6" id="work-locations-container">
                    <label class="form-label d-block">Work Locations</label>

                    @foreach ($cities as $city)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="city-{{ $city->id }}"
                                name="work_locations[]" value="{{ $city->id }}"
                                {{ in_array($city->id, old('work_locations', $provider->cities->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="city-{{ $city->id }}">
                                {{ $city->name }}
                            </label>
                        </div>
                    @endforeach

                    @error('work_locations')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="container section-4">
            <h4 class="provider-primary mt-3">Verification Details</h4>
            <div class="row">
                <!-- Bio -->
                <div class="form-group col-md-12">
                    <label for="bio">Bio</label>
                    <textarea name="bio" id="bio" class="form-control">{{ old('bio', $provider->bio) }}</textarea>
                </div>
            </div>

            <div class="row">
                <!-- Services You Provide -->
                <div class="col-md-6" id="services-container">
                    <label class="form-label d-block">Services You Provide</label>

                    @foreach ($allServices as $service)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="service-{{ $service->id }}"
                                name="services[]" value="{{ $service->id }}"
                                {{ in_array($service->id, old('services', $provider->services->pluck('id')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="service-{{ $service->id }}">
                                {{ $service->name }}
                            </label>
                        </div>
                    @endforeach

                    @error('services')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Languages Spoken -->
                <div class="col-md-6">
                    <label for="languages_spoken" class="form-label">Languages Spoken</label>
                    <textarea id="languages_spoken" name="languages_spoken" rows="3"
                        class="form-control @error('languages_spoken') is-invalid @enderror" required
                        placeholder="Enter languages separated by commas (e.g., English, Arabic, French).">{{ old('languages_spoken', implode(', ', json_decode($provider->languages_spoken ?? '[]'))) }}</textarea>
                    @error('languages_spoken')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-provider">Update Info</button>
    </form>
@endsection
