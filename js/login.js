document.addEventListener('DOMContentLoaded', async()=>{
    const btnSend = document.getElementById('send');
    const form = document.getElementById('register');
    const inputEmail = document.querySelector('[name=email]')


    btnSend.addEventListener('click', async(e) => {
        e.preventDefault()
        const ans = await send(form)
        console.log(ans);
    })

    async function send(data) {
        const formData = new FormData(data)
        formData.append('method', 'reg')
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

    async function get() {
        const formData = new FormData()
        formData.append('method', 'allUser')
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