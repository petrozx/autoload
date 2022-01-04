document.addEventListener("DOMContentLoaded", async()=>{
    const form = document.getElementById('chat')
    const button = document.getElementsByTagName('button')[0]
    const messages = document.querySelector('.messages')
    const globalUser = await User();
    const chatWith = $_GET('user')
    const usersALL = await getAllUsers()

    async function getAllUsers() {
        const req = await fetch('/api/chat/users',{
            method: 'POST'
        })
        return await req.json()
    }

    async function update(date) {
        const formData = new FormData();
        formData.append('method', 'update')
        formData.append('chat', chatWith)
        formData.append('date_create', date)
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
        formData.append('what_a_chat', chatWith)
        formData.append('chat', globalUser['success'])
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
    let max;
    async function updateMessage() {
        const mess = Array.from(messages?.querySelectorAll('div'))
        const response = await update(max||0)
        response&&response.forEach(el=>{
            const newMes = document.createElement('div')
            newMes.dataset.id = el['id']
            if(el['author'] == globalUser['success']){
                newMes.className = 'self';
            } else {
                newMes.className = 'other';
            }
            let name;
            usersALL.forEach(element => {
                if (element['id'] == el['author']) name = element['name']
            });
            newMes.innerText = formatTime(el['date_create'])+"\n"+name+"\n"+el['message']+"\n\n"
                messages.append(newMes)
                max = el['date_create']
        })
    }

    async function User() {
        const req = await fetch('/api/login/userAuth', {
            method: 'POST',
            body: ""
        })
        return await req.json()
    }

    function formatTime(unix) {
        const date = new Date(unix*1000)
        return date.getDate()+"/"+date.getMonth()+1+"/"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds()
    }

    const connect = document.querySelector('.connect').innerText = "Соединение установлено"
        button?.addEventListener("click", async(e)=>{
            e.preventDefault();
            await sendMessage()
            await updateMessage()
            form.reset()
        })

        setInterval(await updateMessage, 5000);
        await updateMessage()
})