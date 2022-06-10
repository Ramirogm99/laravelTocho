<section class="content">
    <div class="box">
        <div class="box-header">

        </div>
        <input type="hidden" id="urlapp" value="http://loscalhost/alquiler/">

        <div class="box-body">


            <form action="{{ url('vallas/porFinalizar') }}" class="my_form row" enctype="multipart/form-data"
                method="post" accept-charset="utf-8">

                @csrf

                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">



                        </div>
                        <div class="card-body row">

                            <div class="form-group col-md-8">
                                <label for="f_fin">Fecha de busqueda*</label> <input type="datetime-local" name="f_fin"
                                    id="f_fin"
                                    value="{{ str_replace(' ', 'T', date('Y-m-d H:i', strtotime('+1 day'))) }}"
                                    min="{{ str_replace(' ', 'T', date('Y-m-d H:i')) }}" class="form-control input-lg"
                                    required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="margen">Plazo*</label>
                                <select name="plazo" id="plazo" class="form-control input-lg" required>
                                    <option selected value="7"> 7 días</option>
                                    <option value="15"> 15 días</option>
                                    <option value="30"> 1 mes</option>
                                    <option value="60"> 2 meses</option>
                                    <option value="90"> 3 meses</option>
                                    <option value="180"> 6 meses</option>
                                    <option value="365"> 1 año</option>

                                </select>
                            </div>


                            <div class="form-group col-md-4">
                            </div>

                            <div class="col-12">

                                <div class="card card-primary">
                                    <div class="card-footer text-center">

                                        <button type="button" name="mysubmit" data-toggle="modal"
                                            data-target="#modalmessage" class="btn btn-primary ">Filtrar</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </div>


    <div class="modal fade" id="modalmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmación de consulta
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de que desea realizar la búsqueda? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    </div>
    </div>
</section>
