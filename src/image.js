const covers = document.querySelectorAll('.cover');
const coverImage = document.querySelector('.coverImage');
const coverContainer = document.querySelector('.coverContainer');

covers.forEach(cover => {
    cover.addEventListener('click', () => {
        coverImage.src = cover.src;
        coverContainer.style.display = 'flex';
        page.classList.add("blur");
    });
});

const coverClose = coverContainer.querySelector('.coverClose');
if (coverClose) {
    coverClose.addEventListener('click', () => {
        coverContainer.style.display = 'none';
        page.classList.remove("blur");
    });
}

