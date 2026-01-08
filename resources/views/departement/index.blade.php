<style>
   .table-container {
    overflow-x: auto;
    margin: 2rem 0;
    }

    .modern-table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .modern-table thead {
    background: #00c4b3;
    color: #fff;
    text-align: left;
    }

    .modern-table th,
    .modern-table td {
    padding: 12px 15px;
    }

    .modern-table tbody tr {
    border-bottom: 1px solid #ddd;
    transition: background 0.3s;
    }

    .modern-table tbody tr:hover {
    background: #f1f1f1;
    }

    .modern-table tbody tr:last-child {
    border-bottom: none;
    }

    /* Responsive small screens */
    @media (max-width: 600px) {
    .modern-table thead {
        display: none;
    }
    .modern-table, 
    .modern-table tbody, 
    .modern-table tr, 
    .modern-table td {
        display: block;
        width: 100%;
    }
    .modern-table tr {
        margin-bottom: 1rem;
        border-bottom: 2px solid #ddd;
    }
    .modern-table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
    .modern-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: calc(50% - 15px);
        text-align: left;
        font-weight: bold;
    }
    }


    .button{
        display: flex;
        justify-content: end;
    }
</style>

<x-app-layout>
    

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="button">
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#createModal">Insérer</button>
                    </div>
                   

                    <div class="table-container">
                         @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="modern-table">
                            <thead>
                            <tr>
                                <th>Abbreviation</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Responsable</th>
                                <th>Parametre</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($dep->isEmpty())
                                Aucune donnée Affiché
                            @else
                                @foreach ($dep as $d)
                                    <tr>
                                        <td>{{ $d->abrev }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->descri }}</td>
                                        <td>
                                            @if ($d->id_employee !== null)
                                                {{ $d->id_employee }}
                                            @else
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addEm{{ $d->id }}">
                                                    Ajouter
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $d->id }}">
                                                <i class="fa fa-classic fa-solid fa-sliders"></i>
                                            </button>
                                             <form action="{{ route('departement.destroy', $d->id) }}" method="post" 
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button is-danger" type="submit">
                                                    <i class="fa fa-classic fa-solid fa-trash-can"></i>
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- FORMULAIRE UNIQUE PAR MODAL -->
                                                <form id="editForm"  action="{{ route('departement.update', $d->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <label>Nom</label>
                                                            <input type="text" class="form-control" id="edit_name" name="name"  value="{{ $d->name }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label>Abréviation</label>
                                                            <input type="text" class="form-control" id="edit_name" name="abrev"  value="{{ $d->abrev }}">
                                                        </div>

                                                        <input type="hidden" name="id_employee">

                                                        <div class="mb-3">
                                                            <label>Description</label>
                                                            <textarea class="form-control" id="edit_descri" name="descri"  value="">{{ $d->descri }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label>Responsable</label>
                                                            <input type="text" class="form-control" id="edit_name" name="resp"  value="{{ $d->responsable }}">
                                                        </div>
    

                                                        

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="addEm{{ $d->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- FORMULAIRE UNIQUE PAR MODAL -->
                                                <form id="editForm"  action="" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-body">

                                                        

                                                        <!-- Année -->
                                                        <div class="mb-3">
                                                            <label for="annee" class="form-label">Responsable</label>
                                                        <input type="text" class="form-control" id="annee" name="abrev" value="{{$d->abrev}}" required>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                               
                            @endif
                            </tbody>
                        </table>
                    </div>


                    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Ajouter le projet</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                  @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <!-- Affichage des erreurs -->
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                <!-- FORMULAIRE UNIQUE PAR MODAL -->
                                <form id="editForm"  action="{{ route('departement.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                   
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label>Nom</label>
                                            <input type="text" class="form-control" id="edit_name" name="name"  value="">
                                        </div>

                                        <div class="mb-3">
                                            <label>Abréviation</label>
                                            <input type="text" class="form-control" id="edit_name" name="abrev"  value="">
                                        </div>

                                        <input type="hidden" name="id_employee">

                                        <div class="mb-3">
                                            <label>Description</label>
                                            <textarea class="form-control" id="edit_descri" name="descri"  value=""></textarea>
                                        </div>

                                                

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
