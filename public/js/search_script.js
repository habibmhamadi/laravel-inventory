function sumbitSearch() {
    event.preventDefault()
    var query = document.getElementById('searchInput').value
    var url = event.target.action
    if (query) {
        url = url + '?query=' + query
    }
    window.location.href = url
}
