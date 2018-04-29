app.controller('contactCtrl', function($scope,$http){
    
    $scope.sendMail = function(data)
    {
        $http({
            url:'php/sendmail.php',
            method:'post',
            data:data
        })
        .then(function(response)
             {
            alert("Your mail is successfully sent.");
        });
        
    };
});