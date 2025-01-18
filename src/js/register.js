const form = document.querySelector('.registration-form');
const sendData = document.querySelector('.form-button');
const messageAlert = document.querySelector('.message-alert')

function message(data) {
    messageAlert.classList.add('error')
    messageAlert.innerHTML = data.message
    console.log(data);
    setTimeout(() => {
        messageAlert.classList.remove('error');
        messageAlert.innerHTML = ''
    }, 1500)

}

form.onsubmit = (e) => {
    e.preventDefault(); 

    if (!form.name.value || !form.email.value || !form.password.value || !form.confirmPassword.value) {
        message({ success: false, message: 'Todos os campos devem ser preenchidos.' });
        return;
    }

    if (form.password.value !== form.confirmPassword.value) {
        message({ success: false, message: 'As senhas não coincidem.' });
        return;
    }

   let formData = {
    action : 'register',
    name : form.name.value,
    email : form.email.value,
    password : form.password.value,
    confirmPassword : form.confirmPassword.value
   }

    fetch('http://localhost:3000/xampp/htdocs/chatSimples/src/api/controllerApi.php', 
        { method: 'POST', body: JSON.stringify(formData)})
        .then(response => {
            if (response.ok){
                return response.json()
            }
        }).then(data => {
            if(data.success){
                console.log(data);
                location.href = './users.php';
            }else{
                console.log(data);
                message(data);
            }
        })
};
