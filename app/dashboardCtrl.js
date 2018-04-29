app.controller('dashboardCtrl',function($http, $scope,$route, $rootScope){

    $scope.members = [];
    
    
    $http.get("php/select.php")
    .then(function(response){
          $scope.members = response.data.members;
    });
    
    $http.get("php/getequipment.php")
    .then(function(response){
        $scope.equipments = response.data.equipments;
        $scope.inventorydb = response.data.inventory;
    });
    
    $scope.addMember = function(member){
        $http({
            url:'php/addmember.php',
            method:'POST',
            data:member
        })
        .then(function(){
            $rootScope.ta = 1;
            $route.reload();
            alert("Member has been successfully added");
        });
    };
    
    $scope.addItem = function(inventory){
        $http({
            url:'php/additem.php',
            method:'post',
            data:inventory
        }).then(function(){
            $rootScope.ta=2;
            $route.reload();
            alert("Item has been successfully added");
        });
    };
    
    
    $scope.addEquipment = function(equipment) {
        $http({
            url:'php/equipment.php',
            method:'post',
            data:equipment
        }).then(function(response){
            $rootScope.ta=3;
            $route.reload();
            alert("Equipment has been successfully added");
        });
    };
    
});