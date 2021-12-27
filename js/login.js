document.addEventListener('DOMContentLoaded', ()=>{
    const btnSend = document.getElementById('send');
    const form = document.getElementById('register');
    btnSend.addEventListener('click', (e) => {
        e.preventDefault()
        send(form)
    })

    async function send(data) {
        const formData = new FormData(data)
        const request = await fetch('/actions/login.php', {
            method: "POST",
            headers: {
                contentType: "application/x-www-form-urlencoded"
            },
            mode: 'no-cors',
            body: formData,
        })
        const response = await request.json()
        console.log(response);
    }

})