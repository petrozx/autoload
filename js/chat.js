document.addEventListener("DOMContentLoaded", async()=>{
    const form = document.getElementById('chat')
    const button = document.getElementsByTagName('button')[0]
    const messages = document.querySelector('.messages')
    const message = document.querySelector('.message')

    button.addEventListener("click", async(e)=>{
        e.preventDefault();
        const resSend = await sendMessage()
        console.log(resSend);
        await showAll()
    })

    await showAll()

    async function showAll() {
        const get = await getall();
        console.log(get);
        get&&get.foreach(mes=>{
            messages.innerHTML += mes['date_create']+"\n"+mes['author']+"\n"+mes['message']
        })
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