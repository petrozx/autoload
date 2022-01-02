document.addEventListener("DOMContentLoaded", async()=>{
    const form = document.getElementById('chat')
    const button = document.getElementsByTagName('button')[0]
    const messages = document.querySelector('.messages')
    const message = document.querySelector('.message')
    const connect = document.querySelector('.connect')

    button.addEventListener("click", async(e)=>{
        e.preventDefault();
        const resSend = await sendMessage()
        console.log(resSend);
    })
    setInterval(await showAll, 1000);

    async function showAll() {
        const get = await getall();
        const length = messages.querySelectorAll('div').length
        get&&get.forEach(mes=>{
            while (length <= get.length){
                const newMes = document.createElement('div')
                newMes.innerText = mes['date_create']+"\n"+mes['author']+"\n"+mes['message']+"\n\n"
                messages.append(newMes)
            }
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