document.addEventListener('DOMContentLoaded', async()=>{
    const btnSend = document.getElementById('send');
    const form = document.getElementById('register');
    const inputEmail = document.querySelector('[name=email]')
    const usersArr = await get()

    btnSend.addEventListener('click', async(e) => {
        e.preventDefault()
        const isExist = usersArr?.find(el=>{
            if(el.indexOf(inputEmail.value)+1){
                return
            }
        })
        const resp = !isExist?await send(form):false;
        resp?window.location.href = 'http://petroz.myjino.ru/':console.log("пользователь с тако1 почтой существует");

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