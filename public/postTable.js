function createRow(post) {
    return `<tr>
                <th>${post['postId']}</th>
                <td>${post['title']}</td>
                <td>${post['commentId']}</td>
                <td>${post['body']}</td>
            </tr>`
}

function renderTable(posts){
    const tableBody = document.querySelector("#table-body")

    let output = '';
    posts.data.forEach(element => {
        output += createRow(element)
    });

    tableBody.innerHTML = output
}

function clearTable(){
    const tableBody = document.querySelector("#table-body")
    tableBody.innerHTML = ''
}