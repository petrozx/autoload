document.addEventListener('DOMContentLoaded', async()=>{
    document.querySelectorAll('.nav-link').forEach(link=>{link.classList.toggle('active');});



    async function isOnline() {
        const req = await fetch('/api/chat/online', {
            method: 'POST'
        })
        return null
    }
    setInterval(await isOnline, 60000)
    await isOnline()
})