import Axios from 'axios'

function toggleSpinner (icon) {
    if (icon.classList.contains('fa-spin')) {
        icon.className = 'fas fa-times'
    } else {
        icon.className = 'fas fa-spinner fa-spin'
    }

}

let links = document.querySelectorAll('a[data-delete]')
links.forEach(link => link.addEventListener('click', e => {
    e.preventDefault()

    let icon = link.querySelector('i')
    let token = link.dataset.token
    toggleSpinner(icon)

    Axios(
        {
            method: 'delete',
            url: link.getAttribute('href'),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-type': 'application/json',
            },
            data: JSON.stringify({
                '_token': token,
            }),
        })
        .then(response => {
            toggleSpinner(icon)
            link.parentElement.remove()
        })
        .catch(error => {
            toggleSpinner(icon)
        })
}))