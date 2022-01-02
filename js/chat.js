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
        let i;
        const get = await getall();
        while (get.length > i)
            i = (messages.querySelectorAll('div').length)&&0
            console.log(i);
            const newMes = document.createElement('div')
            newMes.innerText = get[i]['date_create']+"\n"+get[i]['author']+"\n"+get[i]['message']+"\n\n"
            messages.append(newMes)
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