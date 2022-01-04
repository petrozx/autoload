document.addEventListener("DOMContentLoaded", async()=>{
    const usersALL = await getAllUsers()
    const globalUser = await User();

    async function getAllUsers() {
        const req = await fetch('/api/chat/users',{
            method: 'POST'
        })
        return await req.json()
    }

    async function User() {
        const req = await fetch('/api/login/userAuth', {
            method: 'POST',
            body: ""
        })
        return await req.json()
    }

    if (!globalUser['error']) {
        const chats = document.querySelector('.chats')
        usersALL.forEach(user =>{
            const divUser = document.createElement('a')
            divUser.className = 'user'
            divUser.href = '/chat/private/?user=' + user['id']
            divUser.dataset.id = user['id']
            divUser.innerText = user['name']
            console.log((+user['date_update'] + 1000*60)+"      "+new Date().getTime());
            if( (user['date_update'] + 1000*60) > (new Date().getTime()) ) {
                divUser.className = 'user online'
            } else {
                divUser.className = 'user offline'
            }
            if (globalUser['success'] != user['id']) {
                chats.append(divUser)
            }
        })
    }
})