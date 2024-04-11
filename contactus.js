document.getElementById("contact-form").addEventListener("submit", (event) => {
    const contactForm = event.target;
    if (!validateContactForm(contactForm)) {
        event.preventDefault();
        displayError(contactForm, 'Invalid input');
    }
});

function isValidEmail(email) {
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    return emailRegex.test(email);
}
