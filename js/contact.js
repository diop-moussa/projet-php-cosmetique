function toggleContactBox(e) {
    e.stopPropagation();
    document.getElementById('contactPopup').classList.toggle('active');
}

document.addEventListener('click', function (e) {
    var popup = document.getElementById('contactPopup');
    var wrapper = document.querySelector('.contact-wrapper');
    if (popup && wrapper && !wrapper.contains(e.target)) {
        popup.classList.remove('active');
    }
});