//Vue.http.options.root = 'http://127.0.0.1/sinxfs/index.php';
/*var App = Vue.component("App", {
	template: `<span></span>`,
	data() {
	  return {
		utenti: [
		  {
			id: 1,
			nome: "Utente 1"
		  },
		  {
			id: 2,
			nome: "Utente 2"
		  },
		  {
			id: 3,
			nome: "Utente 3"
		  }
		]
	  };
	},
	created: function () {
        this.getFilms();
    },
    methods: {
        getFilms: function () {
            this.$http.get('test.php').then(response => {
                this.items = response.body;
            }, response => {
                alert(response);
            });
        }
    }
  });*/
  
  new Vue({
	el: '#app',
	data: {
		origin: ''
	 },
 
	 ready: function() {
 
		 // GET request
		 this.$http.get('http://httpbin.org/ip', function (data) {
			 // set data on vm
			 this.$set('origin', data)
 
		 }).error(function (data, status, request) {
			 // handle error
			 alert("no response");
		 })
 
	   }
  });
  