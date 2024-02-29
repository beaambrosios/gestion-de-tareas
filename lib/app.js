var app = angular.module('crud', []);

app.controller('crudController', ['$scope', '$http', function ($scope, $http) {

        $scope.tareas = [];
        $scope.tarea = {};
        $scope.detalle_tarea = {};
        $scope.errors = [];
        $scope.tarea = {
            completada: 0
        };

        //list
        $scope.listTarea = function () {
            $http.get('php/list.php', {})
                    .then(function success(e) {
                        $scope.tareas = e.data.tareas;
                    }, function error(e) {

                        console.log("Se ha producido un error al recuperar la información");
                    });
        };

        $scope.listTarea();

        //método para registrar 
        $scope.addTarea = function () {
            console.log('Datos de la tarea:', $scope.tarea);
   
            $http.post('php/create.php', {
                tarea: $scope.tarea
            })
                    .then(function success(e) {

                        $scope.errors = [];

                        $scope.tareas.push(e.data.tarea);

                        var modal_element = angular.element('#add_new_modal');
                        modal_element.modal('hide');


                        // Limpiar el objeto de tarea después de agregar
                        $scope.tarea = {};

                        // Actualizar la lista de tareas después de agregar
                        $scope.listTarea();

                    }, function error(e) {

                        $scope.errors = e.data.errors;

                    });
        };

        //eliminar
        $scope.delete = function (index) {

            var conf = confirm("¿Realmente quieres eliminar la tarea?");

            if (conf == true) {

                $http.post('php/delete.php', {
                    tarea: $scope.tareas[index]
                })
                        .then(function success(e) {

                            $scope.errors = [];

                            $scope.tareas.splice(index, 1);

                        }, function error(e) {

                            $scope.errors = e.data.errors;
                        })
            }

        };

        //recuperar
        $scope.edit = function (index) {

            $scope.detalle_tarea = $scope.tareas[index];

            var modal_element = angular.element('#modal_update');
            modal_element.modal('show');
        };

        //actualizar
        $scope.updateTarea = function () {

            $http.post('php/update.php', {
                tarea: $scope.detalle_tarea
            })
                    .then(function success(e) {

                        $scope.errors = [];

                        var modal_element = angular.element('#modal_update');
                        modal_element.modal('hide');

                    }, function error(e) {

                        $scope.errors = e.data.errors;
                    });
        };

        $scope.markAsCompleted = function(tarea) {
                console.log('Tarea:', tarea);
                console.log('Valor de completada antes del cambio:', tarea.completada);
                
                tarea.completada = !tarea.completada ? 0 : 1;

                console.log('Valor de completada después del cambio:', tarea.completada);

                $http.post('php/mark_as_completed.php', { id: tarea.id, completada: tarea.completada })
                    .then(function success(response) {
                        // Actualizar la lista de tareas después de marcar como completada
                        $scope.listTarea();
                    }, function error(response) {
                        $scope.errors = e.data.errors;
                        console.log('Error al marcar tarea como completada');
                    });
        };


    }]);