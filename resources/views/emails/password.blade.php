

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<style>

		.header{
			background-color:rgba(0,52,90,0.5);
			width:100%;
			height: 50px;
			padding: 20px;

			color:purple;
			text-align: center;
			display: inline-block;


		}
		.wrapper{

			
			background-color: red;
		}

	</style>
</head>
<body>
	<table style="width:80%; box-shadow:5px 5px 3px black; border-radius:5px; ">
 	
 
 		<tr style="	background-color:rgba(0,52,90,0.5);
			width:100%;
			height: 50px;
			padding: 20px;
			font-size:2em;
			color:purple;
			text-align: center;
			display: inline-block;border-radius:15px;">Media tweet</tr>
 		
 	<td>
 			 <h2 >Reestablecer la contraseña</h2>
 	</td>
 		
 		        <tr>
 		           <td> Puedes reestablecer tu contraseña con la siguiente dirección, también puedes copiarla y pegarla en la barra de dirección de tu navegador.
 		           	 		
 		           	{{  url('password/reset/'.$token) }}.<br/>
 		           	 		
 		           	Equipo MediaTweet.</td>
 		
 		        </tr>
 	</table>
 </div>
</body>
</html>