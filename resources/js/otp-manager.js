// otp-manager.js
class OTPManager {
    constructor(config = {}) {
        // Default configuration
        this.config = {
            allowedDomains: [
                "gmail.com",
                "yahoo.com",
                "outlook.com",
                "hotmail.com",
                "icloud.com",
                "live.com",
                "aol.com",
                "protonmail.com",
                "zoho.com",
                "me.com",
            ],
            otpLength: 6,
            toastDuration: 5000,
            ...config,
        };

        // State
        this.instances = new Map();
    }

    /**
     * Initialize an OTP form
     * @param {string} formId - ID of the form element
     * @param {Object} options - Form-specific options
     */
    initForm(formId, options = {}) {
        const form = document.getElementById(formId);
        if (!form) {
            console.warn(`Form with ID "${formId}" not found`);
            return null;
        }

        const instance = new OTPForm(formId, this.config, options);
        this.instances.set(formId, instance);
        return instance;
    }

    /**
     * Initialize a single OTP input field
     * @param {string} inputId - ID of the OTP input element
     * @param {string} buttonId - ID of the verify button element
     */
    initOTPInput(inputId, buttonId) {
        const otpInput = document.getElementById(inputId);
        const verifyBtn = document.getElementById(buttonId);

        if (!otpInput || !verifyBtn) {
            console.warn(
                `OTP input or button not found: ${inputId}, ${buttonId}`
            );
            return;
        }

        const instance = new OTPInputHandler(otpInput, verifyBtn, this.config);
        this.instances.set(`${inputId}-${buttonId}`, instance);
        return instance;
    }

    /**
     * Initialize an email validation input
     * @param {string} inputId - ID of the email input
     * @param {string} buttonId - ID of the submit button
     */
    initEmailValidation(inputId, buttonId) {
        const emailInput = document.getElementById(inputId);
        const submitBtn = document.getElementById(buttonId);

        if (!emailInput || !submitBtn) {
            console.warn(
                `Email input or button not found: ${inputId}, ${buttonId}`
            );
            return;
        }

        const instance = new EmailValidator(emailInput, submitBtn, this.config);
        this.instances.set(`${inputId}-${buttonId}`, instance);
        return instance;
    }

    /**
     * Get an instance by ID
     */
    getInstance(id) {
        return this.instances.get(id);
    }

    /**
     * Destroy an instance
     */
    destroy(id) {
        const instance = this.instances.get(id);
        if (instance) {
            instance.destroy();
            this.instances.delete(id);
        }
    }

    /**
     * Destroy all instances
     */
    destroyAll() {
        for (const [id, instance] of this.instances) {
            instance.destroy();
        }
        this.instances.clear();
    }
}

// OTP Form Handler
class OTPForm {
    constructor(formId, config, options) {
        this.formId = formId;
        this.config = config;
        this.options = options;
        this.form = document.getElementById(formId);
        this.isSubmitting = false;

        this.init();
    }

    init() {
        if (!this.form) return;

        // Find OTP input and verify button
        this.otpInput =
            this.form.querySelector(
                'input[inputmode="numeric"][maxlength="6"]'
            ) ||
            this.form.querySelector('input[name*="otp"], input[name*="code"]');
        this.verifyBtn = this.form.querySelector(
            'button[type="submit"], #verifyBtn'
        );

        // Initialize OTP input handler if found
        if (this.otpInput && this.verifyBtn) {
            this.otpHandler = new OTPInputHandler(
                this.otpInput,
                this.verifyBtn,
                this.config
            );
        }

        // Add form submission handler
        this.form.addEventListener("submit", this.handleSubmit.bind(this));
    }

    handleSubmit(e) {
        if (this.isSubmitting) {
            e.preventDefault();
            return;
        }

        // Check if OTP is required and valid
        if (this.otpHandler && !this.otpHandler.isValid()) {
            e.preventDefault();
            this.showError("Please enter a valid 6-digit code");
            return;
        }

        this.isSubmitting = true;
        this.setLoadingState(true);
    }

    setLoadingState(isLoading) {
        if (this.verifyBtn) {
            if (isLoading) {
                this.verifyBtn.disabled = true;
                this.verifyBtn.setAttribute("aria-busy", "true");
                this.verifyBtn.innerHTML =
                    '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
                this.verifyBtn.classList.add(
                    "opacity-50",
                    "cursor-not-allowed"
                );
            } else {
                this.verifyBtn.disabled = false;
                this.verifyBtn.removeAttribute("aria-busy");
                this.verifyBtn.innerHTML = this.options.verifyText || "Verify";
                this.verifyBtn.classList.remove(
                    "opacity-50",
                    "cursor-not-allowed"
                );
                this.isSubmitting = false;
            }
        }
    }

