// Email validation utilities for reusable button enabling/disabling

const allowedDomains = [
  'gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com',
  'icloud.com', 'live.com', 'aol.com', 'protonmail.com', 'zoho.com', 'me.com'
];

function isValidEmailFormat(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function hasAllowedDomain(email) {
  const at = email.lastIndexOf('@');
  if (at === -1) return false;
  const domain = email.slice(at + 1).toLowerCase();
  return allowedDomains.some(d => domain === d || domain.endsWith('.' + d));
}

function isValidEmail(email) {
  const val = (email || '').trim();
  return isValidEmailFormat(val) && hasAllowedDomain(val);
}

function updateButtonState(emailInput, button, submitted = false) {
  if (!button || !emailInput) return;
  const email = emailInput.value || '';
  const shouldEnable = isValidEmail(email) && !submitted;
  button.disabled = !shouldEnable;
  button.classList.toggle('opacity-50', !shouldEnable);
  button.classList.toggle('cursor-not-allowed', !shouldEnable);
}

function attachEmailValidation(emailInput, button, onSubmit = null) {
  if (!emailInput || !button) return;

  // Initialize button as disabled
  button.disabled = true;
  button.dataset.submitted = button.dataset.submitted || '0';

  // Update button state on input
  const updateHandler = () => updateButtonState(emailInput, button, button.dataset.submitted === '1');
  emailInput.addEventListener('input', updateHandler);
  updateHandler(); // Initial check

  // Handle form submission or button click
  if (onSubmit) {
    const submitHandler = (e) => {
      if (button.dataset.submitted === '1') {
        e.preventDefault();
        return;
      }

      if (button.disabled) {
        e.preventDefault();
        return;
      }

      button.dataset.submitted = '1';
      button.disabled = true;
      button.setAttribute('aria-busy', 'true');

      // Update button text to show loading
      const originalText = button.innerHTML;
      button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';

      button.classList.add('opacity-50', 'cursor-not-allowed');

      // Call the provided submit handler
      onSubmit(e, () => {
        // Reset function
        button.dataset.submitted = '0';
        button.disabled = false;
        button.removeAttribute('aria-busy');
        button.innerHTML = originalText;
        button.classList.remove('opacity-50', 'cursor-not-allowed');
        updateHandler();
      });
    };

    // Find the form or attach to button click
    const form = button.closest('form');
    if (form) {
      form.addEventListener('submit', submitHandler);
    } else {
      button.addEventListener('click', submitHandler);
    }
  }

  return {
    update: updateHandler,
    reset: () => {
      button.dataset.submitted = '0';
      updateHandler();
    }
  };
}

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
  module.exports = {
    isValidEmailFormat,
    hasAllowedDomain,
    isValidEmail,
    updateButtonState,
    attachEmailValidation
  };
}