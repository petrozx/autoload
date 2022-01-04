(async()=>{
    const usersALL = await getAllUsers()

    async function getAllUsers() {
        const req = await fetch('/api/chat/users',{
            method: 'POST'
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
            if(new Date(user['date_update']).getTime() + 15*60*100 > new Date().getTime()) {
                divUser.className = 'user online'
            } else {
                divUser.className = 'user offline'
            }
            if (globalUser['success'] != user['id']) {
                chats.append(divUser)
            }
        })
    }
})()