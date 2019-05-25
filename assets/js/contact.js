let contactButton = $('#contactButton');
contactButton.click('on', function (e) {
    e.preventDefault();
    $('#contactForm').slideDown();
    contactButton.slideUp();
})