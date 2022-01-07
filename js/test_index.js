
const audios = document.querySelector('.audio')

const el = document.createElement("audio");

el.loop = true;
el.controls = true;


el.src = '/upload/02868.mp3';
el.type = "audio/mpeg";




audios.append(el)