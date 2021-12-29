document.addEventListener('DOMContentLoaded', async()=>{
    const btnSend = document.getElementById('send');
    const btnLogin = document.getElementById('login');
    const form = document.getElementById('register');
    const inputEmail = document.querySelector('[name=email]')


    btnSend.addEventListener('click', async(e) => {
        e.preventDefault()
        const response = await login(form)
    })

    btnLogin.addEventListener('click', async(e) => {
        e.preventDefault()
        const response = await register(form)
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
        const response = await request.text()
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
        const response = await request.text()
        return response
    }


})