<!DOCTYPE html>
<html lang="ru_RU" class="wf-ceraroundpro-n4-active wf-active">
<head>
	<meta charset="UTF-8">
	<title>Тестовое задание</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/kt1.css">
	<link rel="stylesheet" href="css/kt2.css">
	<link rel="stylesheet" href="style.css">
	
	<script src="js/axios.min.js"></script>
</head>
<body class="page-template-default page page-child">
	
	<div id="root">
		<nav class="main_header_content center_cnt">
			<a class="navbar-brand" href="http://localhost/"><img src="https://k-telecom.org/wp-content/themes/template/img/logo-2018.png" alt="logo" class="logo-custom"></a>
		</nav>

		<div class="container p-5">
			<div class="row">

				<div class="alert alert-danger col-md-6" id="alertMessage" role="alert" v-if="errorMessage">
					{{ errorMessage }}
				</div>

				<div class="alert alert-success col-md-6" id="alertMessage" role="alert" v-if="successMessage">
					{{ successMessage }}
				</div>
			<div class="tel_tab_page active tel_tab_content tablet_margin_top">
				<table class="table  telephony__tariff_header">
					<thead class="tel_tab_header">
						<tr>
							<th>ФИО</th>
							<th>Дата занесения</th>
							<th>Тип лица</th>
							<th>Сумма денежных операций</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="tel_tab_body">
						<tr v-for="user in users" class="tel_region_item">
							<td  @click="showinghistModal = true; selectUser(user);">{{user.fio}}</td>
							<td>{{user.datecreate}}</td>
							<td>{{user.summ}}</td>
							<td>{{user.type}}</td>
							<td><button @click="showingeditModal = true; selectUser(user);" class="btn btn-warning">Правка</button></td>
							<td><button @click="showingdeleteModal = true; selectUser(user);" class="btn btn-danger">Удалить</button></td>
						</tr>
					</tbody>
				</table>
			</div>
</div>
								<button class="btn btn-link" @click="showingaddModal = true;">Добавить запись</button>
				</div>

	<!-- add modal -->
		<div class="modal col-md-6" id="addmodal" v-if="showingaddModal">
				<div class="modal-head">
					<p class="p-left p-2">Добавить запись</p>
					<hr/>

					<div class="modal-body">
							<div class="col-md-12">
								<label for="uname">ФИО</label>
								<input type="text" id="uname" class="form-control" v-model="newUser.fio">

								<label for="email">Адрес</label>
									<input type="text" id="email" class="form-control" v-model="newUser.datecreate">

								<label for="is_jur_true">Юридическое лицо</label>
								<input type="checkbox" id="is_jur_true" class="form-control" true-value=1 false-value=0 v-model="newUser.type">
							</div>

						<hr/>
							<button type="button" class="btn btn-success"  @click="showingaddModal = false; addUser();">Сохранить</button>
							<button type="button" class="btn btn-danger"   @click="showingaddModal = false;">Закрыть</button>
					</div>
				</div>
			</div>

	<!-- show bill history modal -->
		<div class="modal col-md-6" id="historymodal" v-if="showinghistModal">
				<div class="modal-head">
					<p class="p-left p-2">История платежей</p>
					<hr/>

					<div class="modal-body">
					<table class="table">
					<thead class="tel_tab_header">
						<tr>
							<th>Дата</th>
							<th>Сумма</th>
							<th>Продукт</th>
						</tr>
					</thead>
					<tbody class="tel_region_item">
						<tr v-for="bill in bill">
							<td>{{bill.date}}</td>
							<td>{{bill.summ}}</td>
							<td>{{bill.product}}</td>
						</tr>
					</tbody>
				</table>
						<hr/>
							<button type="button" class="btn btn-danger"   @click="showinghistModal = false;">Закрыть</button>
					</div>
				</div>
			</div>

	<!-- edit modal -->
		<div class="modal col-md-6" id="editmodal" v-if="showingeditModal">
			<div class="modal-head">
				<p class="p-left p-2">Редактировать запись</p>
				<hr/>

				<div class="modal-body">
						<div class="col-md-12">
							<label for="uname">ФИО</label>
							<input type="text" id="uname" class="form-control" v-model="clickedUser.fio">

							<label for="email">Дата занесения</label>
							<input type="text" id="email" class="form-control" v-model="clickedUser.datecreate">

							<label for="is_jur_true">Юридическое лицо</label>					
							<input type="checkbox" id="is_jur_true" class="form-control" true-value=1 false-value=0 v-model="newUser.type">
						</div>

					<hr/>
						<button type="button" class="btn btn-success"  @click="showingeditModal = false; updateUser();">Сохранить</button>
						<button type="button" class="btn btn-danger"   @click="showingeditModal = false;">Закрыть</button>
				</div>
			</div>
		</div>


		<!-- delete data -->
		<div class="modal col-md-6" id="deletemodal" v-if="showingdeleteModal">
			<div class="modal-head">
				<p class="p-left p-2">Удалить запись</p>
				<hr/>

				<div class="modal-body">
						<center>
							<p>Действительно желаете удалить?</p>
							<h3>{{clickedUser.username}}</h3>
						</center>
					<hr/>
						<button type="button" class="btn btn-danger"  @click="showingdeleteModal = false; deleteUser();">Да</button>
						<button type="button" class="btn btn-warning"   @click="showingdeleteModal = false;">Нет</button>
				</div>
			</div>
		</div>

	</div>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/vue.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>