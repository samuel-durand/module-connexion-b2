const audio = document.getElementById('audio');
const playPauseButton = document.getElementById('play-pause-button');
const prevButton = document.getElementById('prev-button');
const nextButton = document.getElementById('next-button');
const progressBar = document.querySelector('.progress');
const currentTime = document.getElementById('current-time');
const duration = document.getElementById('duration');

let isPlaying = false;
let currentTrackIndex = 0;


const tracks = [
    { name: 'IVOXYGEN - deja vu', src: 'song-1.mp3' },
    { name: 'NUEKI, TOLCHONOV - SO TIRED', src: 'song-2.mp3' },

];

playPauseButton.addEventListener('click', () => {
    if (isPlaying) {
        audio.pause();
        playPauseButton.textContent = 'Lecture';
    } else {
        audio.play();
        playPauseButton.textContent = 'Pause';
    }
    isPlaying = !isPlaying;
});

audio.addEventListener('timeupdate', () => {
    const percent = (audio.currentTime / audio.duration) * 100;
    progressBar.style.width = percent + '%';
    currentTime.textContent = formatTime(audio.currentTime);
    duration.textContent = formatTime(audio.duration);
});

prevButton.addEventListener('click', () => {
    currentTrackIndex = (currentTrackIndex - 1 + tracks.length) % tracks.length;
    audio.src = tracks[currentTrackIndex];
    audio.play();
    playPauseButton.textContent = 'Pause';
    isPlaying = true;
});

nextButton.addEventListener('click', () => {
    currentTrackIndex = (currentTrackIndex + 1) % tracks.length;
    audio.src = tracks[currentTrackIndex];
    audio.play();
    playPauseButton.textContent = 'Pause';
    isPlaying = true;
});

function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}
