document.addEventListener('DOMContentLoaded', async()=>{
    const btnLogout = document.getElementById('logout');
    btnLogout.addEventListener('click', async(e)=>{
        const response = await login()
        if(response.success){
                window.location.reload()
        }
    })

    async function login() {
        const formData = new FormData(data)
        formData.append('method', 'logout')
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