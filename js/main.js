const navButton = document.querySelectorAll('.nav-button')
const chat = document.querySelector('.chat-page')
const friendsPage = document.querySelector('#friendsPage')

navButton.forEach(element => {
    element.addEventListener('click', e => {
        const el = e.target;
        console.log(el);
        navButton.forEach(btn => btn.classList.remove('active'));
        el.classList.add('active');

        if (el.innerText === 'Amigos') {
            chat.style.display = 'none';
            friendsPage.style.display = 'block';
        }

        if (el.innerText === 'Chat') {
            chat.style.display = 'flex';
            friendsPage.style.display = 'none';
        }
    });
});

