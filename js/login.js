document.addEventListener('DOMContentLoaded', async()=>{
    const btnRegister = document.getElementById('reg');
    const btnLogin = document.getElementById('login');
    const form = document.getElementById('register');


    btnRegister.addEventListener('click', async(e) => {
        e.preventDefault()
        const response = await register(form)
        if(response.success){
            window.location.reload()
        }
    })

    btnLogin.addEventListener('click', async(e) => {
        e.preventDefault()
        const response = await login(form)
        if(response.success){
            window.location.reload()
        }
    })

    async function login(data) {
        const formData = new FormData(data)
        formData.append('method', 'login')
        const request = await fetch('/actions/login.php', {
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
        const request = await fetch('/actions/login.php', {
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