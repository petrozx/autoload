document.addEventListener("DOMContentLoaded", async()=>{
    const form = document.getElementById('chat')
    const button = document.getElementsByTagName('button')[0]
    const messages = document.querySelector('.messages')
    const message = document.querySelector('.message')
    const connect = document.querySelector('.connect')
    connect?.innerText &&= "Соединение установлено"
    const chatWith = $_GET('user')

    async function getAllUsers() {
        const req = await fetch('/api/chat/users',{
            method: 'POST'
        })
        return await req.json()
    }

    async function update(id) {
        const formData = new FormData();
        formData.append('method', 'update')
        formData.append('chat', chatWith)
        formData.append('id', id)
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

    async function isOnline() {
        const req = await fetch('/api/chat/online', {
            method: 'POST'
        })
        return false
    }

    async function sendMessage() {
        const formData = new FormData(form)
        formData.append('method', 'send')
        formData.append('chat', chatWith)
        const req = await fetch('/api/chat/sendMessage', {
            method: 'POST',
            body: formData
        })
        return await req.json()
    }

    function $_GET(key) {
        var p = window.location.search;
        p = p.match(new RegExp(key + '=([^&=]+)'));
        return p ? p[1] : false;
    }

    async function updateMessage() {
        const mess = Array.from(messages?.querySelectorAll('div'))
        const max = mess[mess.length - 1]?.dataset.id
        const response = await update(max||0)
        response&&response.forEach(el=>{
            const newMes = document.createElement('div')
            newMes.dataset.id = el['id']
            if(el['author_id'] == chatWith){
                newMes.className = 'self';
            } else {
                newMes.className = 'other';
            }
            newMes.innerText = el['date_create']+"\n"+el['author']+"\n"+el['message']+"\n\n"
            messages.append(newMes)
        })
    }

    if (window.location.href == 'http://petroz.myjino.ru/chat/') {
        const chats = document.querySelector('.chats')
        const users = await getAllUsers()
        console.log(users);
        users.forEach(user =>{
            const divUser = document.createElement('a')
            divUser.className = 'user'
            divUser.href = '/chat/private/?user=' + user['id']
            divUser.dataset.id = user['id']
            divUser.innerText = user['name']
            chats.append(divUser)
        })

    } else {


        button?.addEventListener("click", async(e)=>{
            e.preventDefault();
            await sendMessage()
            await updateMessage()
            form.reset()
        })

        setInterval(await updateMessage, 5000);
        setInterval(await isOnline, 60000);
        await updateMessage()

        console.log(new Date());

    }
})