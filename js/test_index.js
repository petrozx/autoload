
const audios = document.querySelector('.audio')

const el = document.createElement("audio");

el.loop = true;
el.controls = true;

const source = document.createElement("source");
source.src = '/upload/02868.mp3';
source.type = "audio/mpeg";

el.appendChild(source);


audios.append(el)