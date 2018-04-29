app.controller('adminCtrl',['adminService','$scope','$http','$location','$rootScope', function(adminService, $scope,$http, $location, $rootScope){
    
    $scope.validate = function(admin){
        $http({
            url:'php/authenticate.php',
            method:'Post',
            data:admin
        })
        .then(function(response){
            if(response.data.status == 'green')
                {
                    adminService.saveData(response.data);
                    $rootScope.uniqueid= response.data.id;
                    $location.path('/dashboard');
                }
            else{
                alert(response.data.message);
            }
        })
    }
    
}]);