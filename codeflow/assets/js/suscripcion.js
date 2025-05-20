document.addEventListener("DOMContentLoaded", () => {
    const cardNumberInput = document.getElementById('cardNumber');
    const expiryInput = document.getElementById('cardExpiry');
    const visaIcon = document.querySelectorAll('.fab.fa-cc-visa');
    const mcIcon = document.querySelectorAll('.fab.fa-cc-mastercard');
    const amexIcon = document.querySelectorAll('.fab.fa-cc-amex');
    const userDropdown = document.getElementById('user-dropdown');
    const userModal = document.getElementById('userModal');
    const paymentForm = document.getElementById('paymentForm');
    const planSummary = document.getElementById('planSummary');
    const taxSummary = document.getElementById('taxSummary');
    const totalSummary = document.getElementById('totalSummary');
    const openModalBtns = document.getElementsByClassName('plan-select');
    const planInput = document.getElementById('planInput');
    const precioInput = document.getElementById('precioInput');

    planInput.value = planSummary.textContent.trim();
    precioInput.value = totalSummary.textContent.trim();

    const price = 29.00;
    const tax = price * 0.1;
    const total = 29.00 + tax;

    const price2 = 99.00;
    const tax2 = price2 * 0.1;
    const total2 = 99.00 + tax2;

    // Información para cada botón
    const infoData = {
        "1": {
            plan: "Profesional",
            tax: tax.toFixed(2),
            total: total.toFixed(2)
        },
        "2": {
            plan: "Empresa",
            tax: tax2.toFixed(2),
            total: total2.toFixed(2)
        }
    };

    //Abre el modal se pago
    for (let btn of openModalBtns) {
        btn.addEventListener('click', function() {
            const infoId = this.getAttribute('data-info');

            planSummary.textContent = infoData[infoId].plan;
            taxSummary.textContent = "$"+infoData[infoId].tax;
            totalSummary.textContent = "$"+infoData[infoId].total;

            paymentForm.style.display = 'block';
        });
    }

    // Cerrar con ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            paymentForm.style.display = 'none';
        }
    });

    // Modal Dropdown
    userDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        userModal.style.display = 'block';
    });

    // Cerrar al hacer clic fuera
    document.addEventListener('click', (e) => {
        if (!userModal.contains(e.target) && e.target !== userDropdown) {
            userModal.style.display = 'none';
        }
    });

    // Cerrar con ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            userModal.style.display = 'none';
        }
    });

    function detectCardType(number) {
        const cleaned = number.replace(/\s+/g, '');

        if (/^4[0-9]{12}(?:[0-9]{3})?$/.test(cleaned)) return 'visa';
        if (/^5[1-5][0-9]{14}$/.test(cleaned) || /^2(2[2-9][0-9]{12}|[3-6][0-9]{13}|7[01][0-9]{12}|720[0-9]{12})$/.test(cleaned)) return 'mastercard';
        if (/^3[47][0-9]{13}$/.test(cleaned)) return 'amex';
        return 'unknown';
    }

    function validateLuhn(number) {
        const cleaned = number.replace(/\D/g, '');
        let sum = 0;
        let shouldDouble = false;

        for (let i = cleaned.length - 1; i >= 0; i--) {
            let digit = parseInt(cleaned.charAt(i));
            if (shouldDouble) {
                digit *= 2;
                if (digit > 9) digit -= 9;
            }
            sum += digit;
            shouldDouble = !shouldDouble;
        }

        return sum % 10 === 0;
    }

    function updateCardIcons(type) {
        visaIcon.forEach(icon => icon.classList.remove('active'));
        mcIcon.forEach(icon => icon.classList.remove('active'));
        amexIcon.forEach(icon => icon.classList.remove('active'));

        switch (type) {
            case 'visa':
                visaIcon.forEach(icon => icon.classList.add('active')); // Mostrar todos los íconos de Visa
                break;
            case 'mastercard':
                mcIcon.forEach(icon => icon.classList.add('active'));
                break;
            case 'amex':
                amexIcon.forEach(icon => icon.classList.add('active'));
                break;
        }
    }

    // Formatear número de tarjeta
    cardNumberInput.addEventListener('input', function () {
        let value = this.value.replace(/\D/g, '').slice(0, 16);
        if (value.length > 0) {
            this.value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
        }

        // Detección de tarjeta
        const cardType = detectCardType(this.value);
        updateCardIcons(cardType);

        // Validación de Luhn
        if (validateLuhn(this.value)) {
            this.style.borderColor = '#28a745'; // verde
        } else {
            this.style.borderColor = '#dc3545'; // rojo
        }
    });

    // Formatear fecha de expiración
    expiryInput.addEventListener('input', function () {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        this.value = value;
    });

});