    showError(message) {
        // Look for error container
        let errorContainer = this.form.querySelector(".error-message");
        if (!errorContainer) {
            errorContainer = document.createElement("div");
            errorContainer.className =
                "error-message mt-2 text-sm text-red-600";
            this.form.insertBefore(errorContainer, this.form.firstChild);
        }

        errorContainer.textContent = message;
        errorContainer.classList.remove("hidden");

        // Auto-hide after 5 seconds
        setTimeout(() => {
            errorContainer.classList.add("hidden");
        }, 5000);
    }

    destroy() {
        if (this.form) {
            this.form.removeEventListener(
                "submit",
                this.handleSubmit.bind(this)
            );
        }
        if (this.otpHandler) {
            this.otpHandler.destroy();
        }
    }
}

// OTP Input Handler
class OTPInputHandler {
    constructor(otpInput, verifyBtn, config) {
        this.otpInput = otpInput;
        this.verifyBtn = verifyBtn;
        this.config = config;
        this.isSubmitting = false;

        this.init();
    }

    init() {
        // Initial cleanup
        this.otpInput.value = this.sanitizeAndTrim(this.otpInput.value);
        this.updateButtonState();

        // Add event listeners
        this.otpInput.addEventListener("input", this.handleInput.bind(this));
        this.otpInput.addEventListener("paste", this.handlePaste.bind(this));

        // Add submission marker to button if not present
        if (!this.verifyBtn.dataset.submitted) {
            this.verifyBtn.dataset.submitted = "0";
        }

        // If button is a submit button, add click handler
        if (
            this.verifyBtn.type === "submit" ||
            this.verifyBtn.type === "button"
        ) {
            this.verifyBtn.addEventListener(
                "click",
                this.handleButtonClick.bind(this)
            );
        }
    }

    sanitizeAndTrim(value) {
        return (value || "").replace(/\D/g, "").slice(0, this.config.otpLength);
    }

    handleInput() {
        this.otpInput.value = this.sanitizeAndTrim(this.otpInput.value);
        this.updateButtonState();

        // Auto-submit when OTP length is reached
        if (
            this.otpInput.value.length === this.config.otpLength &&
            this.options?.autoSubmit
        ) {
            this.triggerVerification();
        }
    }

    handlePaste(e) {
        e.preventDefault();
        const paste =
            (e.clipboardData || window.clipboardData).getData("text") || "";
        this.otpInput.value = this.sanitizeAndTrim(paste);
        this.otpInput.dispatchEvent(new Event("input"));
    }

    updateButtonState() {
        const enabled = this.otpInput.value.length === this.config.otpLength;
        const submitted = this.verifyBtn.dataset.submitted === "1";
        this.verifyBtn.disabled = !(enabled && !submitted);
    }

    handleButtonClick(e) {
        if (this.isSubmitting || this.verifyBtn.dataset.submitted === "1") {
            e.preventDefault();
            return;
        }

        if (this.verifyBtn.disabled) {
            e.preventDefault();
            return;
        }

        this.setSubmittingState(true);

        // If there's a form, let it handle submission
        const form = this.otpInput.closest("form");
        if (form && this.verifyBtn.type === "submit") {
            // Form will handle submission
            return;
        }

        // Otherwise, trigger custom verification
        this.triggerVerification();
    }

    triggerVerification() {
        if (this.options?.onVerify) {
            this.options.onVerify(this.otpInput.value);
        }
    }

    setSubmittingState(isSubmitting) {
        this.isSubmitting = isSubmitting;
        this.verifyBtn.dataset.submitted = isSubmitting ? "1" : "0";

        if (isSubmitting) {
            this.verifyBtn.disabled = true;
            this.verifyBtn.setAttribute("aria-busy", "true");
            this.verifyBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
            this.verifyBtn.classList.add("opacity-50", "cursor-not-allowed");
        } else {
            this.verifyBtn.disabled = false;
            this.verifyBtn.removeAttribute("aria-busy");
            this.verifyBtn.innerHTML = this.options?.buttonText || "Verify";
            this.verifyBtn.classList.remove("opacity-50", "cursor-not-allowed");
        }
    }

    isValid() {
        return (
            this.otpInput.value.length === this.config.otpLength &&
            /^\d+$/.test(this.otpInput.value)
        );
    }

    reset() {
        this.otpInput.value = "";
        this.setSubmittingState(false);
        this.updateButtonState();
    }

    destroy() {
        this.otpInput.removeEventListener("input", this.handleInput.bind(this));
        this.otpInput.removeEventListener("paste", this.handlePaste.bind(this));
        this.verifyBtn.removeEventListener(
            "click",
            this.handleButtonClick.bind(this)
        );
    }
}

// Email Validator
class EmailValidator {
    constructor(emailInput, submitBtn, config) {
        this.emailInput = emailInput;
        this.submitBtn = submitBtn;
        this.config = config;
        this.isSubmitting = false;

        this.init();
    }

    init() {
        // Initialize button state
        this.updateButtonState();

        // Add event listeners
        this.emailInput.addEventListener("input", this.handleInput.bind(this));
        this.emailInput.addEventListener(
            "keypress",
            this.handleKeyPress.bind(this)
        );

        // Add submission marker
        if (!this.submitBtn.dataset.submitted) {
            this.submitBtn.dataset.submitted = "0";
        }

        // Add click handler
        this.submitBtn.addEventListener("click", this.handleSubmit.bind(this));
    }

