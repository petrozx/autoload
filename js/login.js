document.addEventListener('DOMContentLoaded', async()=>{
    const btnSend = document.getElementById('send');
    const form = document.getElementById('register');
    const inputEmail = document.querySelector('[name=email]')
    const usersArr = await get()
    console.log(usersArr);
    const is_exist = usersArr.find((el,key)=>{
        console.log(el, key);
    })
    btnSend.addEventListener('click', (e) => {
        e.preventDefault()
        if (inputEmail.value)
        const newUser = await send(form)

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
        return response
    }

    async function get() {
        const request = await fetch('/actions/login.php')
        const response = await request.json()
        return response
    }

})