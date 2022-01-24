function fetchMileStones(element) {
    console.log(element);
    [...element.parentElement.children].forEach(sibEl => sibEl.classList.remove('active'))
    element.classList.add('active');

    fetch(`/${element.dataset.repoName}/milestones`)
        .then(function (response) {
            // When the page is loaded convert it to text
            return response.text()
        })
        .then(function (html) {
            document.getElementById('milestones').innerHTML = html;
        })
        .catch(function (err) {
            console.log('Failed to fetch page: ', err);
        });
}