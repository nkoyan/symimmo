import Axios from 'axios'
import Places from 'places.js'

let inputAddress = document.querySelector('#property_address')
if (inputAddress !== null) {
    let place = Places({
        container: inputAddress
    })
    place.on('change', e => {
        document.querySelector('#property_city').value = e.suggestion.city
        document.querySelector('#property_postalCode').value = e.suggestion.postcode
        document.querySelector('#property_lat').value = e.suggestion.latlng.lat
        document.querySelector('#property_lng').value = e.suggestion.latlng.lng
    })
}


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