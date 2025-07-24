document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');

    form?.addEventListener('submit', function (e) {
        let errors = [];

        // Nombre
        if (!form.full_name.value.trim()) {
            errors.push('El nombre completo es requerido.');
        }

        // Email
        if (!form.email.value.trim()) {
            errors.push('El correo electrónico es requerido.');
        } else {
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(form.email.value)) {
                errors.push('Formato de correo electrónico inválido. Verifique el texto ingresado.');
            }
        }

        // Sexo
        if (![...form.gender].some(r => r.checked)) {
            errors.push('Seleccionar un sexo es requerido.');
        }

        // Área
        if (!form.area.value) {
            errors.push('Seleccionar un área es requerido.');
        }

        // Descripción
        if (!form.description.value.trim()) {
            errors.push('Description is required.');
        }

        // Roles
        const roleCheckboxes = form.querySelectorAll('input[name="roles[]"]');
        if (![...roleCheckboxes].some(c => c.checked)) {
            errors.push('Al menos un rol debe ser seleccionado.');
        }

        // Display errors
        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join('\n'));
        }
    });
});