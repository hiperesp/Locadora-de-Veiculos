<?php
include_once __DIR__."/../includes/include-all.inc.php";
include "views/head.php";
?>
		<main class="main">
			<hr>
			<form action="#" method="post">
				<h2>Cadastrar Usuário</h2>
				<input type="hidden" name="action" value="createUser">
				<label>
					Nome do usuário:<br>
					<input type="text" name="user_name" value=""><br>
				</label><br>
				<label>
					<input type="submit" value="Cadastrar Usuário"><br>
				</label><br>
				<hr>
			</form>
			<form action="#" method="post">
				<h2>Remover Usuário</h2>
				<input type="hidden" name="action" value="removeUser">
				<label>
					Selecione um usuário:<br>
					<select name="user_name">
					</select><br>
				</label><br>
				<label>
					<input type="submit" value="Remover Usuário"><br>
				</label><br>
				<hr>
			</form>
			<form action="#" method="post">
				<h2>Criar Projeto</h2>
				<input type="hidden" name="action" value="createProject">
				<label>
					Selecione um usuário:<br>
					<select name="user_name">
					</select><br>
				</label><br>
				<label>
					Nome do projeto:<br>
					<input type="text" name="project_name" value=""><br>
				</label><br>
				<label>
					Email do responsável pelo projeto:<br>
					<input type="text" name="user_email" value=""><br>
				</label><br>
				<label>
					Domínio do projeto:<br>
					<input type="text" name="project_domain" value=""><br>
				</label><br>
				<label>
					<input type="submit" value="Criar Projeto"><br>
				</label><br>
				<hr>
			</form>
			<form action="#" method="post">
				<h2>Atualizar Projeto</h2>
				<input type="hidden" name="action" value="updateProjectInfo">
				<label>
					Selecione um projeto:<br>
					<select name="user_project_name">
					</select><br>
				</label><br>
				<label>
					Email do responsável pelo projeto:<br>
					<input type="text" name="user_email" value=""><br>
				</label><br>
				<label>
					Domínio do projeto:<br>
					<input type="text" name="project_domain" value=""><br>
				</label><br>
				<label>
					<input type="submit" value="Atualizar Informações do Projeto"><br>
				</label><br>
				<hr>
			</form>
			<form action="#" method="post">
				<h2>Remover Projeto</h2>
				<input type="hidden" name="action" value="removeProject">
				<label>
					Selecione um projeto:<br>
					<select name="user_project_name">
					</select><br>
				</label><br>
				<label>
					<input type="submit" value="Remover Projeto"><br>
				</label><br>
				<hr>
			</form>
		</main>
<?php
include "views/foot.php";
?>