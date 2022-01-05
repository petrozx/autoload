document.addEventListener('DOMContentLoaded', async()=>{

    document.querySelectorAll('.nav-link').forEach(function(link){
        if (link.href == window.location.href || link.href.includes('chat'))
            link.classList.add('active')
    })





    async function isOnline() {
        const req = await fetch('/api/chat/online', {
            method: 'POST'
        })
        return null
    }
    setInterval(await isOnline, 60000)
    await isOnline()
})