    isValidEmailFormat(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    hasAllowedDomain(email) {
        const at = email.lastIndexOf("@");
        if (at === -1) return false;
        const domain = email.slice(at + 1).toLowerCase();
        return this.config.allowedDomains.some(
            (d) => domain === d || domain.endsWith("." + d)
        );
    }

    isValidEmail(email) {
        return this.isValidEmailFormat(email) && this.hasAllowedDomain(email);
    }

    handleInput() {
        this.updateButtonState();
    }

    handleKeyPress(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            if (
                !this.submitBtn.disabled &&
                this.submitBtn.dataset.submitted !== "1"
            ) {
                this.handleSubmit();
            }
        }
    }

    handleSubmit(e) {
        if (e) e.preventDefault();

        if (this.isSubmitting || this.submitBtn.dataset.submitted === "1") {
            return;
        }

        if (this.submitBtn.disabled) {
            return;
        }

        const email = this.emailInput.value.trim();

        if (!this.isValidEmail(email)) {
            this.showError(
                "Please enter a valid email address from a supported provider"
            );
            return;
        }

        this.setSubmittingState(true);

        // Trigger custom callback
        if (this.options?.onSubmit) {
            this.options.onSubmit(email);
        }
    }

    updateButtonState() {
        const email = this.emailInput.value.trim();
        const isValid = this.isValidEmail(email);
        const submitted = this.submitBtn.dataset.submitted === "1";
        const shouldEnable = isValid && !submitted;

        this.submitBtn.disabled = !shouldEnable;
        this.submitBtn.classList.toggle("opacity-50", !shouldEnable);
        this.submitBtn.classList.toggle("cursor-not-allowed", !shouldEnable);
    }

    setSubmittingState(isSubmitting) {
        this.isSubmitting = isSubmitting;
        this.submitBtn.dataset.submitted = isSubmitting ? "1" : "0";

        if (isSubmitting) {
            this.submitBtn.disabled = true;
            this.submitBtn.setAttribute("aria-busy", "true");
            this.submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
            this.submitBtn.classList.add("opacity-50", "cursor-not-allowed");
        } else {
            this.submitBtn.disabled = false;
            this.submitBtn.removeAttribute("aria-busy");
            this.submitBtn.innerHTML = this.options?.buttonText || "Get OTP";
            this.submitBtn.classList.remove("opacity-50", "cursor-not-allowed");
        }
    }

    showError(message) {
        // Look for error container near the input
        let errorContainer = this.emailInput.nextElementSibling;
        if (
            !errorContainer ||
            !errorContainer.classList.contains("error-message")
        ) {
            errorContainer = document.createElement("div");
            errorContainer.className =
                "error-message mt-1 text-sm text-red-600";
            this.emailInput.parentNode.insertBefore(
                errorContainer,
                this.emailInput.nextSibling
            );
        }

        errorContainer.textContent = message;
        errorContainer.classList.remove("hidden");

        // Auto-hide
        setTimeout(() => {
            errorContainer.classList.add("hidden");
        }, 5000);
    }

    reset() {
        this.emailInput.value = "";
        this.setSubmittingState(false);
        this.updateButtonState();
    }

    destroy() {
        this.emailInput.removeEventListener(
            "input",
            this.handleInput.bind(this)
        );
        this.emailInput.removeEventListener(
            "keypress",
            this.handleKeyPress.bind(this)
        );
        this.submitBtn.removeEventListener(
            "click",
            this.handleSubmit.bind(this)
        );
    }
}

// Toast notification utility
class ToastManager {
    static show(message, type = "info") {
        // Remove existing toast if any
        const existingToast = document.querySelector(".toast-notification");
        if (existingToast) {
            existingToast.remove();
        }

        // Create toast element
        const toast = document.createElement("div");
        toast.className = `toast-notification fixed top-4 right-4 z-[10000] px-6 py-3 rounded-lg shadow-lg transition-all duration-300`;

        // Set colors based on type
        const colors = {
            success: "bg-green-500 text-white",
            error: "bg-red-500 text-white",
            warning: "bg-yellow-500 text-white",
            info: "bg-blue-500 text-white",
        };

        toast.className += " " + (colors[type] || colors.info);

        const icons = {
            success: "fa-check-circle",
            error: "fa-exclamation-circle",
            warning: "fa-exclamation-triangle",
            info: "fa-info-circle",
        };

        toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${icons[type] || icons.info} mr-2"></i>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(toast);

        // Auto-remove after duration
        setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transform = "translateY(-20px)";
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 300);
        }, 5000);

        return toast;
    }
}

// Export for use in modules
if (typeof module !== "undefined" && module.exports) {
    module.exports = { OTPManager, ToastManager };
} else {
    // Make available globally
    window.OTPManager = OTPManager;
    window.ToastManager = ToastManager;
}
