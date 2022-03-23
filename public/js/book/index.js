
document.querySelectorAll('.cont-imagen').forEach(item => {
    item.addEventListener('mouseover', () => {
        item.children[1].classList.add('show');
    })
    item.addEventListener('mouseleave', () => {
        item.children[1].classList.remove('show');
    })
})