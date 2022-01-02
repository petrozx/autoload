document.addEventListener("DOMContentLoaded", async()=>{
    const form = document.getElementById('chat')
    const button = document.getElementsByTagName('button')[0]
    const messages = document.querySelector('.messages')
    const message = document.querySelector('.message')
    const connect = document.querySelector('.connect')

    button.addEventListener("click", async(e)=>{
        e.preventDefault();
        await sendMessage()
        await showAll()
        form.reset()
    })

    setInterval(await showAll, 5000);
    await showAll()

    async function showAll() {
        const get = await getall();
        let length = messages.querySelectorAll('div').length
        while (length < get.length) {
            const newMes = document.createElement('div')
            newMes.dataset.id = get[length]['id']
            newMes.innerText = get[length]['date_create']+"\n"+get[length]['author']+"\n"+get[length]['message']+"\n\n"
            messages.append(newMes)
            length++
        }
    }
    updateMessage()
    async function updateMessage() {
        const mess = messages.querySelectorAll('div')
        let maximus;
        mess.sort((min, max) =>{
        min = min.dataset.id
        maximus = max.dataset.$id})
        console.log(maximus);
    }

    async function getall() {
        const formData = new FormData();
        formData.append('method', 'getAll')
        const req = await fetch('/api/chat/getMessage', {
            method: 'POST',
            body: formData
        })
        try {
            return await req.json()
        } catch (err) {
            return false
        }
    }

    async function update($id) {
        const formData = new FormData();
        formData.append('method', 'update')
        formData.append('id', $id)
        const req = await fetch('/api/chat/update', {
            method: 'POST',
            body: formData
        })
        try {
            return await req.json()
        } catch (err) {
            return false
        }
    }

    async function sendMessage() {
        const formData = new FormData(form)
        formData.append('method', 'send')
        const req = await fetch('/api/chat/sendMessage', {
            method: 'POST',
            body: formData
        })
        return await req.json()
    }


})