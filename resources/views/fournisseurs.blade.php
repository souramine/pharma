@extends('layouts.master', ['titre' => 'Pharmaciens', 
                            'nomPage' => 'Pharmacologie / Pharmaciens',
                            'titrePage' => 'Pharmaciens' ])

@section('content')
   <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List des pharmaciens&nbsp;&nbsp;<button type="button" class="btn  btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-lg">Ajouter</button></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body p-2">
          <table class="table table-striped projects" id="example1">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 13%">
                          Nom - Prénom
                      </th>
                      <th style="width: 15%">
                          Email - Tél
                      </th>
                      <th style="width: 25%">
                          Hopital - Service
                      </th>
                      <th style="width: 15%" class="text-center">
                          Specialité - Grade
                      </th>
                      <th style="width: 30%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>
                          #
                      </td>
                      <td>
                          BORSALI Nabil
                          <br/>
                          <small>
                              01.01.2019 Tlemcen
                          </small>
                      </td>
                      <td>
                          Abderrahmen@email.com
                          <br>
                          <small>
                              0673299081
                          </small>
                      </td>
                      <td>
                         Centre Hospitalier Tlemcen<br>
                         <small> Neurologie </small>
                      </td>
                      <td class="project-state">
                        Neurologie<br>
                          <span class="badge badge-success">Admin</span>
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
                          <span class="btn btn-danger btn-sm" onclick="deleteLigne(1)" style="cursor: pointer;">
                              <i class="fas fa-trash">
                              </i>
                              Supp
                          </span>
                      </td>
                  </tr>

              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajouter un Pharmacien</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
              <button type="button" class="btn btn-primary">Sauvegarder</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
@stop

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/js/datatables/dataTables.bootstrap4.css') }}">
  <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('/js/sweetalert2/sweetalert2.min.css') }}">
@stop

@section('js')
  <!-- DataTables -->
  <script src="{{ asset('js/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{ asset('js/datatables/dataTables.bootstrap4.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('js/sweetalert2/sweetalert2.min.js')}}"></script>

  <!-- page script -->
  <script>
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
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "/chimio/protocole/"+id,
                    method : "POST",              
                    success: function(data){                  
                      Swal.fire({
                        title:'Supprimé!',
                        text:'Le protocole a été supprimé..',
                        type:'success',
                         onClose :function () {
                            //location.href = '';
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

  </script>
@stop
