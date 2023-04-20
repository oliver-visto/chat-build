import './bootstrap';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

fetch('/messages')
    .then(response => response.json())
    .then(messages => {
        messages.forEach(message => {
            document.getElementById('message-container').innerHTML += '<p>' + message.user  +': ' + message.messages + '</p>';
        });
    });

window.Echo.channel('notification').listen('MessageNotification', (e) => {
    console.log(e.message);
    document.getElementById('message-container').innerHTML += '<p>' + e.user  +': ' + e.message + '</p>';
});