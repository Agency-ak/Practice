
passwordTogglers = document.querySelectorAll('.eye');

passwordTogglers.forEach(toggler => {
     toggler.addEventListener('click', () => {
        const input = toggler.previousElementSibling; 
        if (input.type === 'password') {
            input.type = 'text';
            toggler.innerHTML = '<i class="fa-solid fa-eye-slash mx-2"></i>';
        } else {
            input.type = 'password';
            toggler.innerHTML = '<i class="fa-solid fa-eye mx-2"></i>';
        }
    });
});

