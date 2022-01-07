
const audios = document.querySelector('.audio')

const el = document.createElement("audio");

el.loop = true;
el.controls = true;

const source = document.createElement("source");
source.src = '/upload/02868.mp3';
source.type = "audio/mpeg";

el.appendChild(source);

// need to call this function after user first interaction, or safari won't do it.
function firstPlay() {
    el.play();
}

let timeout = null;

function play() {
    // In case user press the button too fast, cancel last timeout
    if (lineSeTimeout) {
        clearTimeout(timeout);
    }

    // Back to beginning
    el.currentTime = 0;

    // unmute
    el.muted = false;

    // set to mute after the audio finish. In my case 500ms later
    // onended event won't work because loop=tue
    timeout = setTimeout(() => {
        // mute audio again
        el.muted = true;
    }, 500);
}
audios.append(el)