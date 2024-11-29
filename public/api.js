function loadData(url) {
    return fetch(url, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        },
    })
}

async function loadPosts(search) {
    const response = await loadData(`/app/api/posts.php?` + new URLSearchParams({ search }).toString())
    return await response.json()
}