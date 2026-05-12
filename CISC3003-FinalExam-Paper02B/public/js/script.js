// B.01 Client-side Form Validation
function validateForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!name) {
        alert('Please enter your full name');
        return false;
    }
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address');
        return false;
    }
    if (!subject) {
        alert('Please enter a subject');
        return false;
    }
    if (!message) {
        alert('Please enter your message');
        return false;
    }
    return true;
}