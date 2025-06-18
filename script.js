function redirectDicas() {
    window.location.href = "dicas.php";
}
function redirectFeedbacks() {
    window.location.href = "feedbacks.php";
}

function redirectLogin() {
    window.location.href = "login.php";
}

function openAccordion(header) {
    $(header).next(".accordion-body").toggleClass("active");
}
function menuShow() {
    if($(".mobile-menu").hasClass("open")) {
        $(".mobile-menu").removeClass("open");
        $(".icon").attr('src','imgs/menu_white_36dp.svg');
    } else {
        $(".mobile-menu").addClass("open")
        $(".icon").attr('src','imgs/close_white_36dp.svg');
    }
}

    function cadastro() {
    var firstname = $("#firstname").val().trim();
    var lastname = $("#lastname").val().trim();
    var email = $("#email").val().trim();
    var number = $("#number").val().trim();
    var password = $("#password").val();
    var confirmPassword = $("#Confirmpassword").val();
    var gender = $("input[name='gender']:checked").val();

    if (!firstname || !lastname || !email || !number || !password || !confirmPassword || !gender) {
        alert("Por favor, preencha todos os campos obrigatórios.");
        return;
    }

    var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexEmail.test(email)) {
        alert("Por favor, insira um e-mail válido.");
        return;
    }

    var regexCelular = /^\d{11}$/;
    if (!regexCelular.test(number)) {
        alert("O número de celular deve conter exatamente 11 dígitos (ex: 11912345678).");
        return;
    }

    if (password.length < 6 || password.length > 20) {
        alert("A senha deve ter entre 6 e 20 caracteres.");
        return;
    }

    if (password !== confirmPassword) {
        alert("As senhas não coincidem. Por favor, tente novamente.");
        return;
    }

    $.ajax({
        url: 'processa_cadastro.php',
        type: 'post',
        data: {
            firstname: firstname,
            lastname: lastname,
            email: email,
            number: number,
            password: password,
            gender: gender
        },
        dataType: 'json',
        success: function(retorno) {
            if (retorno.status === "success") {
                alert(firstname + " foi " + retorno.message);
                window.location.href = "login.php";
            } else {
                alert(retorno.message);
            }
        },
        error: function(cod, textStatus, msg) {
            console.log(cod, textStatus, msg);
            alert("Houve um erro na comunicação com o servidor.\n" + textStatus + ": " + msg);
        }
    });
}