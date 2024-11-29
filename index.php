<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .loader-btn{
            height: 40px;
        }
        .loader-btn > .loader{
            display: none;
        }

        .loader-btn.load > .loader{
            display: block;
        }

        .loader-btn.load > .btn{
            display: none;
        }

    </style>
</head>

<body>
    <div class="container">
        <form method="post" id="form-search" class="form-search">
            <div class="d-flex align-items-center gap-3">
                <input name="search" type="text">
                <div class="loader-btn align-items-center d-flex">
                    <button type="submit" class="btn btn-primary">Найти</button>
                    <div class="spinner-border text-primary loader" role="status">
                        <span class="visually-hidden">Загрузка</span>
                    </div>
                </div>
            </div>
            <span class="error"></span>
        </form>
    </div>


    <div class="res container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Идентификатор поста</th>
                    <th scope="col">Title поста</th>
                    <th scope="col">Идентификатор комментария</th>
                    <th scope="col">Текст комментария</th>
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>
    </div>

    <script src="./public/api.js"></script>
    <script src="./public/postTable.js"></script>
    <script>
        async function formSubmit(event) {
            try {
                event.preventDefault()
                const form = event.currentTarget
                const error = form.querySelector(".error")
                const loader = form.querySelector(".loader-btn")

                if (form.search.value.trim().length < 3) {
                    return error.textContent = 'Строка должна быть длинной минимум 3 символа'
                }

                loader.classList.add("load")
                const posts = await loadPosts(form.search.value)
                loader.classList.remove("load")

                if (!posts.status) {
                    return error.textContent = posts.message
                }

                if (posts.data.length === 0) {
                    clearTable()
                    return error.textContent = 'По данной строке нету постов'
                }

                renderTable(posts)
                error.textContent = ''
            } catch {
                error.textContent = 'Возникла ошибка при загрузке постов'
            }

        }

        document.querySelector("#form-search").addEventListener("submit", formSubmit)
    </script>
</body>

</html>