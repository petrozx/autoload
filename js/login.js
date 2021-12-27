document.addEventListener('DOMContentLoaded', async()=>{
    const btnSend = document.getElementById('send');
    const form = document.getElementById('register');
    const inputEmail = document.querySelector('[name=email]')
    const usersArr = await get()
    console.log(usersArr);
    btnSend.addEventListener('click', async(e) => {
        e.preventDefault()
        const isExist = usersArr.find(el=>{
            if(el.indexOf(inputEmail.value)+1){
                return true
            }
        })
        console.log(isExist);
        isExist?send(form):console.log('такой пользователь существует');

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