var app = new Vue({

  el: "#root",
  data: {
	  showingaddModal: false,
	  showingeditModal: false,
	  showingdeleteModal: false,
	  showinghistModal: false,
  	errorMessage: "",
  	successMessage: "",
	  users: [],
	  bill: [],
  	newUser: {fio: "", datecreate: "", type: 0},
  	clickedUser: {},
  },
    mounted: function () {
  	console.log("Не подсматривай!");
  	this.getAllUsers();
  },

  methods: {
  	getAllUsers: function () {
  		axios.get('http://localhost/api/v1.php?action=read')
  		.then(function (response) {
  			console.log(response);

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.users = response.data.users;
  			}
  		})
	  },
	  
	  showHist: function() {
		axios.get('http://localhost/api/v1.php?action=readhist', formData)
		.then(function (response) {
			console.log(response);

			if (response.data.error) {
				app.errorMessage = response.data.message;
			} else {
				app.users = response.data.bill;
			}
		})
	  },

  	addUser: function () {
  		var formData = app.toFormData(app.newUser);
  		axios.post('http://localhost/api/v1.php?action=create', formData)
  		.then(function (response) {
  			console.log(response);
  			app.newUser = {fio: "", datecreate: "", type: 0};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
  				app.getAllUsers();
  			}
  		});
  	},

  	updateUser: function () {
  		var formData = app.toFormData(app.clickedUser);
  		axios.post('http://localhost/api/v1.php?action=update', formData)
  		.then(function (response) {
  			console.log(response);
  			app.clickedUser = {};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
  				app.getAllUsers();
  			}
  		});
  	},

  	deleteUser: function () {
  		var formData = app.toFormData(app.clickedUser);
  		axios.post('http://localhost//api/v1.php?action=delete', formData)
  		.then(function (response) {
  			console.log(response);
  			app.clickedUser = {};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
  				app.getAllUsers();
  			}
  		})
  	},

  	selectUser(user) {
  		app.clickedUser = user;
  	},

  	toFormData: function (obj) {
  		var form_data = new FormData();
  		for (var key in obj) {
  			form_data.append(key, obj[key]);
  		}
  		return form_data;
  	},

  	clearMessage: function (argument) {
  		app.errorMessage   = "";
  		app.successMessage = "";
  	},


  }
});