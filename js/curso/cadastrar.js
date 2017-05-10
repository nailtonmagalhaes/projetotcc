var cursocadastrar = cursocadastrar || {};

var propcursocadastrar = {
	form: '#formcadastrarcurso'
}

cursocadastrar = {
	Init: function () {
		this.Eventos();
	},
	Eventos:function () {
		$(propcursocadastrar.form).on('submit',function(e){
			e.preventDefault();

			var method = $(this).attr('method');
			var action = $(this).attr('action');

			 $.ajax({
                    url: action,
                    type: method,
                    data: $(this).serialize(),
                    success: function (data) {
                   		console.log(data); 
                   		//$("../../pages/modal-dados-salvos-com-sucesso.php").html(response).modal();	
                    },
                    fail: function (a,b,c) {
                    	console.log(a,b,c);
                    }
                });
		});	
	}
}