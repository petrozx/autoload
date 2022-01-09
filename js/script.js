document.addEventListener('DOMContentLoaded', async()=>{
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
        await isOnline()
        setInterval(await isOnline, 60000)
    }

    btnLogout?.addEventListener('click', async(e)=>{
        const response = await logout()
        if(response.success){
            window.location.reload()
        }
    })

    const search = document.querySelector('[type="search"]')
    const btnSearch = document.querySelector('#search')

    btnSearch.addEventListener('click', async (event) => {

    })

    const users = await getUsers()

    search.addEventListener('change', async (event) => {
        users.forEach(user => {
            if (user['name'].indexOf(event.target.value) + 1) {
                console.log(user);
            }
        })
    })

    async function getUsers() {
        const req = await fetch('/api/chat/users', {
            method: 'POST'
        })
        return await req.json()
    }
})