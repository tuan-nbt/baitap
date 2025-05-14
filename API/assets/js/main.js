$(document).ready(function () {
    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 500);
        }
    });

    // Toggle mobile navigation menu
    $('.mobile-menu-toggle').on('click', function () {
        $('.mobile-menu').toggleClass('hidden');
    });

    // Form validation feedback
    $('form').on('submit', function (e) {
        let isValid = true;
        $(this).find('input[required]').each(function () {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('border-red-500');
            } else {
                $(this).removeClass('border-red-500');
            }
        });
        if (!isValid) {
            e.preventDefault();
            alert('Please fill out all required fields.');
        }
    });

    // Language switcher
    $('.language-switcher').on('click', function () {
        const lang = $(this).data('lang');
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('lang', lang);
        window.location.href = currentUrl.toString();
    });
});
