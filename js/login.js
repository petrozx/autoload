document.addEventListener('DOMContentLoaded', async()=>{
    const btnRegister = document.getElementById('reg');
    const btnLogin = document.getElementById('login');
    const form = document.getElementById('register');
    const btnLogout = document.getElementById('logout');

    btnLogout?.addEventListener('click', async(e)=>{
        const response = await logout()
        if(response.success){
            window.location.reload()
        }
    })

    btnRegister?.addEventListener('click', async(e) => {
        e.preventDefault()
        const response = await register(form)
        if(response.success){
            window.location.reload()
        }
    })

    btnLogin?.addEventListener('click', async(e) => {
        e.preventDefault()
        const response = await login(form)
        if(response.success){
            window.location.reload()
        } else {
            form.reset()
            $('h1').innerText = 'Данные введуны не верно'
        }
    })

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

    async function login(data) {
        const formData = new FormData(data)
        formData.append('method', 'login')
        const request = await fetch('/api/login/login/', {
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

    async function register(data) {
        const formData = new FormData(data)
        formData.append('method', 'register')
        const request = await fetch('/api/login/register/', {
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


})