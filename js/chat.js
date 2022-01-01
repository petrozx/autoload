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
    // setInterval(await showAll, 300);

    async function showAll() {
        const get = await getall();
        messages.value = ''
        get&&get.forEach(mes=>{
            messages.value += mes['date_create']+"\n"+mes['author']+"\n"+mes['message']+"\n\n"
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

    newSebSock()
    function newSebSock() {
        const socket = new WebSocket('ws://petroz.myjino.ru/api/chat/websock');
        socket.onopen = () => {
            connect.textContent = "Соединение установлено"
        }
        socket.onerror = (e) => {
            connect.textContent = "Ошибка соединения: " + (e.message?e.message:"соединение не установлено")
        }
    }
})