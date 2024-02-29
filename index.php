<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gestion de Tareas</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <link rel="stylesheet" href="bootstrap/css/estilos.css">
    </head>
    <body ng-app="crud">

        <div ng-controller="crudController">

            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h1 style="text-align: center;"><i class="fas fa-tasks"></i> Gestion de Tareas</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button class="btn btn-success" data-toggle="modal" data-target="#add_new_modal"> 
                                <i class="fas fa-plus-circle"></i> Nueva Tarea
                            </button>
                        </div>
                    </div>
                </div>

                <div class="container" style="background-color: #343a40; border-radius: 10px; padding: 20px; margin-top: 20px;">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="color: #fff;"><i class="glyphicon glyphicon-list"></i> Tareas:</h3>
                        <div class="panel panel-default">
                        <div class="panel-body">
                        <table ng-if="tareas.length > 0" class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th>N°</th>
                                <th>Nombre Tarea</th>
                                <th>Acción</th>
                            </tr>
                            <tr ng-repeat="pab in tareas" ng-class="{ 'completada': pab.completada == 1 }">
                                <td>{{$index + 1}}</td>
                                <td ng-class="{ 'tachado': pab.completada == 1 }">{{pab.nombre}}</td>
                                <td>
                                    <input type="checkbox" ng-model="pab.completada" ng-change="markAsCompleted(pab)">
                                    <label><i class="fas fa-check" ng-if="pab.completada"></i></label>
                                    <button ng-click="delete($index)" class="btn btn-danger btn-xs"><i class="fas fa-trash alt"></i> </button>
                                </td>
                            </tr>
                        </table>
                        </div></div>
                    </div>
                </div></div>


                <!-- Bootstrap Modals -->

                <div class="modal fade" id="add_new_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Nueva Tarea</h4>
                            </div>
                            <div class="modal-body">

                                <ul class="alert alert-danger" ng-if="errors.length > 0">
                                    <li ng-repeat="error in errors">
                                        {{ error}}
                                    </li>
                                </ul>

                                <div class="form-group">
                                    <label for="nombre">Nombre Tarea</label>
                                    <input ng-model="tarea.nombre" type="text" id="nombre" class="form-control"/>
                                    <input ng-model="tarea.completada" type="hidden" id="completada" class="form-control" />
                                </div>
                                    

                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" ng-click="addTarea()">Guardar tarea</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Modal -->

                <!-- Modal - Update -->
                <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Editar tarea</h4>
                            </div>
                            <div class="modal-body">

                                <ul class="alert alert-danger" ng-if="erros.length > 0">

                                    <li ng-repeat="error in errors">

                                        {{ error}}

                                    </li>

                                </ul>

                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input ng-model="detalle_tarea.nombre" type="text" id="nombre" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="numero">Completada</label>
                                    <input ng-model="detalle_tarea.completada" type="number" id="numero" class="form-control"/>
                                </div>
                                

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button ng-click="updateTarea()" type="button" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Modal -->





            </div>


        </div>


        <script type="text/javascript" src="lib/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="lib/angular.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="lib/app.js"></script>	

    </body>
</html>