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
    const auth = await isOnline()
    if (!auth['error'] || window.location.href !== 'https://petroz.ru/login/register'){
        setInterval(await isOnline, 60000)
    } else {
        window.location.href = 'https://petroz.ru/login/register'
    }
})