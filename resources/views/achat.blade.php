@extends('layouts.master', ['titre' => 'Achat', 
                            'nomPage' => 'Pharmacologie / Achat',
                            'titrePage' => 'Achat' ])

@section('content')
   <!-- Default box -->
      <div class="card">
        <div class="card-header">
           <h3 class="card-title">List des achats&nbsp;&nbsp;<button type="button" class="btn  btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-default">Ajouter</button></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        @if($lots->isEmpty())
          <div class="alert alert-info alert-dismissible" style="text-align: center">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-info"></i> Alert!</h5>
                  Info alert preview. This alert is dismissable.
          </div>
        @else
        <div class="card-body p-2">
          <table class="table table-striped projects" id="example1">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 25%">
                          Nom - Famille
                      </th>
                      <th style="width: 10%">
                          Dosage
                      </th>
                      <th style="width: 10%">
                          Forme
                      </th>
                      <th style="width: 10%">
                          Solvant
                      </th>
                      <th style="width: 10%" class="text-center">
                          Volume
                      </th>
                      <th style="width: 10%" class="text-center">
                          Voie
                      </th>
                      <th style="width: 40%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($lots as $l)
                  <tr>
                      <td>
                          {{$l->id}}
                      </td>
                      <td>
                          {{$l->date_fabrication}}

                          (<small>{{$l->famille}}</small>)
                      </td>
                      <td>
                          {{$l->dosage}}&nbsp;{{$l->unite}}
                      </td>
                      <td>
                          {{$l->forme}}
                      </td>
                      <td>
                         {{$l->solvant}}  
                      </td>
                      <td>
                        {{$l->volume}}&nbsp;{{$l->unite_volume}}
                      </td>
                      <td>
                        {{$l->voie}}
                      </td>
                      <td class="project-actions text-right">
                          <span class="btn btn-primary btn-sm" style="cursor: pointer;">
                              <i class="fas fa-folder">
                              </i>
                              Détail
                          </span>
                          <span class="btn btn-info btn-sm" style="cursor: pointer;">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Modi
                          </span>
                          <span class="btn btn-danger btn-sm" style="cursor: pointer;" onclick="deleteLigne({{$l->id}})">
                              <i class="fas fa-trash">
                              </i>
                              Supp
                          </span>
                      </td>
                  </tr>
                  @endforeach

              </tbody>
          </table>
        </div>
        @endif
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
<form action="{{ route('addAchat') }}" method="post">
                            {{ csrf_field() }}
           <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajouter un achat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <div class="row">
              <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tout les champs sont obligatoire</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="">Nom du médicament ou nom du DCI</label>
                <input type="text" name="medicament" id="medicament_nom" class="form-control">
                <input type="hidden" name="medicament_id" id="medicament_id">
              </div>
              <div class="form-group">
                <label for="">Nom du Fourniseur</label>
                <input type="text" name="fournisseur" id="fournisseur_nom" class="form-control">
                <input type="hidden" name="fournisseur_id" id="fournisseur_id">
              </div>
             
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Prix Total du produit&nbsp;&nbsp;</label> 
                    <input type="number" name="prix" style="text-align: center" id="" class="form-control col-md-7">    
                </div>

                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Quantité acheter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="number" name="quantite_acheter" style="text-align: center" id="" class="form-control col-md-7">    
                </div>

                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Quantité minimum&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="number" name="quantite_minimum" style="text-align: center" id="" class="form-control col-md-7">    
                </div>
             
              
            
	              <div class="form-group form-inline">
		                <label for="">&nbsp;&nbsp;&nbsp;Date de fabrication&nbsp;&nbsp;&nbsp;&nbsp;</label> 
		                <input type="date" name="date_f" style="text-align: center" id="" class="form-control col-md-7">    
	              </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Date de péremption&nbsp;&nbsp;&nbsp;</label> 
                    <input type="date" name="date_p" style="text-align: center" id="" class="form-control col-md-7">    
                </div>
                <div class="form-group form-inline">
                    <label for="">&nbsp;&nbsp;&nbsp;Date d'achat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                    <input type="date" name="date_a" style="text-align: center" id="" class="form-control col-md-7">    
                </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
              <input type="submit" class="btn btn-primary" value="Sauvegarder">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  </form>
