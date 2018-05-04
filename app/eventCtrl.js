app.controller('eventCtrl',function($http, $scope){
    
    $scope.equipments ={};

$http.get("php/getequipment.php")
    .then(function(response){
        $scope.equipments = response.data.equipments;
    });
    
    
});





