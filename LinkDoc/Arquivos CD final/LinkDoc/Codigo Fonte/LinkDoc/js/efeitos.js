
$(function (){

	

	$("#grupo input[type=radio]").live('click',function() {
		var valor = $(this).val();
		
		
		$("#dv2").hide(300);
		
		if (valor == 1)	$("#dv1").show(600);		
		else if (valor == 2) $("#dv2").show(600);
	});
});

function setaImagem(){
			var settings = {
				primeiraImg: function(){
					elemento = document.querySelector("#slider a:first-child");
					elemento.classList.add("ativo");
					this.legenda(elemento);
				},

				slide: function(){
					elemento = document.querySelector(".ativo");

					if(elemento.nextElementSibling){
						elemento.nextElementSibling.classList.add("ativo");
						settings.legenda(elemento.nextElementSibling);
						elemento.classList.remove("ativo");
					}else{
						elemento.classList.remove("ativo");
						settings.primeiraImg();
					}

				},

				proximo: function(){
					clearInterval(intervalo);
					elemento = document.querySelector(".ativo");
					
					if(elemento.nextElementSibling){
						elemento.nextElementSibling.classList.add("ativo");
						settings.legenda(elemento.nextElementSibling);
						elemento.classList.remove("ativo");
					}else{
						elemento.classList.remove("ativo");
						settings.primeiraImg();
					}
					intervalo = setInterval(settings.slide,6000);
				},

				anterior: function(){
					clearInterval(intervalo);
					elemento = document.querySelector(".ativo");
					
					if(elemento.previousElementSibling){
						elemento.previousElementSibling.classList.add("ativo");
						settings.legenda(elemento.previousElementSibling);
						elemento.classList.remove("ativo");
					}else{
						elemento.classList.remove("ativo");						
						elemento = document.querySelector("a:last-child");
						elemento.classList.add("ativo");
						this.legenda(elemento);
					}
					intervalo = setInterval(settings.slide,6000);
				},

				legenda: function(obj){
					var legenda = obj.querySelector("img").getAttribute("alt");
					document.querySelector("figcaption").innerHTML = legenda;
				}

			}


			//chama o slide
			settings.primeiraImg();

			//chama a legenda
			settings.legenda(elemento);

			//chama o slide à um determinado tempo
			var intervalo = setInterval(settings.slide,6000);
			document.querySelector(".next").addEventListener("click",settings.proximo,false);
			document.querySelector(".prev").addEventListener("click",settings.anterior,false);

		}

		window.addEventListener("load",setaImagem,false);



 function validacaoEmail(field) { 
	usuario = field.value.substring(0, field.value.indexOf("@")); 
	dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length); 
	if ((usuario.length >=1) && (dominio.length >=3) && (usuario.search("@")==-1) && (dominio.search("@")==-1) && (usuario.search(" ")==-1) && (dominio.search(" ")==-1) && (dominio.search(".")!=-1) && (dominio.indexOf(".") >=1)&& (dominio.lastIndexOf(".") < dominio.length - 1)) { 
		document.getElementById("msgemail").innerHTML="E-mail válido"; 
		alert("E-mail valido");
		 } else{ document.getElementById("msgemail").innerHTML="<font color='red'>E-mail inválido </font>"; alert("E-mail invalido"); 
	} 
}


    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Data", "Pressao", { role: "style" } ],
        <?php
        $k = $i;
        for($i=0;$i<$k;$i++){
        ?>
        ['<?php echo $data[$i] ?>', <?php echo $pressao[$i] ?>, '<?php echo $cor[$i] ?>'],
        <?php }  ?>
      ]);

      var options = {
        title: "Grafico de acompanhamento de pressao",
        width: 800,
        height: 500,
        //pieHole: 0.4,
        //is3D : true,
      };
      var chart = new google.visualization.AreaChart(document.getElementById("areachart_values"));
      chart.draw(data, options);
  }
   $('#myModal').on('show', function (e) {
    if (!data) return e.preventDefault() // stops modal from being shown
})