@stop

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/js/datatables/dataTables.bootstrap4.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('/js/sweetalert2/sweetalert2.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('/js/toastr/toastr.min.css') }}">
  <!-- jquery-ui.css-->
  <link rel="stylesheet" href="{{ asset('/css/jquery-ui/jquery-ui.css') }}">
@stop

@section('js')
  <!-- DataTables -->
  <script src="{{ asset('js/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{ asset('js/datatables/dataTables.bootstrap4.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('js/sweetalert2/sweetalert2.min.js')}}"></script>
  <!-- Toastr -->
  <script src="{{ asset('js/toastr/toastr.min.js')}}"></script>

  <script src="{{ asset('/js/jquery/jquery-ui.min.js')}}"></script> 

  <!-- page script -->
  <script>
      @if(session('message'))
          toastr.success('Achat lot Ajoutée');
      @endif
    //data table
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
     function deleteLigne(id){
    Swal.fire({
        backdrop: `
        rgba(255,0,0,0.4)
      `,
      title: 'Êtes-vous sûr?',
      text: "Vous ne pourrez pas revenir en arrière!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Oui, supprimez-le!',
      cancelButtonText:'Annuler'

    }).then((result) => {
      if (result.value) {
            $.ajax({
                    url: "/achat/delete/"+id,
                    method : "POST",   
                    data: {
                    "_token": "{{ csrf_token() }}"
                    } ,        
                    success: function(data){            
                      Swal.fire({
                        title:'Supprimé!',
                        text:'Le achat a été supprimé..',
                        type:'success',
                         onClose :function () {
                            window.location.reload();
                          }
                      }                   
                      )           
                    },
                    error: function(data){
                        Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Quelque chose a mal tourné!'
                        })
                      }
                  }); 
      }
    })
      }
        //get médicament name
        $('input[id="medicament_nom"]').keydown(function() { 
        $(this).autocomplete({
          appendTo: $(this).parent(), // selectionner l'element pour ajouter la liste des suggestion
          source: function( request, response ) {
              $.ajax( {
                url: "/medicament",
                method : "POST",
                data: {
                  "_token": "{{ csrf_token() }}",
                  phrase: request.term // value on field input
                },
                success: function( data , status , code ) {
                    response($.map(data.slice(0, 15), function (item) { // slice cut number of element to show
                      return {
                          label : item.nom +" "+ item.dosage+" "+ item.unite, // pour afficher dans la liste des suggestions
                          value:  item.nom +" "+ item.dosage+" "+ item.unite, // value c la valeur à mettre dans l'input this
                          id:  item.id // récupérer id du médicament
                      };
                  }));
                }
              });
            },// END SOURCE
            select: function( event, ui ) {
              $("#medicament_id").attr("value",ui.item.id);
            }

          }).data("ui-autocomplete")._renderItem = function (ul, item) {//cette method permet de gérer l'affichage de la liste des suggestions
                 return $("<li style='cursor: pointer;background-color:#d2efee;'></li>")
                     .data("item.autocomplete", item)//récupérer les donnée de l'autocomplete
                     //.attr("data-value", item.id )
                     .append(item.label)//ajouter à la liste de suggestions
                     .appendTo(ul); 
                 };
      });

        //get fournisseur name
        $('input[id="fournisseur_nom"]').keydown(function() { 
        $(this).autocomplete({
          appendTo: $(this).parent(), // selectionner l'element pour ajouter la liste des suggestion
          source: function( request, response ) {
              $.ajax( {
                url: "/fournisseur",
                method : "POST",
                data: {
                  "_token": "{{ csrf_token() }}",
                  phrase: request.term // value on field input
                },
                success: function( data , status , code ) {
                    response($.map(data.slice(0, 15), function (item) { // slice cut number of element to show
                      return {
                          label : item.name +">>>>>"+ item.mail, // pour afficher dans la liste des suggestions
                          value:  item.name +">>>>>"+ item.mail, // value c la valeur à mettre dans l'input this
                          id:  item.id // récupérer id du médicament
                      };
                  }));
                }
              });
            },// END SOURCE
            select: function( event, ui ) {
              $("#fournisseur_id").attr("value",ui.item.id);
            }

          }).data("ui-autocomplete")._renderItem = function (ul, item) {//cette method permet de gérer l'affichage de la liste des suggestions
                 return $("<li style='cursor: pointer;'></li>")
                     .data("item.autocomplete", item)//récupérer les donnée de l'autocomplete
                     //.attr("data-value", item.id )
                     .append(item.label)//ajouter à la liste de suggestions
                     .appendTo(ul); 
                 };
      });
  </script>
@stop
