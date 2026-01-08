
<style>
    .carte{
        display: grid;
        grid-template-columns: repeat(4,4fr);
        gap: 1rem;
        width: 100%;
    }

    .bloc{
        width: 100%;
        height: 20rem;
        background: rgb(233, 233, 210);
        overflow: hidden;
        border-radius: 2rem;
        padding: .5rem;
    }

    .img{
        width: 9rem;
        height: 9rem;
        overflow: hidden;
        border-radius: 20%;
    }

    .img img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .content h3{
        font-size: 1.2rem;
    }

    .position{
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;

    }

    .position .post{
        padding: .5rem;
        background: rgb(105, 205, 252);
    }
    .position .dep{
        padding: .5rem;
        background: rgb(186, 248, 86);
    }
    .butoncarte{
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
    }

    .button{
        display: flex;
        justify-content: end;
    }

    .butoncarte button{
        width: 8rem;
        height: 2.5rem;
    }
   
    .modal-100w {
        max-width: 80% !important;
        margin: 0;
        background: #a81212 !important;
    }

    .profil-name{
        text-align: center;
        font-size: 1.2rem

    }

    .profil-flex{
            display: flex;
            justify-content: center;
        }

     .img-profil{
        /* margin-top: 2rem; */
        width: 12rem;
        height: 12rem;
        overflow: hidden;
        border-radius: 2rem;
        /* margin: 2rem; */
        

    }

    .dialog-show{
        display:flex; justify-content:space-between;
    }

    .img-profil img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .modal-flex{
        display: flex;
        justify-content: space-between;
        margin: 1rem 2rem;
        gap: 2rem;
    }

    .modal-flex .profil{
        width: 26rem;
        background: rgb(240, 239, 239);
        margin-right: 2rem;
        overflow: hidden;
    }

    .modal-flex .detailcontent{
        width: 100%;
    }

    .profil-name{
        margin-top: 1rem;       
        font-size: 1.2rem;
        font-weight: bold;

    }

    .social{
        margin: 2rem;
        /* text-align: center; */
        
    }

    .detailcontent{
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-direction:column;
    }

    .detail-identity{
        /* border-bottom: 2rem white inset ; */
        padding: 2rem;
        width: 100%;
        display: flex;
        justify-content: center;
        background: rgb(240, 239, 239);
        border-radius: 1rem;
    }

    .detail-identity div {
        width: 25rem;
        border:2rem;

    }

    .detail-identity div .title{
        text-align: center;
        font-size : 1.5rem;
        font-weight: bold;
    }


    .id-flex{
        
        display: flex;
        justify-content: space-between;
    }

    td {
        width: 15rem;
    }

    table{
        margin-top: 2rem;
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
                                
                     @if(session('success'))
                         <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                   
                    @endif
                                <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Employe</h5>
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
                                            <form id="editForm"  action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                    <!-- Nom -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Nom</label>
                                                            <input type="text" class="form-control" name="last_name" required>
                                                        </div>

                                                        <!-- Prénom -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Prénom</label>
                                                            <input type="text" class="form-control" name="first_name" required>
                                                        </div>

                                                        <!-- Genre -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Genre</label>
                                                            <select class="form-select" name="gender" required>
                                                                <option value="">Sélectionner...</option>
                                                                <option value="M">Homme</option>
                                                                <option value="F">Femme</option>
                                                            </select>
                                                        </div>

                                                        <!-- Date de naissance -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Date de naissance</label>
                                                            <input type="date" class="form-control" name="ddn" required>
                                                        </div>

                                                        <!-- Téléphone -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Téléphone</label>
                                                            <input type="text" class="form-control" name="phone" required>
                                                        </div>

                                                        <!-- Email -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Adresse mail</label>
                                                            <input type="email" class="form-control" name="mail" required>
                                                        </div>

                                                        <!-- Adresse -->
                                                        <div class="col-12">
                                                            <label class="form-label">Adresse</label>
                                                            <input type="text" class="form-control" name="addresse" required>
                                                        </div>

                                                        <!-- Département -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Département</label>
                                                            <select class="form-select" name="departement_id" required>
                                                                <option value="">Sélectionner...</option> 

                                                                @if($dep->isEmpty())
                                                                    Aucune donnée Affiché
                                                                @else
                                                                    @foreach ($dep as $d)
                                                                        <option value="{{ $d->id }}">{{ $d->abrev }}</option> 
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>

                                                        <!-- Position -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Poste</label>
                                                            <input type="text" class="form-control" name="position" required>
                                                        </div>

                                                    <div class="col-md-6">
                                                            <label class="form-label">Type de contrat</label>

                                                            <select name="contrat" class="form-select" required>

                                                                <option value="" disabled {{ old('contrat') ? '' : 'selected' }}>
                                                                    -- Sélectionner le type de contrat --
                                                                </option>

                                                                <option value="CDI"   {{ old('contrat', $e->contrat ?? '') == 'CDI' ? 'selected' : '' }}>CDI</option>
                                                                <option value="CDD"   {{ old('contrat', $e->contrat ?? '') == 'CDD' ? 'selected' : '' }}>CDD</option>
                                                                <option value="Stage" {{ old('contrat', $e->contrat ?? '') == 'Stage' ? 'selected' : '' }}>Stage</option>
                                                                <option value="Alternance" {{ old('contrat', $e->contrat ?? '') == 'Alternance' ? 'selected' : '' }}>Alternance</option>
                                                                <option value="Intérim" {{ old('contrat', $e->contrat ?? '') == 'Intérim' ? 'selected' : '' }}>Intérim</option>
                                                                <option value="Freelance" {{ old('contrat', $e->contrat ?? '') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                                                <option value="Consultant" {{ old('contrat', $e->contrat ?? '') == 'Consultant' ? 'selected' : '' }}>Consultant</option>

                                                            </select>
                                                        </div>

                                                        <!-- Salaire -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Salaire de base</label>
                                                            <input type="number" class="form-control" name="salary_base" required>
                                                        </div>

                                                        <!-- Date d'embauche -->
                                                        <div class="col-md-6">
                                                            <label class="form-label">Date d'embauche</label>
                                                            <input type="date" class="form-control" name="hire_date" required>
                                                        </div>

                                                        <!-- Photo -->
                                                        <div class="col-md-12">
                                                            <label class="form-label">Photo</label>
                                                            <input type="file" class="form-control" name="photo" accept="image/*">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button class="btn btn-primary" data-bs-dismiss="modal"  type="submit">Enregistre</button>
                                                    
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                    
                        @if($emp->isEmpty())
                            Aucune donnée pour employé
                        @else
                            <div class="carte">
                                @foreach ($emp as $e)
                               

                                    <div class="bloc">
                                        <div class="img">
                                            <img src="upload/{{ $e->photo }}" alt="" srcset="">
                                        </div>
                                        <div class="content">
                                            <h3>
                                                {{ $e->last_name }}
                                            </h3>
                                            <h4>
                                                {{ $e->first_name }}
                                                @php
                                                    $lastLeave = $e->leaves
                                                        ->whereIn('status',['accepte','refuse'])
                                                        ->sortByDesc('created_at')
                                                        ->first();
                                                @endphp
                                                @if ($lastLeave)
                                                    @if ($lastLeave->status === 'accepte')
                                                        <span class="badge btn-success"
                                                    >
                                                        En congé
                                                    </span>
                                                    @endif
                                                    
                                                @endif
                                            </h4>
                                        </div>
                                        <div class="position">
                                            <div class="post">
                                                {{ $e->position }}
                                            </div>
                                            <div class="dep">
                                                {{ $e->departement->abrev }}
                                            
                                            </div>
                                        </div>
                                        <div class="butoncarte">
                                            <button type="button" class="btn btn-dark"  data-bs-toggle="modal" data-bs-target="#detailModal{{ $e->id }}">Détail</button>
                                            <form 
                                                action="{{ route('employee.destroy', $e->id) }}" 
                                                method="post" 
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">
                                                    Supprimer
                                                </button>
                                                </form>

                                        </div>
                                        <div class="modal fade" id="detailModal{{ $e->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-100w">
                                                <div class="modal-content">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                                                    <div class="modal-flex">
                                                        <div class="profil">
                                                            <div class="profil-flex">
                                                                <div class="img-profil">
                                                                    <img src="upload/{{ $e->photo }}" alt="" srcset="">
                                                                </div>
                                                            </div>
                                                            
                                                            <h2 class="profil-name">
                                                                    {{$e->last_name}} <br> {{ $e->first_name }}
                                                            </h2>
                                                            
                                                            <div class="social">
                                                                <ul class="list">
                                                                    <li>
                                                                    <i class="fa-classic fa-solid fa-envelope"></i>
                                                                        {{ $e->mail }}
                                                                    </li>
                                                                    <li>
                                                                        <i class="fa-classic fa-solid fa-phone"></i>
                                                                        {{ $e->phone }}
                                                                    </li>
                                                                    <li>
                                                                        <i class="fa-classic fa-solid fa-location-dot">
                                                                        </i>
                                                                        {{ $e->addresse }}

                                                                    </li>
                                                                    <li>
                                                                        <i>

                                                                        </i>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                        <div class="detailcontent">
                                                            <div class="detail-identity">
                                                                <div>
                                                                    <h1 class="title">
                                                                        Détail employé
                                                                    <button type="button" class="btn btn-dark"  data-bs-toggle="modal" data-bs-target="#editModal{{ $e->id }}"><i class="fa-classic fa-solid fa-pen-to-square"></i></button>
                                                                        
                                                                    </h1>
                                                                    
                                                                    
                                                                    <div class="dialog-show">
                                                                        <div>Nom</div>
                                                                        <div>{{ $e->last_name }}</div>
                                                                    </div>
                                                                    <div class="dialog-show">
                                                                        <div>Préom</div>
                                                                        <div>{{ $e->first_name }}</div>
                                                                    </div>
                                                                    <div class="dialog-show">
                                                                        <div>Date de naissance</div>
                                                                        <div>{{ $e->ddn }}</div>
                                                                    </div>
                                                                    <div class="dialog-show">
                                                                        <div>Genre</div>
                                                                        <div>
                                                                            @if ($e->gender === "M")
                                                                                Homme
                                                                            @else
                                                                                Femme
                                                                            @endif</div>
                                                                    </div>
                                                                    
                                                                
                                                                </div>

                                                                
                                                            </div>
                                                            <div class="detail-identity">
                                                                <div>
                                                                
                                                                    
                                                                    <div class="dialog-show">
                                                                        <div>Département</div>
                                                                        <div>{{ $e->departement->abrev }}</div>
                                                                    </div>
                                                                    <div class="dialog-show">
                                                                        <div>Poste</div>
                                                                        <div>{{ $e->position }}</div>
                                                                    </div>
                                                                    <div class="dialog-show">
                                                                        <div>Contrat</div>
                                                                        <div>{{ $e->contrat }}</div>
                                                                    </div>
                                                                    <div class="dialog-show">
                                                                        <div>Salaire</div>
                                                                        <div>{{ $e->salary_base }} Ar</div>
                                                                    </div>
                                                                    <div class="dialog-show">
                                                                        <div>Date de recrutemnet</div>
                                                                        <div>
                                                                        {{ $e->hire_date }}
                                                                    </div>
                                                                    
                                                                
                                                                </div>
                                                            </div>
                                                                

                                                        </div>
                                                        
                                                        

                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="editModal{{ $e->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modifier</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <!-- FORMULAIRE UNIQUE PAR MODAL -->
                                                    <form id="editForm"  action="{{ route('employee.mod', $e->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row g-3">
                                                            <!-- Nom -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Nom</label>
                                                                    <input type="text" class="form-control" name="last_name" value={{ $e->last_name }} required>
                                                                </div>

                                                                <!-- Prénom -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Prénom</label>
                                                                    <input type="text" class="form-control" name="first_name" value={{ $e->first_name }} required>
                                                                </div>

                                                                <!-- Genre -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Genre</label>
                                                                    <select class="form-select" name="gender" required>
                                                                        @if($e->gender === "M")
                                                                            <option value="M">Homme</option>
                                                                            <option value="F">Femme</option>
                                                                        @else
                                                                            <option value="F">Femme</option>
                                                                            <option value="M">Homme</option>
                                                                        @endif
                                                                    </select>
                                                                </div>

                                                                <!-- Date de naissance -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Date de naissance</label>
                                                                    <input type="date" class="form-control" name="ddn" value={{ $e->ddn }} required>
                                                                </div>

                                                                <!-- Téléphone -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Téléphone</label>
                                                                    <input type="text" class="form-control" name="phone" value={{ $e->phone }} required>
                                                                </div>

                                                                <!-- Email -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Adresse mail</label>
                                                                    <input type="email" class="form-control" name="mail" value={{ $e->mail }} required>
                                                                </div>

                                                                <!-- Adresse -->
                                                                <div class="col-12">
                                                                    <label class="form-label">Adresse</label>
                                                                    <input type="text" class="form-control" name="addresse"  value={{ $e->addresse }} required>
                                                                </div>

                                                                <!-- Département -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Département</label>
                                                                    <select class="form-select" name="departement_id" required>
                                                                        <option value="{{ $e->departement->id }}">{{ $e->departement->abrev }}</option> 

                                                                        @forelse ($dep as $d)
                                                                            @if($d->id !== $e->departement->id)
                                                                                <option value="{{ $d->id }}">{{ $d->abrev }}</option>
                                                                            @endif
                                                                        @empty
                                                                            <option disabled>Aucune donnée affichée</option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>

                                                                <!-- Position -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Poste</label>
                                                                    <input type="text" class="form-control" name="position" value={{ $e->position }} required>
                                                                </div>

                                                                <select name="contrat" class="form-select" required>

                                                                        <option value="" disabled {{ old('contrat') ? '' : 'selected' }}>
                                                                            -- Sélectionner le type de contrat --
                                                                        </option>

                                                                        <option value="CDI"   {{ old('contrat', $e->contrat ?? '') == 'CDI' ? 'selected' : '' }}>CDI</option>
                                                                        <option value="CDD"   {{ old('contrat', $e->contrat ?? '') == 'CDD' ? 'selected' : '' }}>CDD</option>
                                                                        <option value="Stage" {{ old('contrat', $e->contrat ?? '') == 'Stage' ? 'selected' : '' }}>Stage</option>
                                                                        <option value="Alternance" {{ old('contrat', $e->contrat ?? '') == 'Alternance' ? 'selected' : '' }}>Alternance</option>
                                                                        <option value="Intérim" {{ old('contrat', $e->contrat ?? '') == 'Intérim' ? 'selected' : '' }}>Intérim</option>
                                                                        <option value="Freelance" {{ old('contrat', $e->contrat ?? '') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                                                        <option value="Consultant" {{ old('contrat', $e->contrat ?? '') == 'Consultant' ? 'selected' : '' }}>Consultant</option>

                                                                    </select>

                                                                <!-- Salaire -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Salaire de base</label>
                                                                    <input type="number" class="form-control" name="salary_base" value={{ $e->salary_base }} required>
                                                                </div>

                                                                <!-- Date d'embauche -->
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Date d'embauche</label>
                                                                    <input type="date" class="form-control" name="hire_date" value={{ $e->hire_date }} required>
                                                                </div>

                                                                <!-- Photo -->
                                                                <div class="col-md-12">
                                                                <label>Photo actuelle</label><br>
                                                                <img id="preview_photo" src="/upload/{{$e->photo}}" width="150" class="border rounded">
                                                            </div>

                                                                <div class="col-md-12">
                                                                    <label class="form-label">Photo</label>
                                                                    <input type="file" class="form-control" name="photo" accept="image/*">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            <button class="btn btn-primary" data-bs-dismiss="modal"  type="submit">Enregistre</button>
                                                            
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                    </div>
                                

                                     
                                @endforeach
                                    
                                

                        
                        
                        @endif

                               
                </div>
                        
            </div>
        </div>
    </div>
</x-app-layout>
