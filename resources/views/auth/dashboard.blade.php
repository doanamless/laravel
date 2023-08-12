<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Custom Authentication</title>

</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h2>Gestion De Vehicules</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" onclick="add()" href="javascript:void(0)"> Create Vehicule</a>
        </div>
    </div>
</div>

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped table-hover text-center" style="max-width: 1200px; margin: 0 auto;">
            <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Type</th>
                <th>Marque</th>
                <th>Prix</th>
                <th>Date Acquisition</th>
                <th>Première Kilométrage</th>
                <th>Puissance Fiscale</th>
                <th>Consommation</th>
                <th>Carburant</th>
                <th>Référence</th>
            </tr>
            </thead>
            <!-- Table body goes here -->
        </table>
    </div>
</div>
<!-- bootstrap vehicule modal -->

<div class="modal fade" id="vehicule-modal"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Vehicule</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="javascript:void(0)" id="VehiculeForm" name="VehiculeForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="designation" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Entrer Type" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="marque" class="col-sm-2 control-label">Marque</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="marque" name="marque" placeholder="Entrer Marque" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prix" class="col-sm-2 control-label">Prix</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="prix" name="prix" placeholder="Entrer Prix" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date_aquisition" class="col-sm-2 control-label">Date D'aquisition</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="date_aquisition" name="date_aquisition" placeholder="Date"  required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prem_km" class="col-sm-2 control-label">1er Kilométrage(Km)</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="prem_km" name="prem_km" placeholder="Kelométrage"  required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="puissance" class="col-sm-2 control-label">Puissance Fiscal</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="puissance" name="puissance" placeholder="Puissance Fiscal"  required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="consommation" class="col-sm-2 control-label">Consommation</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="consommation" name="consommation" placeholder="Consommation"  required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="carburant" class="col-sm-2 control-label">Carburant</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="carburant" name="carburant" placeholder="Type Carburant"  required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reference" class="col-sm-2 control-label">Reference</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="reference" name="reference" placeholder="Entrer Reference"  required="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10"><br/>
                        <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--End of bootstrap modal -->
<script type="text/javascript">
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    function add(){
        $('#vehicule-modal').modal('show');
    }

    $('#VehiculeForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'store',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

</script>
</body>
</html>
