// Contact form validation and submission
document.addEventListener('DOMContentLoaded', function() {
    
    // Find all contact forms
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const submitBtn = form.querySelector('button[id*="form-btn"]');
        
        if (submitBtn) {
            submitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                handleFormSubmit(form);
            });
        }
    });
    
    // Also handle form submission on Enter key
    document.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && e.target.tagName === 'TEXTAREA') {
            e.preventDefault();
            const form = e.target.closest('form');
            if (form) {
                handleFormSubmit(form);
            }
        }
    });
});

function handleFormSubmit(form) {
    // Get form inputs
    const nameInput = form.querySelector('input[placeholder="Your name"]');
    const emailInput = form.querySelector('input[placeholder*="Email"]');
    const phoneInput = form.querySelector('input[placeholder*="Phone"]');
    const messageInput = form.querySelector('textarea[placeholder*="message"]');
    const submitBtn = form.querySelector('button');
    
    // Get values
    const name = nameInput ? nameInput.value.trim() : '';
    const email = emailInput ? emailInput.value.trim() : '';
    const phone = phoneInput ? phoneInput.value.trim() : '';
    const message = messageInput ? messageInput.value.trim() : '';
    
    // Validation
    const errors = [];
    
    if (!name) {
        errors.push('Please enter your name');
        highlightError(nameInput);
    } else {
        removeError(nameInput);
    }
    
    if (!email) {
        errors.push('Please enter your email');
        highlightError(emailInput);
    } else if (!isValidEmail(email)) {
        errors.push('Please enter a valid email address');
        highlightError(emailInput);
    } else {
        removeError(emailInput);
    }
    
    if (!phone) {
        errors.push('Please enter your phone number');
        highlightError(phoneInput);
    } else if (!isValidPhone(phone)) {
        errors.push('Please enter a valid 10-digit phone number');
        highlightError(phoneInput);
    } else {
        removeError(phoneInput);
    }
    
    if (!message) {
        errors.push('Please enter your message');
        highlightError(messageInput);
    } else if (message.length < 10) {
        errors.push('Message must be at least 10 characters long');
        highlightError(messageInput);
    } else {
        removeError(messageInput);
    }
    
    // Show errors if any
    if (errors.length > 0) {
        showNotification(errors.join('\n'), 'error');
        return;
    }
    
    // Prepare form data
    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('phone', phone);
    formData.append('message', message);
    
    // Show loading state
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="btn-wraper">Sending...</span>';
    
    // Send form via AJAX
    fetch('send_email.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            // Clear form
            form.reset();
            // Remove error highlights
            form.querySelectorAll('input, textarea').forEach(field => removeError(field));
        } else {
            if (data.errors) {
                showNotification(data.errors.join('\n'), 'error');
            } else {
                showNotification(data.message, 'error');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred. Please try again later.', 'error');
    })
    .finally(() => {
        // Restore button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
}

// Email validation
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Phone validation
function isValidPhone(phone) {
    const phoneRegex = /^[0-9]{10}$/;
    const cleaned = phone.replace(/[\s\-]/g, '');
    return phoneRegex.test(cleaned);
}

// Highlight error field
function highlightError(field) {
    if (!field) return;
    field.style.borderColor = '#ff6b6b';
    field.style.backgroundColor = '#fff5f5';
}

// Remove error highlight
function removeError(field) {
    if (!field) return;
    field.style.borderColor = '';
    field.style.backgroundColor = '';
}

// Show notification
function showNotification(message, type) {
    // Remove existing notification
    const existing = document.querySelector('.form-notification');
    if (existing) {
        existing.remove();
    }
    
    const notification = document.createElement('div');
    notification.className = 'form-notification';
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background-color: ${type === 'success' ? '#28a745' : '#dc3545'};
        color: white;
        border-radius: 5px;
        z-index: 9999;
        max-width: 400px;
        font-size: 14px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        animation: slideIn 0.3s ease-in-out;
        white-space: pre-wrap;
        word-wrap: break-word;
    `;
    
    notification.textContent = message;
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-in-out';
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

// Add animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
