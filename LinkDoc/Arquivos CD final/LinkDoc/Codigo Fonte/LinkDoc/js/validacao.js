$(document).ready(function(){
	$('#formulario_Cadastro').validate({
		rules:{
			// O campo Nome é de preenchimento obrigatório (required) e tamanho mínimo de 2 caracteres
			nome:{
				required: true,
				minlength: 2
			},
                        // O campo Nome é de preenchimento obrigatório (required) e tamanho mínimo de 2 caracteres
			sobrenome:{
				required: true,
				minlength: 2
			},
			// O campo Email é de preenchimento obrigatório (required) e o email precisa ser válido
			email: {
				required: true,
				email: true
			},
                        /*
			// O campo Time, é de preenchimento obrigatório (required)
			time: {
				required: true
			},*/
			// O campo Observação, é de preenchimento obrigatório (required)
			// 3 é o mínimo de caracteres e 10 é o máximo de caracteres que podem ser digitados
                        /*
			obs: {
				required: true,
				minlength: 3,
				maxlength: 10
			},*/
			// O campo Senha é de preenchimento obrigatório (required)
			senha: {
				required: true
			},
			// O campo Confirma Senha é de preenchimento obrigatório (required) 
			// e deve ser igual ao campo Senha (equalTo)
			conf_senha:{
				required: true,
				equalTo: "#senha"
			},
                        sexo: {
				required: true
			},
                        tipo_usuario: {
				required: true
			},
			// O campo Termo é de preenchimento obrigatório (required) 
			termo: "required"
		},
		// Aqui fica as mensagens de erro das regras acima,
		// que serão apresentadas caso alguma regra seja desobedecida
		messages:{
			nome:{
				required: "O campo Nome é obrigatório.",
				minlength: "O campo Nome deve conter no mínimo 3 caracteres."
			},
                        sobrenome:{
				required: "O campo Nome é obrigatório.",
				minlength: "O campo Nome deve conter no mínimo 1 caracteres."
			},
			email: {
				required: "O campo Email é obrigatório.",
				email: "O campo Email deve conter um email válido."
			},
                        /*
			time:{
				required: "É necessário selecionar o seu time favorito."
			},
			obs:{
				required: "O campo Observação é obrigatório.",
				minlength: "O campo Observação deve conter no mínimo 3 caracteres.",
				maxlength: "O campo Observação deve conter no máximo 10 caracteres."
			}, */
			senha: {
				required: "O campo Senha é obrigatório."
			},
			conf_senha:{
				required: "O campo Confirma Senha é obrigatório.",
				equalTo: "O campo Confirma Senha deve ser idêntico ao campo Senha."
			},
                        sexo: {
				required: "O campo sexo é obrigatório."
			},
                        tipo_usuario: {
				required: "O campo tipo usuario é obrigatório."
			},
			//termo: "É necessário aceitar os termos de uso."
		}

	});
});