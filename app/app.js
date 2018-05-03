var app = angular.module('sudosk',['ngRoute']);

app.config(['$routeProvider',
            function($routeProvider){
   
    $routeProvider
    
    .when('/',{
    title: 'SUDOSK',
    templateUrl: 'partials/main.html'
    })
    .when('/events',{
        templateUrl: 'partials/events.html'
    })
    .when('/admin',{
         resolve: {check: function($location, adminService) {
            if(adminService.isAdminLoggedIn())
                {  
                    $location.path('/dashboard');
                }
                },
            },
        templateUrl: 'partials/admin.html',
        controller: 'adminCtrl',
    })
    .when('/logout', {
        deadResolve: function($location, admin){
            admin.clearData();
            $location.path('/');
        }
    })
    .when('/dashboard',{
        resolve:{check: function($location, adminService) {
            if(!adminService.isAdminLoggedIn())
                {
                    alert("404 Access Denied");  
                    $location.path('/admin');
                }
                },
            },  
        templateUrl: 'partials/dashboard.html',
        controller: 'dashboardCtrl'
    })
     .when('/news',{
        templateUrl: 'partials/news.html',
        contoller: 'equipmentCtrl'
    })
     .when('/contact',{
        templateUrl: 'partials/contact.html',
        controller:'contactCtrl'
    })
    .otherwise({
           redirectTo: '/'
           });
    
}]);
    
app.service('adminService', function(){
   var email;
    var loggedin = false;
    var id;
    
    
    this.getName = function(){
        return email;
    };
    
    this.setID = function(adminID){
        this.id = adminID;
    };
    
    this.getID = function()
    {
        return this.id;
    }; 
    
    this.saveData = function(data){
      id = data.uniqueid;
      email = data.email;
      loggedin = true;
      localStorage.setItem('login', JSON.stringify({
          email: email,
          id: id
      }));
    };
    
    this.clearData = function (){
        localStorage.removeItem('login');
        email = "";
        id = "";
        loggedin=false;
    }
    
    this.isAdminLoggedIn = function(){
        if(!!localStorage.getItem('login')) {
			loggedin = true; 
			var data = JSON.parse(localStorage.getItem('login'));
			email = data.email;
			id = data.id;
		}
        return loggedin;  
    };
   
    
});