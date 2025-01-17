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

    // let formData = {
    //     action: 'register',
    //     name: form.name.value.trim(),
    //     email: form.email.value.trim(),
    //     password: form.password.value.trim(),
    //     confirmPassword: form.confirmPassword.value.trim()
    // };

    let formData = new FormData(form)

    fetch('http://localhost/chatSimples/php/register.php', 
        { method: 'POST', body: formData})
        .then(response => {
            if (response.ok){
                response.text();
                location.href = './index.php';
            }
        })
        // .then(obj => {
        //     let data = JSON.parse(obj)     
        //     if(data.success){
        //         location.href = './index.php';
        //     }else{
        //         console.log(data);
        //         message(data);
        //     }
        // })
        // .catch(error => {
        //     message({ success: false, message: 'Erro ao processar os dados.' });
        //     console.error(error);
        // });
};
