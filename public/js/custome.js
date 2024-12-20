document.addEventListener("DOMContentLoaded", function () {
    //provider personal information section validation
    // provider phone validation
    const phoneInput = document.getElementById("phone");
    const phonePattern = /^[0-9\s\-\+\(\)]*$/;

    phoneInput.addEventListener("input", function () {
        const errorDiv = document.getElementById("phone-error");
        if (!phonePattern.test(phoneInput.value)) {
            errorDiv.textContent = "Invalid phone number format!";
            phoneInput.classList.add("is-invalid");
        } else {
            errorDiv.textContent = "";
            phoneInput.classList.remove("is-invalid");
        }
    });

    //provider password validation
    const passwordInput = document.getElementById("password");
    const passwordConfirmInput = document.getElementById(
        "password_confirmation"
    );
    const passwordError = document.createElement("div");
    passwordError.className = "text-danger";

    // Insert error message container after the password field
    passwordInput.parentNode.appendChild(passwordError);

    // Validate password strength on input
    passwordInput.addEventListener("input", function () {
        const value = passwordInput.value;
        const pattern =
            /(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/;
        if (!pattern.test(value)) {
            passwordError.textContent =
                "Password must be at least 8 characters long, include an uppercase letter, lowercase letter, a number, and a special character.";
            passwordInput.classList.add("is-invalid");
        } else {
            passwordError.textContent = "";
            passwordInput.classList.remove("is-invalid");
        }
    });

    // Validate password confirmation
    passwordConfirmInput.addEventListener("input", function () {
        if (passwordInput.value !== passwordConfirmInput.value) {
            passwordConfirmInput.classList.add("is-invalid");
            passwordError.textContent = "Passwords do not match.";
        } else {
            passwordConfirmInput.classList.remove("is-invalid");
            passwordError.textContent = "";
        }
    });

    //provider proffessional information section validation
    const experienceInput = document.getElementById("years_of_experience");
    const skillsInput = document.getElementById("skills");
    const form = document.getElementById("registration-form");

    // Validate Years of Experience
    experienceInput.addEventListener("input", function () {
        if (experienceInput.value < 0) {
            experienceInput.classList.add("is-invalid");
        } else {
            experienceInput.classList.remove("is-invalid");
        }
    });

    // Validate Skills Input on Change
    skillsInput.addEventListener("input", function () {
        const skillsArray = skillsInput.value
            .split(",")
            .map((skill) => skill.trim());
        if (
            skillsArray.length === 0 ||
            skillsArray.some((skill) => skill === "")
        ) {
            skillsInput.classList.add("is-invalid");
        } else {
            skillsInput.classList.remove("is-invalid");
        }
    });

    // Form Submission Validation for Skills
    form.addEventListener("submit", function (e) {
        const skillsArray = skillsInput.value
            .split(",")
            .map((skill) => skill.trim());
        if (
            skillsArray.length === 0 ||
            skillsArray.some((skill) => skill === "")
        ) {
            e.preventDefault(); // Prevent form submission
            skillsInput.classList.add("is-invalid");
        }
    });

    //work locations validation
    const workLocationsInput = document.getElementById("work_locations");

    // Validate Work Locations Input on Change
    workLocationsInput.addEventListener("input", function () {
        const locationsArray = workLocationsInput.value
            .split(",")
            .map((location) => location.trim());
        if (
            locationsArray.length === 0 ||
            locationsArray.some((location) => location === "")
        ) {
            workLocationsInput.classList.add("is-invalid");
        } else {
            workLocationsInput.classList.remove("is-invalid");
        }
    });

    // Form Submission Validation for Work Locations
    form.addEventListener("submit", function (e) {
        const locationsArray = workLocationsInput.value
            .split(",")
            .map((location) => location.trim());
        if (
            locationsArray.length === 0 ||
            locationsArray.some((location) => location === "")
        ) {
            e.preventDefault(); // Prevent form submission
            workLocationsInput.classList.add("is-invalid");
        }
    });

    //availability validation
    const availabilityInput = document.getElementById("availability");

    // Validate Availability Input on Change
    availabilityInput.addEventListener("input", function () {
        const availabilityArray = availabilityInput.value
            .split(",")
            .map((day) => day.trim());
        if (
            availabilityArray.length === 0 ||
            availabilityArray.some((day) => day === "")
        ) {
            availabilityInput.classList.add("is-invalid");
        } else {
            availabilityInput.classList.remove("is-invalid");
        }
    });

    // Form Submission Validation for Availability
    form.addEventListener("submit", function (e) {
        const availabilityArray = availabilityInput.value
            .split(",")
            .map((day) => day.trim());
        if (
            availabilityArray.length === 0 ||
            availabilityArray.some((day) => day === "")
        ) {
            e.preventDefault(); // Prevent form submission
            availabilityInput.classList.add("is-invalid");
        }
    });

    //provider work details section validation
    // Validate Hourly Rate
    document
        .getElementById("hourly_rate")
        .addEventListener("input", function (e) {
            const value = e.target.value;
            const errorDiv = e.target.nextElementSibling;
            if (value < 0) {
                e.target.classList.add("is-invalid");
                errorDiv.textContent = "Hourly rate must be a positive number.";
            } else {
                e.target.classList.remove("is-invalid");
                errorDiv.textContent = "";
            }
        });

    // Validate work shift
    const checkboxes = document.querySelectorAll('input[name="work_shifts[]"]');
    const workShiftsContainer = document.getElementById(
        "work-shifts-container"
    ); // Target Work Shifts section
    const errorDiv = document.createElement("div");
    errorDiv.className = "text-provider mt-2";
    workShiftsContainer.appendChild(errorDiv); // Append the error message to the correct section

    function validateCheckboxes() {
        const anyChecked = Array.from(checkboxes).some(
            (checkbox) => checkbox.checked
        );
        if (!anyChecked) {
            errorDiv.textContent = "Please select at least one shift.";
        } else {
            errorDiv.textContent = "";
        }
    }

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", validateCheckboxes);
    });

    // Initial validation
    validateCheckboxes();
    // Validate shifts on form submission
    form.addEventListener("submit", function (e) {
        const anyChecked = Array.from(checkboxes).some(
            (checkbox) => checkbox.checked
        );
        if (!anyChecked) {
            e.preventDefault();
            errorDiv.textContent = "Please select at least one shift.";
        }
    });

    //details verification section validation
    //bio validation
    document.getElementById("bio").addEventListener("input", function () {
        const bio = this.value;
        if (bio.length > 500) {
            this.classList.add("is-invalid");
        } else {
            this.classList.remove("is-invalid");
        }
    });

    //background validation
    const backgroundCheckInput = document.getElementById("background_checked");

    form.addEventListener("submit", function (e) {
        if (!backgroundCheckInput.checked) {
            e.preventDefault(); // Prevent form submission
            backgroundCheckInput.classList.add("is-invalid"); // Add invalid style
            const errorDiv = document.createElement("div");
            errorDiv.className = "text-danger mt-2";
            errorDiv.textContent = "You must agree to the background check.";
            if (!backgroundCheckInput.parentElement.contains(errorDiv)) {
                backgroundCheckInput.parentElement.appendChild(errorDiv); // Display error message
            }
        } else {
            backgroundCheckInput.classList.remove("is-invalid"); // Remove invalid style
        }
    });

    // Languages Validation
    const languagesInput = document.getElementById("languages_spoken");

    // Validate Languages Input on Change
    languagesInput.addEventListener("input", function () {
        const languagesArray = languagesInput.value
            .split(",")
            .map((language) => language.trim());
        if (
            languagesArray.length === 0 ||
            languagesArray.some((language) => language === "")
        ) {
            languagesInput.classList.add("is-invalid");
        } else {
            languagesInput.classList.remove("is-invalid");
        }
    });

    // Form Submission Validation for Languages
    form.addEventListener("submit", function (e) {
        const languagesArray = languagesInput.value
            .split(",")
            .map((language) => language.trim());
        if (
            languagesArray.length === 0 ||
            languagesArray.some((language) => language === "")
        ) {
            e.preventDefault(); // Prevent form submission
            languagesInput.classList.add("is-invalid");
        }
    });

    //services validation
    const servicesContainer = document.getElementById('services-container');
    const servicescheckboxes = servicesContainer.querySelectorAll('input[name="services[]"]');
    const serviceserrorDiv = document.getElementById('services-error');

    // Validate checkboxes on change
    function validateServices() {
        const anyChecked = Array.from(servicescheckboxes).some(checkbox => checkbox.checked);
        if (!anyChecked) {
            serviceserrorDiv.style.display = 'block';
        } else {
            serviceserrorDiv.style.display = 'none';
        }
        return anyChecked;
    }

    // Add change event listeners to all checkboxes
    servicescheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', validateServices);
    });

    // Validate on form submission
    form.addEventListener('submit', function (e) {
        if (!validateServices()) {
            e.preventDefault(); // Prevent form submission if validation fails
            serviceserrorDiv.style.display = 'block';
        }
    });

    //provider form timeline
    const sections = document.querySelectorAll(".form-section");
    const steps = document.querySelectorAll(".step");
    const nextBtn = document.getElementById("next-btn");
    const prevBtn = document.getElementById("prev-btn");
    const submitBtn = document.getElementById("submit-btn");

    let currentStep = 0;

    function updateForm(step) {
        // Hide all sections and remove active class from steps
        sections.forEach((section, index) => {
            section.style.display = index === step ? "block" : "none";
            steps[index].classList.toggle("active", index === step);
        });

        // Toggle visibility of buttons
        prevBtn.style.display = step > 0 ? "inline-block" : "none";
        nextBtn.style.display =
            step < sections.length - 1 ? "inline-block" : "none";
        submitBtn.style.display =
            step === sections.length - 1 ? "inline-block" : "none";
    }

    nextBtn.addEventListener("click", function () {
        if (currentStep < sections.length - 1) {
            currentStep++;
            updateForm(currentStep);
        }
    });

    prevBtn.addEventListener("click", function () {
        if (currentStep > 0) {
            currentStep--;
            updateForm(currentStep);
        }
    });

    // Initialize form display
    updateForm(currentStep);
});
