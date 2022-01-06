document.addEventListener('DOMContentLoaded', async()=>{
    const form = document.getElementById('profile')
    const btnS = document.getElementById('save')
    const btnC = document.getElementById('cancel')
    const pass = document.querySelector('input[name=password]')
    const repeat = document.querySelector('input[name=repeat]')

    btnS.addEventListener('click', async _=>{
        if (pass.value === repeat.value) {
            const resp = await updateUser(form)
        }
    })

    async function updateUser(formData) {
        const form = new FormData(formData)
        const req = await fetch('/api/login/userUpdate/', {
            method: 'POST',
            body: form
        })
        return await req.text()
    }



})