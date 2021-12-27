document.addEventListener('DOMContentLoaded', ()=>{
    const btnSend = document.getElementById('send');
    const form = document.getElementById('register');
    btnSend.addEventListener('click', (e) => {
        e.preventDefault()
        send(form)
    })

    async function send(data) {
        const formData = new FormData(data)
        const request = await fetch('http://autoload/actions/login.php', {
            method: "POST",
            body: formData,
            mode: 'cors'
        })
        const response = await request.json()
        console.log(response);
    }

})