// Form Validation Helper
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('submissionForm');
    if (form) {
        form.addEventListener('submit', function() {
            console.log('Form Submitting');
        });
    }
});