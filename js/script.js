document.addEventListener('DOMContentLoaded', async()=>{

    document.querySelectorAll('.nav-link').forEach(function(link){
        if (link.href == window.location.href || window.location.href.includes('chat') && link.href.includes('chat'))
            link.classList.add('active')
    })

    async function isOnline() {
        const req = await fetch('/api/chat/online', {
            method: 'POST'
        })
        return req.json()
    }
    if (window.location.href != 'https://petroz.ru/login/register')
        const auth = await isOnline()

    if (auth['success']){
        setInterval(await isOnline, 60000)
    }
})