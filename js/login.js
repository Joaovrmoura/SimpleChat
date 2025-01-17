const form = document.querySelector('.registration-form');
const sendData = document.querySelector('.form-button');
const messageAlert = document.querySelector('.message-alert')
const sessionId = Math.random().toString(36).substring(2, 15);

form.onsubmit = (e) => {
    // let formData = {
    //     action: 'login',
    //     email: form.email.value,
    //     password: form.password.value,
    // };
    let formData = new FormData(form)

    e.preventDefault()
    fetch('http://localhost:3000/xampp/htdocs/chatSimples/php/logUser.php', { 
    method: 'POST', body: formData
    })
    .then(response => { 
        if(response.ok){ 
            console.log(response.text());
            location.href = `./index.php`
        }
    })
};



// function message(data) {
//     if (data.success === true) {
//         location.href = './index.php'
//         console.log(data);
//     } else {
//         messageAlert.classList.add('error')
//         messageAlert.innerHTML = data.message
//         console.log(data);
//         setTimeout(() => {
//             messageAlert.classList.remove('error');
//             messageAlert.innerHTML = ''
//         }, 1500)
//     }
// }