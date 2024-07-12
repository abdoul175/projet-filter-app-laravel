const showBtn = document.querySelector('.showToggle');
const formToShow = document.querySelector('.hide');

showBtn.addEventListener('click', (e) => {
    e.target.classList.add('hide');
    formToShow.classList.add('show');
});