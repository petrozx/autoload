
    const btnLogout = document.getElementById('logout');
    document.querySelectorAll('.nav-link').forEach(function(link){
        if (link.href == window.location.href || window.location.href.includes('chat') && link.href.includes('chat'))
            link.classList.add('active')
    })

    async function isOnline() {
        const req = await fetch('/api/chat/online', {
            method: 'POST'
        })
        return req.json()
    }

    const newMessage = document.querySelector('#new-message')

    async function onlineAndShow() {
        const resp = await isOnline()
        if (resp['message'] == true) {
            newMessage.classList.add('message--new')
        } else {
            newMessage.classList.remove('message--new')
        }
    }

    async function logout() {
        const formData = new FormData()
        formData.append('method', 'logout')
        const request = await fetch('/api/login/logout/', {
            method: "POST",
            headers: {
                contentType: "application/x-www-form-urlencoded"
            },
            mode: 'no-cors',
            body: formData,
        })
        const response = await request.json()
        return response
    }

    if (window.location.href != 'https://petroz.ru/login/register') {
        setTimeout(async () =>{await onlineAndShow()},500)
        setInterval(onlineAndShow, 30000)
    }

    btnLogout?.addEventListener('click', async(e)=>{
        const response = await logout()
        if(response.success){
            window.location.reload()
        }
    })

    const search = document.querySelector('[type="search"]')
    const btnSearch = document.querySelector('#search')
    const searchBox = document.querySelector('#search-box')
    btnSearch.addEventListener('click', async (event) => {
        event.preventDefault()
        window.location.href = `/chat/private/?user=${search.dataset.id}`
    })
    const usersSearch = new Set();
    const users = await getUsers()
    search.addEventListener('input', async (event) => {
        searchBox.querySelectorAll('li').forEach(el=>el.remove())
        searchBox.classList.add('show')
        usersSearch.clear()
        users.forEach(user => {
            if ((user['name'].toLowerCase()).indexOf((event.target.value).toLowerCase()) + 1) {
                usersSearch.add(user)
            }
        })
        if (event.target.value == "" || usersSearch.size == 0) {
            searchBox.classList.remove('show')
        }
        usersSearch.forEach(name=>creareSearch(name, searchBox))
    })

    searchBox.addEventListener('click', e=>{
        search.value = e.target.innerText
        search.dataset.id = e.target.dataset.id
        searchBox.classList.remove('show')
    })

    search.addEventListener('blur', _=>setTimeout(_=>searchBox.classList.remove('show'), 100))

    function creareSearch(name, place) {
        const li = document.createElement('li')
        li.innerText = name['name']
        li.dataset.id = name['id']
        li.className = 'dropdown-item'
        place.append(li)
    }



    async function getUsers() {
        const req = await fetch('/api/chat/users', {
            method: 'POST'
        })
        return await req.json()
    }
